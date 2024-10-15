<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject;

final readonly class Term
{
    private const TERM_12 = 12;
    private const TERM_24 = 24;

    private int $term;

    public function __construct(int $term)
    {
        if (!in_array($term, [self::TERM_12, self::TERM_24])) {
            throw new \InvalidArgumentException('Invalid term. Available terms are 12, 24.');
        }

        $this->term = $term;
    }

    public function value(): int
    {
        return $this->term;
    }
}
