<img src="docs/thumbnail.png" />

<h1 align="center">Download your own favorite HTML Template from anywhere 😎</h1>

## Installation
> Composer installer
```bash
composer create-project arefshojaei/template-downloader my-project
```

OR

> Clone the repository
```bash
git clone https://github.com/ArefShojaei/Template-downloader.git
```

## Setup
> Move to the folder
```bash
cd my-project
```

OR

```bash
cd Template-downloader
```

> Install dependencies
```bash
composer install
```

## Guide:
> Download single template with URL
```bash
php cli template {url}
```

> Download multiple templates from "template.config.json" file
```bash
php cli template --config
```

## Demo
After downloading the template, here is demo of the downloaded template
```txt
template/
|
├── assets
│   ├── images/
│   ├── fonts/
│   ├── scripts/
│   └── styles/
|
└── index.html
```

> Note: If you want to get better the response, you will be able to must run a local web-server at the template folder.

There are two ways to run a local web-server

> First way

Using **Live-server** ( vs-code extention )

> Second way

Run PHP built-in web-server with this command

```bash
cd dist/template-name
```

```php
php -S localhost:5200
```

Done.