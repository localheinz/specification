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

namespace Localheinz\Specification\Test\AutoReview;

use Localheinz\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 * @coversNothing
 */
final class SrcCodeTest extends Framework\TestCase
{
    use Helper;

    public function testSrcClassesAreAbstractOrFinal(): void
    {
        self::assertClassesAreAbstractOrFinal(__DIR__ . '/../../src');
    }

    public function testSrcClassesHaveTests(): void
    {
        self::assertClassesHaveTests(
            __DIR__ . '/../../src',
            'Localheinz\\Specification\\',
            'Localheinz\\Specification\\Test\\Unit'
        );
    }
}
