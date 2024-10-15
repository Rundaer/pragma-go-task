<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure;

use PragmaGoTech\Interview\Shared\Domain\ValueObject\Money;

readonly class BreakPoint
{
    public function __construct(
        public Money $amount,
        public Money $cost,
    ) {}

    public function amount(): float
    {
        return $this->amount->value();
    }

    public function cost(): float
    {
        return $this->cost->value();
    }
}
