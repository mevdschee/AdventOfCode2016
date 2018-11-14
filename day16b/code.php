<?php
$input = trim(file_get_contents('input'));
$length = 35651584;

function dragon_curve($str, $len)
{
    $start = strlen($str) - 1;
    $str .= '0';
    for ($i = $start; $i >= 0; $i--) {
        if ($str[$i] == '1') {
            $str .= '0';
        } else {
            $str .= '1';
        }
    }
    if (strlen($str) < $len) {
        $str = dragon_curve($str, $len);
    }
    return substr($str, 0, $len);
}

function dragon_sum($str)
{
    $sum = '';
    for ($i = 0; $i < strlen($str) - 1; $i += 2) {
        if ($str[$i] == $str[$i + 1]) {
            $sum .= '1';
        } else {
            $sum .= '0';
        }
    }
    while (strlen($sum) % 2 == 0) {
        $sum = dragon_sum($sum);
    }
    return $sum;
}

echo dragon_sum(dragon_curve($input, $length));
