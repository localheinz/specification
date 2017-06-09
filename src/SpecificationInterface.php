<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification;

interface SpecificationInterface
{
    /**
     * @param object $candidate
     *
     * @throws \Throwable
     *
     * @return bool
     */
    public function isSatisfiedBy($candidate): bool;
}
