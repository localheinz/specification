# specification

[![Build Status](https://travis-ci.org/localheinz/specification.svg?branch=master)](https://travis-ci.org/localheinz/specification)
[![Code Climate](https://codeclimate.com/github/localheinz/specification/badges/gpa.svg)](https://codeclimate.com/github/localheinz/specification)
[![Test Coverage](https://codeclimate.com/github/localheinz/specification/badges/coverage.svg)](https://codeclimate.com/github/localheinz/specification/coverage)
[![Issue Count](https://codeclimate.com/github/localheinz/specification/badges/issue_count.svg)](https://codeclimate.com/github/localheinz/specification)
[![Latest Stable Version](https://poser.pugx.org/localheinz/specification/v/stable)](https://packagist.org/packages/localheinz/specification)
[![Total Downloads](https://poser.pugx.org/localheinz/specification/downloads)](https://packagist.org/packages/localheinz/specification)

Provides specifications following the paper by [Eric Evans and
Martin Fowler](http://martinfowler.com/apsupp/spec.pdf), also see
[Wikipedia: Specification Pattern](https://en.wikipedia.org/wiki/Specification_pattern).

## Installation

Run

```
$ composer require localheinz/specification
```

## Usage

### `SpecificationInterface`

Implement `Localheinz\Specification\SpecificationInterface` in your specifications:

```php
namespace Foo\Bar;

use Localheinz\Specification\SpecificationInterface;

class IsInstanceOfStdClass implements SpecificationInterface
{
    public function isSatisfiedBy($candidate): bool
    {
        return $candidate instanceof \stdClass;
    }
}

class HasFooProperty implements SpecificationInterface
{
    public function isSatisfiedBy($candidate): bool
    {
        return property_exists($candidate, 'foo');
    }
}

class HasBarProperty implements SpecificationInterface
{
    public function isSatisfiedBy($candidate): bool
    {
        return property_exists($candidate, 'bar');
    }
}
```

### `AndSpecification`

Use `Localheinz\Specification\AndSpecification` to compose a specification
from specifications which all need to be satisfied:

```php
use Foo\Bar;
use Localheinz\Specification;

$specification = new Specification\AndSpecification(
    new Bar\IsInstanceOfStdClass(),
    new Bar\HasFooProperty(),
    new Bar\HasBarProperty()
);

$candidate = new \stdClass();

$candidate->foo = 9000;
$candidate->bar = 'Hello, my name is Jane';

$specification->isSatisfiedBy($candidate); // true
```

### `OrSpecification`

Use `Localheinz\Specification\OrSpecification` to compose a specification
from specifications where only one needs to be satisfied:

```php
use Foo\Bar;
use Localheinz\Specification;

$specification = new Specification\OrSpecification(
    new Bar\IsInstanceOfStdClass(),
    new Bar\HasFooProperty(),
    new Bar\HasBarProperty()
);

$candidate = new \stdClass();

$specification->isSatisfiedBy($candidate); // true
```

### `NotSpecification`

Use `Localheinz\Specification\NotSpecification` to compose a specification
from specifications where none should be satisfied:

```php
use Foo\Bar;
use Localheinz\Specification;

$specification = new Specification\NotSpecification(
    new Bar\IsInstanceOfStdClass(),
    new Bar\HasFooProperty(),
    new Bar\HasBarProperty()
);

$candidate = new \SplObjectStorage();

$specification->isSatisfiedBy($candidate); // true
```

### Mix and match

Mix and match all of the specifications to your need:

```php
use Foo\Bar;
use Localheinz\Specification;

$specification = new Specification\AndSpecification(
    new Specification\NotSpecification(new Bar\IsInstanceOfStdClass()),
    new Specification\OrSpecification(
        new Bar\HasFooProperty(),
        new Bar\HasBarProperty()
    )
);

class Baz
{
    public $foo;
}

$candidate = new Baz();

$specification->isSatisfiedBy($candidate); // true
```

## Contributing

Please have a look at [`CONTRIBUTING.md`](.github/CONTRIBUTING.md).

## Code of Conduct

Please have a look at [`CONDUCT.md`](.github/CODE_OF_CONDUCT.md).
