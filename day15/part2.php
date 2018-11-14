<?php
$inputs = file('input');
$discs = array();
$modulos = array();
foreach ($inputs as $input) {
    if (preg_match('/^Disc #([0-9]+) has ([0-9]+) positions; at time=0, it is at position ([0-9]+).$/', trim($input), $matches)) {
        $discs[$matches[1]] = $matches[3];
        $modulos[$matches[1]] = $matches[2];
    }
}
$d = count($discs) + 1;
$discs[$d] = 0;
$modulos[$d] = 11;
for ($t = 0; true; $t++) {
    $aligned = 0;
    foreach ($discs as $d => $p) {
        $m = $modulos[$d];
        if (($t + $d + $p) % $m == 0) {
            $aligned++;
        }
    }
    if ($aligned == count($discs)) {
        break;
    }
}
echo $t;
