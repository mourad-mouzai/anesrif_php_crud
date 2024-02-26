<?php declare(strict_types = 1);

function showInf(string $name, string | float $weigth){
    return ($name . "is " . $weigth);
}

echo showInf("roustom", 80.500);