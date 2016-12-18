<?php
$line = trim(file_get_contents('day18.txt'));
$width = strlen($line);
$height = 400000;

$field = array();
for ($i=0;$i<$height;$i++) {
  $field[$i] = str_repeat(' ',$width);
}
$field[0] = $line;

for ($i=1;$i<$height;$i++) {
  for ($j=0;$j<$width;$j++) {
    $l = $j-1<0?'.':$field[$i-1][$j-1];
    $c = $field[$i-1][$j];
    $r = $j+1>=$width?'.':$field[$i-1][$j+1];
    $trap = (($l=='^'&&$c=='^'&&$r=='.') ||
             ($l=='.'&&$c=='^'&&$r=='^') ||
             ($l=='^'&&$c=='.'&&$r=='.') ||
             ($l=='.'&&$c=='.'&&$r=='^'));
    $field[$i][$j] = $trap?'^':'.';
  }
}

$counts = array_count_values(str_split(implode(' ',$field)));
var_dump($counts['.']);
