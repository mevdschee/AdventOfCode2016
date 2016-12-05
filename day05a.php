<?php
$key = file_get_contents('day05.txt');
$i=0;
$pwd = '';
do {
    $hash = md5($key.$i);
    if (substr($hash,0,5)==='00000') $pwd.=$hash[5];
    $i++;
} while (strlen($pwd)<8);
var_dump($pwd);