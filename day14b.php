<?php
function cached_md5($salt,$str){
  static $cache=array();
  if (isset($cache[$str])) return $cache[$str];
  $hash = md5($salt.$str);
  for ($i=0;$i<2016;$i++) {
    $hash = md5($hash);
  }
  $cache[$str] = $hash;
  return $hash;
}

$salt = trim(file_get_contents('day14.txt'));
$keys = array();
for ($i=0;count($keys)<64;$i++) {
  $hash = cached_md5($salt,$i);
  if (!preg_match('/([a-z0-9])\1\1/',$hash,$matches)) continue;
  for ($j=$i+1;$j<$i+1001;$j++) {
    $hash = cached_md5($salt,$j);
    if (strpos($hash,str_repeat($matches[1],5))!==false) {
        $keys[]=$i;
        break;
    }
  }
}
var_dump($keys[63]);
