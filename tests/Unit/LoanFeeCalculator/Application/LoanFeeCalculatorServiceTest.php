<?php

declare(strict_types=1);

namespace Tests\PragmaGoTech\Interview\Unit\LoanFeeCalculator\Application;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\LoanFeeCalculator\Application\LoanFeeCalculatorService;
use PragmaGoTech\Interview\LoanFeeCalculator\Application\Query\GetLoanFeeStructure\GetLoanFeeStructureQuery;
use PragmaGoTech\Interview\LoanFeeCalculator\Application\Query\GetLoanFeeStructure\GetLoanFeeStructureResponse;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeCalculator;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\Loan;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject\LoanAmount;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject\Term;
use PragmaGoTech\Interview\Shared\Application\QueryBus;
use PragmaGoTech\Interview\Shared\Domain\ValueObject\Money;
use Tests\PragmaGoTech\Interview\Unit\LoanFeeCalculator\Domain\FeeStructure\FeeStructureFake;

class LoanFeeCalculatorServiceTest extends TestCase
{
    private QueryBus|MockObject $queryBusMock;

    private FeeCalculator $SUT;

    protected function setUp(): void
    {
        $this->queryBusMock = $this->createMock(QueryBus::class);

        $this->SUT = new LoanFeeCalculatorService($this->queryBusMock);
    }

    #[Test]
    #[DataProvider('examplesLoans')]
    public function shouldCalculateWell(float $amount, int $term, float $expectedFee): void
    {
        // Arrange
        $loan = new Loan(
            new Term($term),
            new LoanAmount(new Money($amount)),
        );
        $feeStructure = FeeStructureFake::get($term);

        $this->queryBusMock
            ->expects($this->once())
            ->method('ask')
            ->with($this->isInstanceOf(GetLoanFeeStructureQuery::class))
            ->willReturn(new GetLoanFeeStructureResponse($feeStructure));


        $actualFee = $this->SUT->calculate($loan);

        $this->assertEquals($expectedFee, $actualFee);
    }

    public static function examplesLoans(): array
    {
        return [
            [11500, 24, 460],
            [19250, 12, 385],
        ];
    }
}
