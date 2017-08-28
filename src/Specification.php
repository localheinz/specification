<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller.
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
