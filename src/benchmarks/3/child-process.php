<?php

$i = $argv[1];
$sleep = 1;

if ($i % 2 === 0) {
    $sleep = 2;
} else if ($i % 3 === 0) {
    $sleep = 3;
}

sleep($sleep);
