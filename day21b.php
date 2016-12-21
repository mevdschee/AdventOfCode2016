<?php
$inputs = file('day21.txt');
$str = 'fbgdceah';

function apply($str,$inputs) {
  foreach ($inputs as $input) {
    if (preg_match('/^swap position ([0-9]+) with position ([0-9]+)$/',trim($input),$matches)) {
      $a = $matches[1];
      $b = $matches[2];
      $tmp = $str[$a];
      $str[$a]=$str[$b];
      $str[$b]=$tmp;
    }
    if (preg_match('/^swap letter ([a-z]+) with letter ([a-z]+)$/',trim($input),$matches)) {
      $a = strpos($str,$matches[1]);
      $b = strpos($str,$matches[2]);
      $tmp = $str[$a];
      $str[$a]=$str[$b];
      $str[$b]=$tmp;
    }
    if (preg_match('/^rotate (left|right) ([0-9]+) steps?$/',trim($input),$matches)) {
      $a = $matches[1];
      $b = $matches[2];
      if ($a=='right') {
        $b = strlen($str)-$b;
      } 
      $str = substr($str,$b).substr($str,0,$b);
    }
    if (preg_match('/^move position ([0-9]+) to position ([0-9]+)$/',trim($input),$matches)) {
      $a = $matches[1];
      $b = $matches[2];
      $tmp = $str[$a];
      if ($a<$b) {
        $str = substr($str,0,$b+1).$tmp.substr($str,$b+1);
        $str = substr($str,0,$a).substr($str,$a+1);
      } else {
        $str = substr($str,0,$a).substr($str,$a+1);
        $str = substr($str,0,$b).$tmp.substr($str,$b);
      }
    }
    if (preg_match('/^rotate based on position of letter ([a-z]+)$/',trim($input),$matches)) {
      $a = strpos($str,$matches[1]);
      $r = strlen($str)-(1+$a+($a>=4?1:0));
      $str = substr($str,$r).substr($str,0,$r);
    }
    if (preg_match('/^reverse positions ([0-9]+) through ([0-9]+)$/',trim($input),$matches)) {
      $a = $matches[1];
      $l = $matches[2]+1-$a;
      $str = substr($str,0,$a).strrev(substr($str,$a,$l)).substr($str,$a+$l);
    }
  }
  return $str;
}

function combinations($prefix,$letters,&$results) {
  if (strlen($letters)==0) {
    $results[] = $prefix;
  } else {
    for ($i=0;$i<strlen($letters);$i++) {
      combinations($prefix.$letters[$i],substr($letters,0,$i).substr($letters,$i+1),$results);
    }
  }
}

$results = array();
combinations('',$str,$results);
foreach ($results as $result) {
  if (apply($result,$inputs)==$str) {
    var_dump($result);
    break;
  }
}
