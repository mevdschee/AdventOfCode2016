<?php
$inputs = file('day06.txt');
$columns = array();
for ($i=0;$i<strlen(trim($inputs[0]));$i++) {
  $columns[$i]=array();
  foreach ($inputs as $input) {
    $columns[$i][]=$input[$i];
  }
}
$pwd = '';
foreach ($columns as $column) {
  $counts = array_count_values($column);
  arsort($counts);
  $keys = array_keys($counts);
  $pwd .= $keys[0];
}
var_dump($pwd);