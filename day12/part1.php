<?php
$inputs = file('input');
$registers = array('a' => 0, 'b' => 0, 'c' => 0, 'd' => 0);
$pc = 0;
do {
    $parts = explode(' ', trim($inputs[$pc]));
    switch ($parts[0]) {
        case 'cpy':
            if (!is_numeric($parts[1])) {
                $parts[1] = $registers[$parts[1]];
            }
            $registers[$parts[2]] = $parts[1];
            break;
        case 'jnz':
            if (!is_numeric($parts[1])) {
                $parts[1] = $registers[$parts[1]];
            }
            if ($parts[1]) {
                $pc += $parts[2] - 1;
            }
            break;
        case 'inc':
            $registers[$parts[1]]++;
            break;
        case 'dec':
            $registers[$parts[1]]--;
            break;
    }
    $pc++;
} while ($pc < count($inputs));
echo $registers['a'];
