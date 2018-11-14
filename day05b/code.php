<?php
$key = file_get_contents('input');
$i = 0;
$pwd = str_repeat('.', 8);
do {
    $hash = md5($key . $i);
    if (substr($hash, 0, 5) === '00000') {
        $pos = $hash[5];
        $chr = $hash[6];
        if (is_numeric($pos) && $pos < 8 && $pwd[$pos] === '.') {
            $pwd[$pos] = $chr;
        }
    }
    $i++;
} while (strpos($pwd, '.') !== false);
echo $pwd;
