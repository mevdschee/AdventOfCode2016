<?php
$lines = file('day03.txt');
for ($i=0;$i<count($lines);$i++) {
  $lines[$i] = preg_split('/\s+/',trim($lines[$i]));
}
$possible = 0;
for ($c=0;$c<3;$c++) {
  for ($i=0;$i<count($lines);$i+=3) {
    $t = array($lines[$i][$c],$lines[$i+1][$c],$lines[$i+2][$c]);
    if ($t[0]+$t[1]>$t[2] && $t[1]+$t[2]>$t[0] && $t[2]+$t[0]>$t[1]) $possible++;
  }
}
var_dump($possible);