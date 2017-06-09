<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Unit;

final class OrSpecificationTest extends SpecificationTestCase
{
    public function testIsSatisfiedReturnsTrueIfOneIsSatisfied()
    {
        $isSatisfiedBy = [
            false,
            false,
            true,
        ];

        $this->createTest(true, ...$isSatisfiedBy);
    }

    public function testIsSatisfiedReturnsFalseIfAllAreUnsatisfied()
    {
        $isSatisfiedBy = [
            false,
            false,
            false,
        ];

        $this->createTest(false, ...$isSatisfiedBy);
    }
}
