# 🚀 Bridget - The Next-Gen PHP Framework

[![packagist-version-icon]][packagist-version-link] [![packagist-download-icon]][packagist-download-link]

Bridget is a modern PHP framework designed to enhance development with strong typing, advanced object-oriented features, and a powerful templating system inspired by Blade. 💡✨

---

## ⚡ Quick Start

### 📦 Install Bridget

Install Bridget via [Composer](https://getcomposer.org) with:

```sh
composer global require bridgetphp/bridget:dev-main
```

### 🎉 Try Bridget

Create a `hello.bg` file:

```bridget
Hello, $name!
```

Run it with:

```sh
bridget run hello --name=Bridget
```

This displays: **Hello, Bridget!** 🎊

---

## ❓ What is Bridget?

Bridget is a cutting-edge PHP framework that introduces:

✅ **Strong typing** for better code reliability 🔍
✅ **Advanced OOP features** for maintainable applications 🏗️
✅ **A powerful templating system** for seamless UI rendering 🎨
✅ **Full PHP compatibility** ensuring easy adoption 🔄

---

## 🔥 Why Choose Bridget?

- 🚀 **Enhances PHP without breaking compatibility** – Upgrade your projects without major rewrites.
- ✍️ **No need for PHPDoc & annotations** – Types are enforced at both transpilation and runtime.
- ⚡ **Inspired by TypeScript** – Offers both static and dynamic typing for flexibility.
- 🎭 **Blade-like templating** – Clean and structured HTML rendering.

---

## 🌟 Features

- 🛡️ **Strong Typing** – Enforces types at compile-time and runtime.
- 🏗️ **Advanced OOP** – Expands PHP’s object-oriented capabilities.
- 🔄 **Dynamic & Static Typing** – Inspired by TypeScript.
- 🖥️ **Integrated Templating Engine** – A Blade-like system for clean HTML rendering.
- 🧩 **Seamless PHP Integration** – 100% compatible with existing PHP code.

---

## 📋 Requirements

🔹 [PHP](https://php.net/) 8.4 or higher (8.4.3+ recommended)  
🔹 [Composer](https://getcomposer.org/)  
🔹 [Git](https://git-scm.com/)  
🔹 [Node.js](https://nodejs.org/) (Optional)  

---

## 🚀 Installation

Install Bridget from [Packagist](https://packagist.org/packages/bridgetphp/bridget) using Composer:

```sh
composer global require bridgetphp/bridget:dev-main
```

---

## 🛠️ Usage

Bridget transpiles `.bridget` files into `.php`, introducing enhanced features while maintaining PHP compatibility.

### 🔧 Example Command

```sh
bridget source.bridget
```

This converts `source.bridget` into an optimized PHP file.

### 📝 Example Code

```php
<?php
// Strongly-typed function in Bridget
function greet<T extends string>(T $name): T {
    return "Hello, $name!";
}

echo greet("World");
```

#### 🏆 Transpiled PHP Code

```php
<?php

function greet(string $name): string {
    return "Hello, $name!";
}

echo greet("World");

?>
```

Bridget ensures type safety at transpilation, making PHP development more robust. 🛡️

---

## 🤝 Contributing

We welcome contributions! 💖 Whether it's bug fixes, new features, or documentation improvements, feel free to contribute.

### 📌 How to Contribute

1. 🍴 Fork the repository.
2. 🌱 Create a new branch.
3. 🛠️ Implement your changes and add tests.
4. 📤 Submit a pull request.

Please follow our coding style and contribution guidelines. 🙌

---

## 📜 License

Bridget is licensed under the **MIT License**. See the [LICENSE.md](LICENSE.md) file for details.

---

## 💬 Support & Community

For questions, issues, or feedback:

- 🚀 [Open an issue](https://github.com/bridgetphp/bridget/issues/new/choose)
- 💬 Join [our discussions](https://github.com/bridgetphp/bridget/discussions)

[packagist-version-icon]: https://img.shields.io/packagist/v/bridgetphp/bridget
[packagist-version-link]: https://packagist.org/packages/bridgetphp/bridget "Bridget Releases"

[packagist-download-icon]: https://img.shields.io/packagist/dt/bridgetphp/bridget
[packagist-download-link]: https://packagist.org/packages/bridgetphp/bridget "Bridget Downloads"
