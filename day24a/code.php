<?php
$field = array_map('trim', file('input'));
$numbers = numbers($field);

function numbers($field)
{
    $width = strlen($field[0]);
    $height = count($field);
    $numbers = array();
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $f = $field[$y][$x];
            if (is_numeric($f)) {
                $numbers[$f] = array($x, $y);
            }
        }
    }
    return $numbers;
}

function nfield($field)
{
    $width = strlen($field[0]);
    $height = count($field);
    $next = array();
    for ($y = 0; $y < $height; $y++) {
        $next[$y] = $field[$y];
    }
    return $next;
}

function ndistances($field, $num, $numbers, &$distances, $steps)
{
    $width = strlen($field[0]);
    $height = count($field);
    $next = nfield($field);
    $done = true;
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            if (is_numeric($field[$y][$x]) && $field[$y][$x] == $num) {
                foreach ($numbers as $n => $p) {
                    if ($p == array($x, $y)) {
                        if (!isset($distances[$num])) {
                            $distances[$num] = array();
                        }
                        $distances[$num][$n] = $steps;
                    }
                }
                $done = false;
                $next[$y][$x] = '#';
                if ($y - 1 >= 0 && $next[$y - 1][$x] != '#') {
                    $next[$y - 1][$x] = $num;
                }
                if ($y + 1 < count($next) && $next[$y + 1][$x] != '#') {
                    $next[$y + 1][$x] = $num;
                }
                if ($x - 1 >= 0 && $next[$y][$x - 1] != '#') {
                    $next[$y][$x - 1] = $num;
                }
                if ($x + 1 < strlen($next[$y]) && $next[$y][$x + 1] != '#') {
                    $next[$y][$x + 1] = $num;
                }
            }
        }
    }
    if (!$done) {
        ndistances($next, $num, $numbers, $distances, $steps + 1);
    }
}

function distances($field, $numbers)
{
    $distances = array();
    foreach (array_keys($numbers) as $num) {
        ndistances($field, $num, $numbers, $distances, 0);
    }
    return $distances;
}

function combinations($prefix, $numbers, &$combinations)
{
    if (strlen($numbers) == 0) {
        $combinations[] = $prefix;
    }
    for ($i = 0; $i < strlen($numbers); $i++) {
        combinations($prefix . $numbers[$i], substr($numbers, 0, $i) . substr($numbers, $i + 1), $combinations);
    }
}

$paths = array();
$keys = array_keys($numbers);
unset($keys[array_search(0, $keys)]);
combinations('0', implode('', $keys), $paths);

$distances = distances($field, $numbers);

$best = -1;
foreach ($paths as $path) {
    $len = 0;
    for ($i = 0; $i < strlen($path) - 1; $i++) {
        $len += $distances[$path[$i]][$path[$i + 1]];
    }
    if ($best == -1 || $len < $best) {
        $best = $len;
    }
}
echo $best;
