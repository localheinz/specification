<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification;

abstract class Specification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    protected $specifications;

    final public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }
}
