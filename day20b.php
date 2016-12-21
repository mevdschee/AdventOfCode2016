<?php
$inputs = file('day20.txt');
$list = array();
foreach ($inputs as $j=>$input) {
  $range = explode('-',trim($input));
  $key = sprintf("%032b",$range[0]);
  $list[$key]=$range;
}
ksort($list);
$lowest = 0;
$allowed = 0;
foreach ($list as $range) {
  if ($lowest<$range[0]) {
    $allowed += $range[0]-$lowest;
    $lowest = $range[0];
  }
  $lowest = max($lowest,$range[1]+1);
}
var_dump($allowed);