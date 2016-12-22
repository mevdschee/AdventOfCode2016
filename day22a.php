<?php
$inputs = file('day22.txt');
$nodes = array();
foreach ($inputs as $input) {
  if (preg_match('/^\/dev\/grid\/node-x([0-9]+)-y([0-9]+)\s*([0-9]+)T\s*([0-9]+)T\s*([0-9]+)T\s*([0-9]+)%$/',trim($input),$matches)) {
    $x = $matches[1];
    $y = $matches[2];
    $s = $matches[3];
    $u = $matches[4];
    $a = $matches[5];
    $p = $matches[6];
    $nodes[] = (object)compact('x','y','s','u','a','p');
  }
}

$count = 0;
foreach ($nodes as $n1) {
  foreach ($nodes as $n2) {
    if ($n1->x != $n2->x || $n1->y != $n2->y) {
      if ($n1->u > 0 && $n1->u < $n2->a) {
        $count++;
      }
    }
  }
}

var_dump($count);