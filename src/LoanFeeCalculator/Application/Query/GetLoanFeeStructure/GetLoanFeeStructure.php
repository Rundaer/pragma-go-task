<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Application\Query\GetLoanFeeStructure;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\FeeStructureRepository;
use PragmaGoTech\Interview\Shared\Application\QueryHandler;

readonly class GetLoanFeeStructure implements QueryHandler
{
    public function __construct(
        private FeeStructureRepository $feeStructureRepository
    ) {}

    public function __invoke(GetLoanFeeStructureQuery $query): GetLoanFeeStructureResponse
    {
        return new GetLoanFeeStructureResponse(
            $this->feeStructureRepository->getLoanFeeStructure($query->loan)
        );
    }
}
