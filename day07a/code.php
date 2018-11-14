<?php
$inputs = file('input');
$sum = 0;
foreach ($inputs as $input) {
    $strs = array('', '');
    $input = str_replace('[', ']', trim($input));
    foreach (explode(']', $input) as $i => $str) {
        $strs[$i % 2] .= ' ' . $str;
    }
    $abba = function ($s) {
        if (preg_match('/([a-z])([a-z])\2\1/', $s, $matches)) {
            if ($matches[1] !== $matches[2]) {
                return true;
            }
        }
        return false;
    };
    if ($abba($strs[0]) && !$abba($strs[1])) {
        $sum++;
    }

}
echo $sum;
