<div align="center">
    <img src="docs/thumbnail.png" alt="Template Downloader" />

<h1 align="center">📥 Template Downloader - SSR Rendering Model</h1>

<p align="center">
    Download your favorite HTML templates from anywhere with a simple CLI command.
    Automatically fetch HTML pages, assets, styles, scripts, images, and organize them into a ready-to-use local project.
</p>

</div>

---

## ✨ Features

* 🌐 Download any public HTML template from a URL
* 🎨 Automatically detect and download CSS, JavaScript, fonts, and images
* 📁 Organize assets into a clean project structure
* ⚡ Simple CLI interface
* 📦 Support bulk downloading using configuration files
* 🪶 Lightweight and built with pure PHP
* 🚀 Ready for local development and customization

---

## 📥 Installation

### Install with Composer

```bash
composer create-project arefshojaei/template-downloader:dev-main my-project
```

Move into the project directory:

```bash
cd my-project
```

---

## Clone from GitHub

```bash
git clone https://github.com/ArefShojaei/Template-downloader.git

cd Template-downloader
```

Install dependencies:

```bash
composer install
```

---

## 🚀 Quick Start

### Download a single template

Use a template URL:

```bash
php cli template https://example.com
```

---

### Download multiple templates

Define your templates inside:

```txt
template.config.json
```

Then run:

```bash
php cli template --config
```

---

## 📂 Downloaded Project Structure

After downloading a template, your output will look like this:

```txt
template/
│
├── assets/
│   ├── images/
│   ├── fonts/
│   ├── scripts/
│   └── styles/
│
└── index.html
```

The template is now available for local development and customization.

---

## 🖥 Preview the Downloaded Template

For the best experience, run the template using a local web server because some assets may require HTTP access.

### Method 1: Live Server (VS Code Extension)

Install the **Live Server** extension and open the template directory.

---

### Method 2: PHP Built-in Web Server

Move to the downloaded template:

```bash
cd dist/template-name
```

Start the server:

```bash
php -S localhost:5200
```

Open your browser:

```txt
http://localhost:5200
```

---

## 🔧 Example Workflow

1. Download a template:

```bash
php cli template https://my-template.com
```

2. Enter the generated directory:

```bash
cd dist/my-template
```

3. Run a local server:

```bash
php -S localhost:5200
```

4. Customize the template files and start development.

---

## 🏗 How It Works

```txt
Website URL
     |
     |
 HTML Parser
     |
     |
 Asset Extractor
     |
     |
 Downloader Engine
     |
     |
 File Organizer
     |
     |
 Local Template Project
```

---

## 💡 Use Cases

This project is useful for:

* Saving HTML templates for offline usage
* Creating local copies of website themes
* Learning frontend architecture
* Customizing existing templates
* Building prototypes faster

---

## 🔥 Why Template Downloader?

Instead of manually downloading every image, stylesheet, font, and JavaScript file, Template Downloader automates the entire process with a single command.

It saves time and provides a clean starting point for your frontend projects.

---

## 👨‍💻 Author

**Aref Shojaei**

* GitHub: https://github.com/ArefShojaei

---

## ⭐ Show Your Support

If this project saves your time and helps your workflow, consider giving it a **Star ⭐** on GitHub.

Your support motivates future improvements.
