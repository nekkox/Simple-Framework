<?php

namespace Services;

use App\MockTester;
use PHPUnit\Framework\TestCase;

class MyTestClass extends TestCase
{
    public function test_it_returns():void
    {
        $mockTester = $this->getMockBuilder(MockTester::class)->getMock();
        $mockTester->method('getOne')->willReturn(10);
        $mockTester->method('getTwo')->willReturn(6);
        $this->assertEquals(10, $mockTester->getOne());
        $this->assertEquals(6, $mockTester->getTwo());
        $this->assertSame(6, $mockTester->getTwo());
    }

    public function test_SendRequest(): void
    {
        $transaction = new class extends Transaction
        {
            public static function start(array $data)
            {
                throw new ApiException();
            }
        };

        $this->assertFalse(sendRequest([], $transaction));
    }

}