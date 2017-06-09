<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Unit;

final class NotSpecificationTest extends SpecificationTestCase
{
    public function testIsSatisfiedReturnsTrueIfAllAreUnsatisfied()
    {
        $isSatisfiedBy = [
            false,
            false,
            false,
        ];

        $this->createTest(true, ...$isSatisfiedBy);
    }

    public function testIsSatisfiedReturnsFalseIfOneIsSatisfied()
    {
        $isSatisfiedBy = [
            false,
            false,
            true,
        ];

        $this->createTest(false, ...$isSatisfiedBy);
    }
}
