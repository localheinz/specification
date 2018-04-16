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

namespace Localheinz\Specification\Test\Unit;

use Localheinz\Specification\SpecificationInterface;
use Localheinz\Specification\Test\Fixture;
use Localheinz\Test\Util\Helper;
use PHPUnit\Framework;

abstract class SpecificationTestCase extends Framework\TestCase
{
    use Helper;

    final public function testImplementsSpecificationInterface()
    {
        $this->assertClassImplementsInterface(
            SpecificationInterface::class,
            $this->className()
        );
    }

    final protected function createTest(bool $expected, bool ...$isSatisfiedBy)
    {
        $candidate = new \stdClass();

        $reflection = new \ReflectionClass($this->className());

        $specifications = \array_map(function ($isSatisfied) use ($candidate) {
            return new Fixture\Specification\CandidateSpecification(
                $candidate,
                $isSatisfied
            );
        }, $isSatisfiedBy);

        /** @var SpecificationInterface $specification */
        $specification = $reflection->newInstance(...$specifications);

        $this->assertSame($expected, $specification->isSatisfiedBy($candidate), \sprintf(
            'Failed asserting that "%s" is "%s" if composed specifications are "%s".',
            $this->className(),
            $this->name($expected),
            \implode('", "', \array_map(function ($isSatisfied) {
                return $this->name($isSatisfied);
            }, $isSatisfiedBy))
        ));
    }

    private function className(): string
    {
        return \preg_replace(
            '/Test$/',
            '',
            \str_replace(
                'Localheinz\\Specification\\Test\\Unit\\',
                'Localheinz\\Specification\\',
                static::class
            )
        );
    }

    private function name(bool $isSatisfied): string
    {
        if ($isSatisfied) {
            return 'satisfied';
        }

        return 'unsatisfied';
    }
}
