<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Integration\Asset;

use Localheinz\Specification\SpecificationInterface;

final class HasBarProperty implements SpecificationInterface
{
    public function isSatisfiedBy($candidate): bool
    {
        return \property_exists($candidate, 'bar');
    }
}
