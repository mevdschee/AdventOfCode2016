<?php
$inputs = file('input');
$field = array();
for ($i = 0; $i < 6; $i++) {
    $field[$i] = str_repeat('.', 50);
}
foreach ($inputs as $input) {
    if (preg_match('/rect ([0-9]+)x([0-9]+)/', trim($input), $matches)) {
        $w = $matches[1];
        $h = $matches[2];
        for ($i = 0; $i < $h; $i++) {
            $field[$i] = str_repeat('#', $w) . substr($field[$i], $w);
        }
    }
    if (preg_match('/rotate row y=([0-9]+) by ([0-9]+)/', trim($input), $matches)) {
        $y = $matches[1];
        $r = $matches[2];
        $field[$y] = substr($field[$y], -$r) . substr($field[$y], 0, -$r);
    }
    if (preg_match('/rotate column x=([0-9]+) by ([0-9]+)/', trim($input), $matches)) {
        $x = $matches[1];
        $r = $matches[2];
        $column = array();
        for ($i = 0; $i < 6; $i++) {
            $column[($i + $r) % 6] = $field[$i][$x];
        }
        for ($i = 0; $i < 6; $i++) {
            $field[$i][$x] = $column[$i];
        }
    }
    echo implode("\n", $field) . "\n\n";
}
$count = array_count_values(str_split(implode('', $field)));
