<?php

function clock($init)
{
    $i = 0;
    $inputs = file('input');
    $registers = array('a' => $init, 'b' => 0, 'c' => 0, 'd' => 0);
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
                if (!is_numeric($parts[2])) {
                    $parts[2] = $registers[$parts[2]];
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
            case 'out':
                if (!is_numeric($parts[1])) {
                    $parts[1] = $registers[$parts[1]];
                }
                if ($parts[1] != $i % 2) {
                    return false;
                }
                $i++;
                if ($i == 10000) {
                    return true;
                }
                break;
        }
        $pc++;
        //echo json_encode($registers)."\n";
    } while ($pc < count($inputs));
    //echo $registers['a'];
}

for ($i = 0; true; $i++) {
    if (clock($i)) {
        echo $i;
        break;
    }
}
