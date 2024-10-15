<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Application\Query\GetLoanFeeStructure;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\Loan;
use PragmaGoTech\Interview\Shared\Application\Query;

final readonly class GetLoanFeeStructureQuery implements Query
{
    public function __construct(
        public Loan $loan
    ) {}
}
