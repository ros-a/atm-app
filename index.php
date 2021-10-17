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

// instantiating Atm with amount of cash held, and removing these lines from $input
$atm = new Atm((int)$input[0]);
array_splice($input, 0, 2);

// dividing $input into multidimensional array of separate sessions
$sessions = [];
$i = 0;
foreach ($input as $line) {
    $line = trim($line);
    if(strpos($line, " ")) {
        $line = explode(" ", $line);
    }
    if(!$line) {
        $i++;
        continue;
    }
    $sessions[$i][] = $line;
}

// instantiating BankAccounts for each session
$output = [];
foreach ($sessions as $session) {
    $accountNr = (int)$session[0][0];
    $pin = (int)$session[0][1];
    $pinEntered = (int)$session[0][2];
    $balance = (int)$session[1][0];
    $overdraftFacility = (int)$session[1][1];
    $bankAccount = new BankAccount($accountNr, $pin, $balance, $overdraftFacility);
    $transactions = array_slice($session, 2);
}
