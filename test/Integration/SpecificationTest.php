<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Integration;

use Localheinz\Specification;
use PHPUnit\Framework;

final class SpecificationTest extends Framework\TestCase
{
    public function testAndSpecification()
    {
        $candidate = new \stdClass();

        $candidate->foo = 9000;
        $candidate->bar = 3.14;

        $specification = new Specification\AndSpecification(
            new Asset\IsInstanceOfStdClass(),
            new Asset\HasFooProperty(),
            new Asset\HasBarProperty()
        );

        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testOrSpecification()
    {
        $candidate = new \stdClass();

        $candidate->introduction = 'Hello, my name is Jane';

        $specification = new Specification\OrSpecification(
            new Asset\IsInstanceOfStdClass(),
            new Asset\HasFooProperty(),
            new Asset\HasBarProperty()
        );

        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testNotSpecification()
    {
        $candidate = new \SplObjectStorage();

        $specification = new Specification\NotSpecification(
            new Asset\IsInstanceOfStdClass(),
            new Asset\HasFooProperty(),
            new Asset\HasBarProperty()
        );

        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testMixAndMatchSpecifications()
    {
        $candidate = new Asset\Baz();

        $specification = new Specification\AndSpecification(
            new Specification\NotSpecification(new Asset\IsInstanceOfStdClass()),
            new Specification\OrSpecification(
                new Asset\HasFooProperty(),
                new Asset\HasBarProperty()
            )
        );

        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }
}
