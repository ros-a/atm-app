<?php

require_once ('../../src/BankAccount/BankAccount.php');
require_once ('../../src/Atm/Atm.php');

use PHPUnit\Framework\TestCase;
use App\Atm\Atm;
use App\BankAccount\BankAccount;

class BankAccountTest extends TestCase
{
    public function testWithdraw_success()
    {
        $atmStub = $this->createMock(Atm::class);
        $atmStub->method('getCashHeld')->willReturn(1000);
        $bankAccount = new BankAccount(12345678, 1234, 500, 100);
        $result = $bankAccount->withdraw(100, $atmStub, 1234);
        $this->assertEquals($result, 400);
    }

    public function testWithDraw_failure()
    {
        $atmStub = $this->createMock(Atm::class);
        $atmStub->method('getCashHeld')->willReturn(100);
        $bankAccount = new BankAccount(12345678, 1235, 10, 100);
        $result = $bankAccount->withdraw(100, $atmStub, 1234);
        $this->assertEquals($result, "ACCOUNT_ERR");
    }

    public function testWithdraw_malformed()
    {
        $bankAccount = new BankAccount(12345678, 1234, 500, 100);
        $this->expectException(TypeError::class);
        $bankAccount->withdraw("086", "90", "3097");
    }
}