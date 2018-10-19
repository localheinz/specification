# specification

[![Build Status](https://travis-ci.com/localheinz/specification.svg?branch=master)](https://travis-ci.com/localheinz/specification)
[![codecov](https://codecov.io/gh/localheinz/specification/branch/master/graph/badge.svg)](https://codecov.io/gh/localheinz/specification)
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
use Localheinz\Specification\AndSpecification;
use Localheinz\Specification\Test\Fixture;

$specification = new AndSpecification(
    new Fixture\Specification\IsInstanceOfStdClass(),
    new Fixture\Specification\HasFooProperty(),
    new Fixture\Specification\HasBarProperty()
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
use Localheinz\Specification\OrSpecification;
use Localheinz\Specification\Test\Fixture;

$specification = new OrSpecification(
    new Fixture\Specification\IsInstanceOfStdClass(),
    new Fixture\Specification\HasFooProperty(),
    new Fixture\Specification\HasBarProperty()
);

$candidate = new \stdClass();

$specification->isSatisfiedBy($candidate); // true
```

### `NotSpecification`

Use `Localheinz\Specification\NotSpecification` to compose a specification
from specifications where none should be satisfied:

```php
use Localheinz\Specification\NotSpecification;
use Localheinz\Specification\Test\Fixture;

$specification = new NotSpecification(
    new Fixture\Specification\IsInstanceOfStdClass(),
    new Fixture\Specification\HasFooProperty(),
    new Fixture\Specification\HasBarProperty()
);

$candidate = new \SplObjectStorage();

$specification->isSatisfiedBy($candidate); // true
```

### Mix and match

Mix and match all of the specifications to your need:

```php
use Localheinz\Specification\AndSpecification;
use Localheinz\Specification\NotSpecification;
use Localheinz\Specification\OrSpecification;
use Localheinz\Specification\Test\Fixture;

$specification = new AndSpecification(
    new NotSpecification(new Fixture\Specification\IsInstanceOfStdClass()),
    new OrSpecification(
        new Fixture\Specification\HasFooProperty(),
        new Fixture\Specification\HasBarProperty()
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

Please have a look at [`CODE_OF_CONDUCT.md`](.github/CODE_OF_CONDUCT.md).

## License

This package is licensed using the MIT License.
