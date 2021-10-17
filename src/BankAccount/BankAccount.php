<?php declare(strict_types=1);

namespace App\BankAccount;
use App\Atm\Atm;
use phpDocumentor\Reflection\Types\Boolean;

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

    public function getBalance(): int {
        return $this->balance;
    }

    public function checkPin(int $pinEntered): bool {
        return $this->pin === $pinEntered;
    }

    public function withdraw(int $amount, Atm $atm, int $pinEntered) {
        // check if atm has sufficient cash
        if ($atm->getCashHeld() < $amount) return 'ATM_ERR';
        // check if user entered correct pin
        if (!($this->checkPin($pinEntered))) return 'ACCOUNT_ERR';
        // check if balance is sufficient, if so withdraw amount and return new balance
        if ($this->balance >= $amount) {
            $atm->deduct($amount);
            $this->balance -= $amount;
            return $this->balance;
        }
        // if balance insufficient, and overdraft facility is also insufficient, return error
        if ($amount > ($this->balance + $this->overdraftFacility)) return 'FUNDS_ERR';

        // if sufficient overdraft facility, withdraw money using overdraft and return new balance
        $overdraftAmount = $amount - $this->balance;
        $this->balance = 0;
        $this->overdraftFacility -= $overdraftAmount;
        return $this->balance;
    }
}