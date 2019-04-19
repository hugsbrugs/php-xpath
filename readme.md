# php-xpath

This librairy provides utilities function to ease xpath manipulation

[![Build Status](https://travis-ci.org/hugsbrugs/php-xpath.svg?branch=master)](https://travis-ci.org/hugsbrugs/php-xpath)
[![Coverage Status](https://coveralls.io/repos/github/hugsbrugs/php-xpath/badge.svg?branch=master)](https://coveralls.io/github/hugsbrugs/php-xpath?branch=master)

## Install

Install package with composer
```
composer require hugsbrugs/php-xpath
```

In your PHP code, load librairy
```php
require_once __DIR__ . '/../vendor/autoload.php';
use Hug\Xpath\Xpath as Xpath;
```

## Usage

Extracts all elements matching query
```php
Xpath::extract_all($html, $query = '//a');
```

Extracts first element matching query
```php
Xpath::extract_first($html, $query = '//body//h3');
```

Extracts body of HTML document
```php
Xpath::get_body($html);
```

Replaces body of HTML document
```php
Xpath::replace_body($html, $new_body = '<div>Hello World !</div>');
```

XPath fails at extracting html tags style attributes content so this function makes it !
```php
Xpath::extract_style($html, $query = '//body//div[@class="inscriptionadsl"]', $style_property = 'height');
```

Extract first iframe from a webpage matching a given domain name
```php
Xpath::extract_iframe($html, $domain = 'hugo.maugey.fr');
```

## Unit Tests

```
phpunit --bootstrap vendor/autoload.php tests
```

## Author

Hugo Maugey [visit my website ;)](https://hugo.maugey.fr)
