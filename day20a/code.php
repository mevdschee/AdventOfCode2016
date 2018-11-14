<?php
$inputs = file('input');
$list = array();
foreach ($inputs as $j => $input) {
    $range = explode('-', trim($input));
    $key = sprintf("%032b", $range[0]);
    $list[$key] = $range;
}
ksort($list);
$lowest = 0;
foreach ($list as $range) {
    if ($lowest < $range[0]) {
        break;
    }
    $lowest = max($lowest, $range[1] + 1);
}
echo $lowest;
