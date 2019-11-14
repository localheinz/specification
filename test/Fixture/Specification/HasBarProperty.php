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

namespace Localheinz\Specification\Test\Fixture\Specification;

use Localheinz\Specification\SpecificationInterface;

final class HasBarProperty implements SpecificationInterface
{
    public function isSatisfiedBy($candidate): bool
    {
        return \property_exists($candidate, 'bar');
    }
}
