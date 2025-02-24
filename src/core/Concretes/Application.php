<?php

declare(strict_types=1);

namespace Bridget\Concretes;

use Bridget\Console\Input;
use Bridget\Console\Output;

class Application extends Program
{
    /**
     * @param  null|array<string>  $args
     **/
    public function execute(array $args, Input $input, Output $output): int
    {
        $output::print("Project: $this->name\n\t$this->description".PHP_EOL);

        if (! count($args)) {
            $code = $input::scan('❯ ');
            $output::print($code);

            return 0;
        }

        switch ($args[1]) {
            case '-c':
                fprintf(STDOUT, 'We are going to compile file from %s'.PHP_EOL, $this->projectRoot);
                $compiler = new Compiler($this->projectRoot);
                $compiler->compile($args[2] ?? '', $args[3] ?? '');
                break;

            case '-o':
                fprintf(STDOUT, 'We are going to create archive from %s'.PHP_EOL, $this->wdir);
                break;

            default:
                fprintf(STDERR, 'Unknown command: %s'.PHP_EOL, implode(' ', $args));

                return 1;
        }

        return 0;
    }
}
