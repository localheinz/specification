<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Integration;

use Localheinz\Specification;
use Localheinz\Specification\Test\Fixture;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @coversNothing
 */
final class SpecificationTest extends Framework\TestCase
{
    public function testAndSpecification(): void
    {
        $candidate = new \stdClass();

        $candidate->foo = 9000;
        $candidate->bar = 3.14;

        $specification = new Specification\AndSpecification(
            new Fixture\Specification\IsInstanceOfStdClass(),
            new Fixture\Specification\HasFooProperty(),
            new Fixture\Specification\HasBarProperty()
        );

        self::assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testOrSpecification(): void
    {
        $candidate = new \stdClass();

        $candidate->introduction = 'Hello, my name is Jane';

        $specification = new Specification\OrSpecification(
            new Fixture\Specification\IsInstanceOfStdClass(),
            new Fixture\Specification\HasFooProperty(),
            new Fixture\Specification\HasBarProperty()
        );

        self::assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testNotSpecification(): void
    {
        $candidate = new \SplObjectStorage();

        $specification = new Specification\NotSpecification(
            new Fixture\Specification\IsInstanceOfStdClass(),
            new Fixture\Specification\HasFooProperty(),
            new Fixture\Specification\HasBarProperty()
        );

        self::assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testMixAndMatchSpecifications(): void
    {
        $candidate = new Specification\Test\Fixture\Candidate\Baz();

        $specification = new Specification\AndSpecification(
            new Specification\NotSpecification(new Fixture\Specification\IsInstanceOfStdClass()),
            new Specification\OrSpecification(
                new Fixture\Specification\HasFooProperty(),
                new Fixture\Specification\HasBarProperty()
            )
        );

        self::assertTrue($specification->isSatisfiedBy($candidate));
    }
}
