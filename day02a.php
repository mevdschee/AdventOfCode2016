<?php
$inputs = file('day02.txt');
$keys = array(array(1,2,3),array(4,5,6),array(7,8,9));
$x=0;
$y=0;
$code = array();
foreach($inputs as $input) {
  $chars = str_split(trim($input));
  foreach ($chars as $c) {
    switch($c) {
      case 'U': if ($y-1>=0) $y--; break;
      case 'L': if ($x-1>=0) $x--; break;
      case 'D': if ($y+1<=2) $y++; break;
      case 'R': if ($x+1<=2) $x++; break;
      default: die('parse error');
    }
  }
  $code[] = $keys[$y][$x];
}
var_dump(implode('',$code));
