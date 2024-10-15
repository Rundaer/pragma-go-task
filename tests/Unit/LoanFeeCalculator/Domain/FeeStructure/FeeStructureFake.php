<?php

declare(strict_types=1);

namespace Tests\PragmaGoTech\Interview\Unit\LoanFeeCalculator\Domain\FeeStructure;

use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\BreakPoint;
use PragmaGoTech\Interview\LoanFeeCalculator\Domain\FeeStructure\FeeStructure;
use PragmaGoTech\Interview\Shared\Domain\ValueObject\Money;

class FeeStructureFake
{
    public static function get(int $term): ?FeeStructure
    {
        if ($term === 12) {
            return self::term12();
        } elseif ($term === 24) {
            return self::term24();
        }

        return null;
    }

    public static function term12(): FeeStructure
    {
        return new FeeStructure(
            new BreakPoint(new Money(1000), new Money(50)),
            new BreakPoint(new Money(2000), new Money(90)),
            new BreakPoint(new Money(3000), new Money(90)),
            new BreakPoint(new Money(4000), new Money(115)),
            new BreakPoint(new Money(5000), new Money(100)),
            new BreakPoint(new Money(6000), new Money(120)),
            new BreakPoint(new Money(7000), new Money(140)),
            new BreakPoint(new Money(8000), new Money(160)),
            new BreakPoint(new Money(9000), new Money(180)),
            new BreakPoint(new Money(10000), new Money(200)),
            new BreakPoint(new Money(11000), new Money(220)),
            new BreakPoint(new Money(12000), new Money(240)),
            new BreakPoint(new Money(13000), new Money(260)),
            new BreakPoint(new Money(14000), new Money(280)),
            new BreakPoint(new Money(15000), new Money(300)),
            new BreakPoint(new Money(16000), new Money(320)),
            new BreakPoint(new Money(17000), new Money(340)),
            new BreakPoint(new Money(18000), new Money(360)),
            new BreakPoint(new Money(19000), new Money(380)),
            new BreakPoint(new Money(20000), new Money(400))
        );
    }

    public static function term24(): FeeStructure
    {
        return new FeeStructure(
            new BreakPoint(new Money(1000), new Money(70)),
            new BreakPoint(new Money(2000), new Money(100)),
            new BreakPoint(new Money(3000), new Money(120)),
            new BreakPoint(new Money(4000), new Money(160)),
            new BreakPoint(new Money(5000), new Money(200)),
            new BreakPoint(new Money(6000), new Money(240)),
            new BreakPoint(new Money(7000), new Money(280)),
            new BreakPoint(new Money(8000), new Money(320)),
            new BreakPoint(new Money(9000), new Money(360)),
            new BreakPoint(new Money(10000), new Money(400)),
            new BreakPoint(new Money(11000), new Money(440)),
            new BreakPoint(new Money(12000), new Money(480)),
            new BreakPoint(new Money(13000), new Money(520)),
            new BreakPoint(new Money(14000), new Money(560)),
            new BreakPoint(new Money(15000), new Money(600)),
            new BreakPoint(new Money(16000), new Money(640)),
            new BreakPoint(new Money(17000), new Money(680)),
            new BreakPoint(new Money(18000), new Money(720)),
            new BreakPoint(new Money(19000), new Money(760)),
            new BreakPoint(new Money(20000), new Money(800))
        );
    }
}
