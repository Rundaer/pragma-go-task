<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject\LoanAmount;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject\Term;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
readonly class Loan
{
    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */

    /**
     * Amount requested for this loan application.
     */
    public function __construct(
        public Term $term,
        public LoanAmount $loanAmount
    ) {
    }
}
