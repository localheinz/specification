<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Unit;

/**
 * @internal
 */
final class OrSpecificationTest extends SpecificationTestCase
{
    public function testIsSatisfiedReturnsTrueIfOneIsSatisfied(): void
    {
        $isSatisfiedBy = [
            false,
            false,
            true,
        ];

        $this->createTest(true, ...$isSatisfiedBy);
    }

    public function testIsSatisfiedReturnsFalseIfAllAreUnsatisfied(): void
    {
        $isSatisfiedBy = [
            false,
            false,
            false,
        ];

        $this->createTest(false, ...$isSatisfiedBy);
    }
}
