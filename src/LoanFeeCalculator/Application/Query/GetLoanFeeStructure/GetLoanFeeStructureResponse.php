<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Application\Query\GetLoanFeeStructure;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\FeeStructure;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\FeeStructureRepository;
use PragmaGoTech\Interview\Shared\Application\QueryHandler;
use PragmaGoTech\Interview\Shared\Application\Response;

readonly class GetLoanFeeStructureResponse implements Response
{
    public function __construct(
        public FeeStructure $feeStructure
    ) {}
}

