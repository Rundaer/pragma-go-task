<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Shared\Domain\ValueObject;

readonly class Money
{
    public function __construct(
        private float $value,
        private Currency $currency = Currency::PLN
    ) {}

    public function value(): float
    {
        return $this->value;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function compare(Money $other): int
    {
        return $this->value <=> $other->value;
    }
}
