<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/localheinz/specification
 */

namespace Localheinz\Specification\Test\Fixture\Specification;

use Localheinz\Specification\SpecificationInterface;

final class CandidateSpecification implements SpecificationInterface
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
