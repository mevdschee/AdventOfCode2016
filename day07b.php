<?php
$inputs = file('day07.txt');
$sum = 0;
foreach ($inputs as $input){
  $strs = array('','');
  $input = str_replace('[',']',trim($input));
  foreach (explode(']',$input) as $i=>$str) {
    $strs[$i%2].=' '.$str;
  }
  preg_match_all('/([a-z])(?=([a-z])\1)/',$strs[0],$matches);
  for ($i=0;$i<count($matches[0]);$i++) {
    if ($matches[1][$i]===$matches[2][$i]) {
      continue;
    }
    $bab = $matches[2][$i].$matches[1][$i].$matches[2][$i];
    if (strpos($strs[1],$bab)!==false) {
      $sum++;
      break;
    }
  }
}
var_dump($sum);