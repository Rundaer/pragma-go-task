<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\Loan;

interface FeeStructureRepository
{
    /**
     * Returns fee structure for loan
     * Based on amount and terms
     *
     * if calculate for single loan no need to get all.
     */
    public function getLoanFeeStructure(Loan $loan): FeeStructure;
}
