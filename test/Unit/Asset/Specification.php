<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * @link https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Unit\Asset;

use Localheinz\Specification\SpecificationInterface;

/**
 * @internal
 */
final class Specification implements SpecificationInterface
{
    /**
     * @var object
     */
    private $candidate;

    /**
     * @var bool
     */
    private $isSatisfied;

    /**
     * @param object $candidate
     * @param bool   $isSatisfied
     */
    public function __construct($candidate, bool $isSatisfied)
    {
        $this->candidate = $candidate;
        $this->isSatisfied = $isSatisfied;
    }

    public function isSatisfiedBy($candidate): bool
    {
        if ($candidate !== $this->candidate) {
            throw new \InvalidArgumentException(\sprintf(
                'Candidate passed into "%s" is not the same as the one this instance of "%s" was constructed with',
                __METHOD__,
                self::class
            ));
        }

        return $this->isSatisfied;
    }
}
