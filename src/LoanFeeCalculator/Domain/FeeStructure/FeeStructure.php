<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Shared\Domain\ValueObject\Money;

class FeeStructure
{
    private array $breakpoints;

    public function __construct(BreakPoint ...$breakpoints)
    {
        $this->breakpoints = $breakpoints;

        $this->sortBreakpoints();
        $this->checkForDuplicates();
    }

    private function sortBreakpoints(): void {
        usort($this->breakpoints, function (BreakPoint $a, BreakPoint $b) {
            return $a->amount->compare($b->amount);
        });
    }

    private function checkForDuplicates(): void
    {
        $previousAmount = null;
        foreach ($this->breakpoints as $breakpoint) {
            $currentAmount = $breakpoint->amount();
            if ($previousAmount !== null && $currentAmount === $previousAmount) {
                throw new \InvalidArgumentException("Duplicated breakpoint has been found: {$currentAmount}");
            }
            $previousAmount = $currentAmount;
        }
    }

    public function calculateFee(LoanAmount $loanAmount): Money
    {
        $lowerBound = null;
        $upperBound = null;

        foreach ($this->breakpoints as $breakpoint) {
            if ($loanAmount->amount()->value() <= $breakpoint->amount()) {
                $upperBound = $breakpoint;
                break;
            }

            $lowerBound = $breakpoint;
        }

        if ($lowerBound === null) {
            return new Money($this->breakpoints[array_key_first($this->breakpoints)]->cost());
        }

        if ($upperBound === null) {
            return new Money($this->breakpoints[array_key_last($this->breakpoints)]->cost());
        }

        $lowerAmount = $lowerBound->amount();
        $lowerFee = $lowerBound->cost();
        $upperAmount = $upperBound->amount();
        $upperFee = $upperBound->cost();

        $feeRange = $upperFee - $lowerFee;
        $amountRange = $upperAmount - $lowerAmount;
        $amountDiff = $loanAmount->amount()->value() - $lowerAmount;

        $interpolatedFee = $lowerFee + ($feeRange * ($amountDiff / $amountRange));

        return new Money(round($interpolatedFee, 3));
    }

    public function getBreakpoints(): array
    {
        return $this->breakpoints;
    }
}
