<?php

declare(strict_types=1);

namespace Bree\Concretes;

use Bree\Exception\BadValue;
use Bree\Exception\NotFound;
use Psr\Container\ContainerInterface;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;

class Container implements ContainerInterface
{
    /**
     * @var array<string, mixed[]|string|object|callable(mixed ...$args): mixed>
     */
    private array $components = [];

    /**
     * @var array<string, class-string|trait-string|string>
     */
    private array $aliases = [];

    /**
     * @param  array<string, mixed[]|string|object|callable(mixed ...$args): mixed>  $components
     */
    public function __construct(array $components = [])
    {
        $this->setComponents($components);
    }

    /**
     * @param  array<string, mixed[]|string|object|callable(mixed ...$args): mixed>  $components
     */
    public function setComponents(array $components): static
    {
        foreach ($components as $id => $component) {
            $this->set($id, $component);
        }

        return $this;
    }

    /**
     * @param  mixed[]|string|object|callable(mixed ...$args): mixed  $component
     */
    public function set(string $id, array|string|object|callable $component): static
    {
        if (is_string($component) && ! is_callable($component)) {
            $this->aliases[$id] = $component;
        } else {
            $this->components[$id] = $component;
        }

        return $this;
    }

    public function get(string $id): mixed
    {
        if (isset($this->aliases[$id])) {
            return $this->get($this->aliases[$id]);
        }

        return $this->build($id);
    }

    public function has(string $id): bool
    {
        return isset($this->aliases[$id]) || isset($this->components[$id]);
    }

    public function build(string $id): mixed
    {
        if (! (isset($this->components[$id]) || class_exists($id))) {
            throw NotFound::with('Could not build %s.', [$id]);
        }

        $component = $this->components[$id] ?? $id;

        if (is_array($component)) {
            if (class_exists($id)) {
                return $this->instanciateArgs($id, $component);
            }

            if (is_callable($id)) {
                return $this->invokeArgs($id, $component);
            }

            throw BadValue::with('Invalid component given');
        }

        if (is_callable($component)) {
            return $this->invoke($component);
        }
        if (is_object($component)) {
            return $this->instanciate($component);
        }
        if (class_exists($component)) {
            return $this->instanciate($component);
        }

        return $this->get($component);
    }

    /**
     * @return list<class-string>
     */
    public function getClasses(): array
    {
        $classes = [];

        foreach ($this->aliases as $id) {
            if ($class = $this->getClass($id)) {
                $classes[] = $class;
            }
        }

        foreach (array_keys($this->components) as $id) {
            if ($class = $this->getClass($id)) {
                $classes[] = $class;
            }
        }

        return $classes;
    }

    /**
     * @return null|class-string
     */
    public function getClass(string $id): ?string
    {
        if (isset($this->components[$id])) {
            $component = $this->components[$id];

            if (is_object($component)) {
                return $component::class;
            }

            if (is_string($component)) {
                return class_exists($component) || interface_exists($component) ? $component : $this->getClass($component);
            }

            if (class_exists($id)) {
                return $id;
            }
        }

        return null;
    }

    /**
     * Tries to build the given instance.
     *
     * @template TObject of object
     *
     * @param  TObject|class-string<TObject>  $object_or_class
     * @return TObject|null
     */
    public function instanciate(object|string $object_or_class, mixed ...$args): ?object
    {
        return $this->instanciateArgs($object_or_class, $args);
    }

    /**
     * Tries to build the given instance.
     *
     * @template TObject of object
     *
     * @param  TObject|class-string<TObject>  $object_or_class
     * @param  mixed[]  $args
     * @return TObject|null
     */
    public function instanciateArgs(object|string $object_or_class, array $args = []): ?object
    {
        $reflectionClass = Reflector::reflectClass($object_or_class);

        if ($reflectionClass->isInstantiable()) {
            $constructor = $reflectionClass->getConstructor();

            if ($constructor instanceof \ReflectionMethod) {
                $args = $this->buildFunctionArgs($constructor, $args);

                return $args === [] ? $reflectionClass->newInstance() : $reflectionClass->newInstanceArgs($args);
            }

            return $reflectionClass->newInstance();
        }

        throw BadValue::with('The class %s cannot be instantiated.', [$object_or_class::class]);
    }

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $callback
     */
    public function invoke(array|string|object|callable $callback, mixed ...$arguments): mixed
    {
        return $this->invokeArgs($callback, $arguments);
    }

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $callback
     * @param  mixed[]  $args
     */
    public function invokeArgs(array|string|object|callable $callback, array $args = []): mixed
    {
        $callback = Callback::from($callback);

        if ($method = $callback->getMethod()) {
            $method = ($object = $callback->getObject())
            ? Reflector::reflectMethod($object, $method)
            : Reflector::reflectMethod($method);

            return $this->invokeFunctionArgs($method, $args, $object);
        }

        $func = Reflector::reflectCallback($callback);

        return $this->invokeFunctionArgs($func, $args);
    }

    /**
     * @param  mixed[]  $args
     */
    public function invokeFunctionArgs(ReflectionFunction|ReflectionMethod $func, array $args = [], ?object $object = null): mixed
    {
        $args = $this->buildFunctionArgs($func, $args);

        if ($args === []) {
            /** @var mixed $result */
            $result = $func instanceof ReflectionMethod
            ? $func->invoke($object)
            : $func->invoke();
        } else {
            /** @var mixed $result */
            $result = $func instanceof ReflectionMethod
            ? $func->invokeArgs($object, $args)
            : $func->invokeArgs($args);
        }

        if (! Reflector::checkType($type = $func->getReturnType(), $result)) {
            throw BadValue::with('%s expected but %s provided.', [(string) $type ?: 'mixed', get_debug_type($result)]);
        }

        return $result;
    }

    /**
     * @param  mixed[]  $args
     * @return list<mixed>
     */
    public function buildFunctionArgs(ReflectionFunctionAbstract $func, array $args = []): array
    {
        $args = Reflector::buildFunctionArgs($func, $args);
        $classes = $this->getClasses();
        foreach ($func->getParameters() as $param) {
            $pos = $param->getPosition();
            if (! isset($args[$pos]) && ! $param->allowsNull()) {
                /** @psalm-suppress MixedAssignment */
                $args[$pos] = Reflector::getParameterClassName($param, $classes);
            }
        }

        return $args;
    }
}
