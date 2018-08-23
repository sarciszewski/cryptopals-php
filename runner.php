<?php
declare(strict_types=1);

require 'vendor/autoload.php';

if ($argc < 2) {
    echo 'Usage: php runner.php [challenge number]', PHP_EOL, "\t";
    echo 'Example:', PHP_EOL, "\t\t", 'php runner.php 33', PHP_EOL;
    exit(1);
}

if (!ctype_digit($argv[1])) {
    echo 'An integer is expected!', PHP_EOL;
    exit(2);
}

$challenge = (int) $argv[1];
$set = ($challenge >> 3) + 1;

if ($set < 0 || $set > 10) {
    echo "Invalid challenge set!", PHP_EOL;
    exit(4);
}

$class = "\\Sarciszewski\\Cryptopals\\Set{$set}\\Challenge{$challenge}";
if (!\class_exists($class)) {
    echo 'Challenge #' . $challenge . ' not found in Set ' . $set . '!', PHP_EOL;
    exit(8);
}

$object = new $class();
if (!($object instanceof \Sarciszewski\Cryptopals\Common\SolutionInterface)) {
    echo 'Challenge #' . $challenge . ' in Set ' . $set . ' does not implement the SolutionInterface!', PHP_EOL;
    exit(16);
}

// Finally, invoke the object:
$object();
