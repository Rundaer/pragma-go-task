<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject;

use PragmaGoTech\Interview\Shared\Domain\ValueObject\Currency;
use PragmaGoTech\Interview\Shared\Domain\ValueObject\Money;

final readonly class LoanAmount
{
    private const MIN_AMOUNT = 1000.000;
    private const MAX_AMOUNT = 20000.000;

    private Money $amount;

    public function __construct(Money $amount)
    {
        $rounded = round($amount->value(), 3);

        if ($rounded < self::MIN_AMOUNT || $rounded > self::MAX_AMOUNT) {
            throw new \InvalidArgumentException(sprintf(
                'Loan amount must be between %.2f and %.2f %s',
                self::MIN_AMOUNT,
                self::MAX_AMOUNT,
                $amount->currency()->value
            ));
        }

        $this->amount = new Money($rounded);
    }

    public function amount(): Money
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->amount->currency();
    }
}
