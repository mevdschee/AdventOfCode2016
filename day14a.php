<?php
$salt = trim(file_get_contents('day14.txt'));
$keys = array();
for ($i=0;count($keys)<64;$i++) {
  $hash = md5($salt.$i);
  if (!preg_match('/([a-z0-9])\1\1/',$hash,$matches)) continue;
  for ($j=$i+1;$j<$i+1001;$j++) {
    $hash = md5($salt.$j);
    if (strpos($hash,str_repeat($matches[1],5))!==false) {
        $keys[]=$i;
        break;
    }
  }
}
var_dump($keys[63]);
