<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Unit;

final class AndSpecificationTest extends SpecificationTestCase
{
    public function testIsSatisfiedReturnsTrueIfAllAreSatisfied()
    {
        $isSatisfiedBy = [
            true,
            true,
            true,
        ];

        $this->createTest(true, ...$isSatisfiedBy);
    }

    public function testIsSatisfiedReturnsFalseIfOneIsNotSatisfied()
    {
        $isSatisfiedBy = [
            true,
            true,
            false,
        ];

        $this->createTest(false, ...$isSatisfiedBy);
    }
}
