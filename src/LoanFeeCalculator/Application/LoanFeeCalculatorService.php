<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Application;

use PragmaGoTech\Interview\LoanFeeCalculator\Application\Query\GetLoanFeeStructure\GetLoanFeeStructureQuery;
use PragmaGoTech\Interview\LoanFeeCalculator\Application\Query\GetLoanFeeStructure\GetLoanFeeStructureResponse;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeCalculator;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\FeeStructure;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\Loan;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Shared\Application\QueryBus;
use PragmaGoTech\Interview\Shared\Domain\ValueObject\Money;

// Todo: Move to command and meaby extract domain service? dunno.
readonly class LoanFeeCalculatorService implements FeeCalculator
{
    public function __construct(
        private QueryBus $queryBus
    ) {}

    public function calculate(Loan $loan): float
    {
        $feeStructure = $this->getFeeStructure($loan);

        // Calc
        $fee = $feeStructure->calculateFee($loan->loanAmount);
        $fee = $this->roundFee($fee, $loan->loanAmount);

        // TODO: Might implement some kind of a strategy pattern that allows to add different behavoiurs
        // or.. chain of resp.

        return $fee;
    }

    private function getFeeStructure(Loan $loan): FeeStructure
    {
        /** @var GetLoanFeeStructureResponse $response */
        $response = $this->queryBus->ask(
            new GetLoanFeeStructureQuery($loan)
        );

        return $response->feeStructure;
    }

    private function roundFee(Money $feeStructureBased, LoanAmount $loanAmount): float
    {
        $total = $feeStructureBased->value() + $loanAmount->amount()->value();
        $roundedTotal = ceil($total / 5) * 5;
        return $roundedTotal - $loanAmount->amount()->value();
    }
}
