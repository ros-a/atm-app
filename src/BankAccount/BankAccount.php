<?php declare(strict_types=1);

namespace App\BankAccount;
use App\Atm\Atm;

class BankAccount
{
    private int $accountNr;
    private int $pin;
    private int $balance;
    private int $overdraftFacility;

    public function __construct(int $accountNr, int $pin, int $balance, int $overdraftFacility) {
        $this->accountNr = $accountNr;
        $this->pin = $pin;
        $this->balance = $balance;
        $this->overdraftFacility = $overdraftFacility;
    }
}