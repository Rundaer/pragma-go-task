<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain;

interface FeeCalculator
{
    /**
     * @return float The calculated total fee.
     */
    public function calculate(Loan $loan): float;
}
