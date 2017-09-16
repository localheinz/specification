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

namespace Localheinz\Specification\Test\Integration\Asset;

use Localheinz\Specification\SpecificationInterface;

final class IsInstanceOfStdClass implements SpecificationInterface
{
    public function isSatisfiedBy($candidate): bool
    {
        return $candidate instanceof \stdClass;
    }
}
