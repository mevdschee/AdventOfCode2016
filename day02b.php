<?php
$inputs = file('day02.txt');
$keys = array(array(0,0,1,0,0),array(0,2,3,4,0),array(5,6,7,8,9),array(0,'A','B','C',0),array(0,0,'D',0,0));
$x=0;
$y=2;
$code = array();
foreach($inputs as $input) {
  $chars = str_split(trim($input));
  foreach ($chars as $c) {
    switch($c) {
      case 'U': if ($y-1>=0 && $keys[$x][$y-1]) $y--; break;
      case 'L': if ($x-1>=0 && $keys[$x-1][$y]) $x--; break;
      case 'D': if ($y+1<=4 && $keys[$x][$y+1]) $y++; break;
      case 'R': if ($x+1<=4 && $keys[$x+1][$y]) $x++; break;
      default: die('parse error');
    }
  }
  $code[] = $keys[$y][$x];
}
var_dump(implode('',$code));
