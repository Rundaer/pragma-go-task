<?php

declare(strict_types=1);

namespace Tests\PragmaGoTech\Interview\Unit\LoanFeeCalculator\Domain\FeeStructure;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\FeeStructure;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\BreakPoint;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Shared\Domain\ValueObject\Money;

class FeeStructureTest extends TestCase
{
    private FeeStructure $feeStructure;

    protected function setUp(): void
    {
        $this->feeStructure = new FeeStructure(
            new BreakPoint(new Money(1000), new Money(50)),
            new BreakPoint(new Money(2000), new Money(90)),
            new BreakPoint(new Money(3000), new Money(90)),
            new BreakPoint(new Money(4000), new Money(100)),
            new BreakPoint(new Money(5000), new Money(115)),
            new BreakPoint(new Money(10000), new Money(200)),
            new BreakPoint(new Money(20000), new Money(400))
        );
    }

    #[Test]
    #[DataProvider(methodName: 'validAmountDataProvider')]
    public function shouldHaveProperValidCalculations(int $amount, float $expectedFee): void
    {
        $fee = $this->feeStructure->calculateFee(
            new LoanAmount(new Money($amount))
        );

        $this->assertEquals($expectedFee, $fee->value());
    }

    public static function validAmountDataProvider(): array
    {
        return [
            'Exact lower bound' => [1000, 50],
            'Exact upper bound' => [20000, 400],
            'Between first two breakpoints' => [1500, 70],
            'Exact middle breakpoint' => [3000, 90],
            'Between middle breakpoints' => [4500, 107.5],
            'Just below a breakpoint' => [3999, 99.99],
            'Just above a breakpoint' => [4001, 100.015],
            'Large gap between breakpoints' => [7500, 157.5]
        ];
    }

    #[Test]
    public function shouldThrowAnExceptionOnDuplicates(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FeeStructure(
            new BreakPoint(new Money(1000), new Money(50)),
            new BreakPoint(new Money(2000), new Money(90)),
            new BreakPoint(new Money(2000), new Money(100)) // Duplicated
        );
    }

    #[Test]
    public function shouldSortForInvalidOrder(): void
    {
        $feeStructure = new FeeStructure(
            new BreakPoint(new Money(3000), new Money(90)),
            new BreakPoint(new Money(1000), new Money(50)),
            new BreakPoint(new Money(2000), new Money(70))
        );

        $breakpoints = $feeStructure->getBreakpoints();
        $this->assertEquals(1000, $breakpoints[0]->amount());
        $this->assertEquals(2000, $breakpoints[1]->amount());
        $this->assertEquals(3000, $breakpoints[2]->amount());
    }
}
