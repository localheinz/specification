<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification;

final class NotSpecification extends Specification
{
    public function isSatisfiedBy($candidate): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($candidate)) {
                return false;
            }
        }

        return true;
    }
}
