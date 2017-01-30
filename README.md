# raml2apigility
[![Build Status](https://travis-ci.org/robertboloc/raml2apigility.svg?branch=master)](https://travis-ci.org/robertboloc/raml2apigility)
[![License](https://poser.pugx.org/robertboloc/raml2apigility/license.png)](https://packagist.org/packages/robertboloc/raml2apigility)

Apigility scaffolding generator based on a RAML specification.

The tool will generate the same code the Apigility Admin UI generates but from
the command line and based on a RAML specification file.

> Please note that this tool is in early stages of development.

## Table of contents
- [Installation](#installation)
- [Usage](#usage)

## Installation
```php
composer require --dev "robertboloc/raml2apigility"
chmod +x vendor/bin/raml2apigility
```

## Usage
```php
vendor/bin/raml2apigility [--help] [-s spec, --spec spec] [-t target, --target target]
```

### Options
##### spec (-s or --spec)
Path to the RAML specification file

##### target (-t or --target)
Path to the Apigility project where the code should be generated into.

##### help (--spec)
Display the usage message
