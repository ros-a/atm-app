<?php declare(strict_types=1);

namespace App\Atm;

class Atm
{
    private int $cashHeld;

    public function __construct(int $cash) {
        return $this->cashHeld = $cash;
    }

    public function getCashHeld(): int {
        return $this->cashHeld;
    }

    public function deduct(int $amount) {
        $this->cashHeld -= $amount;
    }
}