<?php

include_once('boot.php');
include 'animals_array.php';

use Cmd\Farm;
use Objects\Barn;

$barn = new Barn($animals ?? []);

$farm = new Farm($barn);

echo Farm::menu();
$input = readline('Enter a command: ');
while ($input !== 'exit'){
    $result = '';
    switch ($input){
        case 'add':
            echo 'Which type of animal you would like to add Cows, or Chickens?' . PHP_EOL;
            $typeKey = strtolower(readline('Enter an animal type (C)ow, (Ch)icken or "exit" to return: '));
            while ($typeKey !== 'exit' && !in_array($typeKey, array_keys(Farm::TYPES), true)){
                $typeKey = readline('Please enter a valid animal type (C)ow or (Ch)icken: ');
            }
            if ($typeKey === 'exit'){
                return;
            }
            $type = Farm::TYPES[$typeKey];

            $amount = readline('How many animals would you like to add: ');
            while (!is_numeric($amount) && $amount !== 'exit'){
                $amount = readline('Please enter a number or exit: ');
            }
            if ($amount === 'exit' || ((int) $amount) === 0) {
                break;
            }

            $result = $farm->add($type, (int) $amount);
            break;

        case 'remove':
            echo 'Which type of animal you would like to remove Cows, or Chickens?' . PHP_EOL;
            $typeKey = strtolower(readline('Enter an animal type (C)ow, (Ch)icken or "exit" to return: '));
            while ($typeKey !== 'exit' && !in_array($typeKey, array_keys(Farm::TYPES), true)){
                $typeKey = readline('Please enter a valid animal type (C)ow or (Ch)icken: ');
            }
            if ($typeKey === 'exit'){
                return;
            }
            $type = Farm::TYPES[$typeKey];

            $amount = readline('How many animals would you like to remove: ');
            while (!is_numeric($amount) && $amount !== 'exit'){
                $amount = readline('Please enter a number or exit: ');
            }
            if ($amount === 'exit' || ((int) $amount) === 0) {
                break;
            }

            $result = $farm->remove($type, $amount);
            break;

        default:
            if (method_exists(Farm::class, $input)) {
                $result = $farm->$input();
            } else {
                $result .= '"' . $input . '" is not a valid command. ' . PHP_EOL;
                $result .= 'Please enter a valid command!' . PHP_EOL;
            }
    }
    echo $result . PHP_EOL;

    echo Farm::menu();
    $input = readline('Enter a command: ');
}
