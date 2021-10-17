<?php declare(strict_types=1);

require 'vendor/autoload.php';
use App\Atm\Atm;
use App\BankAccount\BankAccount;

// opening file and putting all content into an indexed array named $input
$file = fopen($argv[1], "r");
$input = [];
while (!feof($file)) {
    $input[] = fgets($file);
}
