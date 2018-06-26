# XML Validator

Validate your XML easily. The main purpose is to validate the XML to a XSD schema, but (basic) validation without a 
schema is possible too.

```php
$validator = new Validator('books.xml');

// Validate with a XSD schema
$valid = $validator->validate('books.xsd');

// Or validate without a XSD schema
$valid = $validator->validate();
```

## Requirements

This package requires PHP 7.1 or higher with the libxml extension (which is enabled by default).

## Installation

```php
composer require vdhicts/xml-validator
```

## Tests

Full code coverage unit tests are available in the `tests` folder. Run via phpunit:

`vendor\bin\phpunit`

By default a coverage report will be generated in the `build/coverage` folder.

## Contribution

Any contribution is welcome, but it should be fully tested, meet the PSR-2 standard and please create one pull request 
per feature. In exchange you will be credited as contributor on this page.

## Security

If you discover any security related issues in this or other packages of Vdhicts, please email info@vdhicts.nl instead
of using the issue tracker.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## About vdhicts

[Van der Heiden ICT services](https://www.vdhicts.nl) is the name of my personal company for which I work as 
freelancer. Van der Heiden ICT services develops and implements IT solutions for businesses and educational 
institutions.
