<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * @link https://github.com/localheinz/specification
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
