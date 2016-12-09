<?php
$str = trim(file_get_contents('day09.txt'));

function decode($str) {
  $decoded = '';
  $current = 0;
  while (true) {
    $start = strpos($str,'(',$current);
    if ($start===false) {
        $decoded .= substr($str,$current);
        break;
    }
    $decoded .= substr($str,$current,$start-$current);
    $end = strpos($str,')',$start)+1;
    $instruction = substr($str,$start,$end-$start);
    $instruction = explode('x',trim($instruction,'()'));
    $repeat = substr($str,$end,$instruction[0]);
    $decoded .= str_repeat($repeat,$instruction[1]);
    $current = $end+$instruction[0];
  }
  return strlen($decoded);  
}
 
var_dump(decode($str));