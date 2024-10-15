<?php

declare(strict_types=1);

use Mockery\Adapter\Phpunit\MockeryTestCase;
use PHPUnit\Framework\Attributes\Test;

class FooTest extends MockeryTestCase
{
    #[Test]
    public function shouldWork()
    {
        $sum = 1 + 1;

        $this->assertSame(2, $sum);
    }
}
