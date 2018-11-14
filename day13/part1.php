<?php
$input = file_get_contents('input') + 0;
$width = 50;
$height = 50;

function wall($x, $y)
{
    global $input;
    $sum = $x * $x + 3 * $x + 2 * $x * $y + $y + $y * $y + $input;
    $bits = array_count_values(str_split(decbin($sum)));
    return $bits[1] % 2 == 1;
}

function field()
{
    global $width, $height;
    $field = array();
    for ($y = 0; $y < $height; $y++) {
        $field[$y] = str_repeat(' ', $width);
        for ($x = 0; $x < $width; $x++) {
            $field[$y][$x] = wall($x, $y) ? '#' : '.';
        }
    }
    return $field;
}

function flood($field, $x1, $y1, $x2, $y2)
{
    global $width, $height;
    $field[$y1][$x1] = 'O';
    $steps = 0;
    while ($field[$y2][$x2] != 'O') {
        $nfield = array();
        $expansions = 0;
        for ($y = 0; $y < $height; $y++) {
            $nfield[$y] = $field[$y];
        }
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                if ($field[$y][$x] == 'O') {
                    $expansions++;
                    if ($y - 1 >= 0 && $field[$y - 1][$x] == '.') {
                        $nfield[$y - 1][$x] = 'O';
                    }
                    if ($y + 1 < $height && $field[$y + 1][$x] == '.') {
                        $nfield[$y + 1][$x] = 'O';
                    }
                    if ($x - 1 >= 0 && $field[$y][$x - 1] == '.') {
                        $nfield[$y][$x - 1] = 'O';
                    }
                    if ($x + 1 < $width && $field[$y][$x + 1] == '.') {
                        $nfield[$y][$x + 1] = 'O';
                    }
                    $nfield[$y][$x] = 'o';
                }
            }
        }
        if (!$expansions) {
            break;
        }
        $field = $nfield;
        $steps++;
    }
    return $steps;
}

$field = field();
echo flood($field, 1, 1, 31, 39);
