<?php
$inputs = file('day22.txt');
$empty = array(0,0);
$field = array();
foreach ($inputs as $input) {
  if (preg_match('/^\/dev\/grid\/node-x([0-9]+)-y([0-9]+)\s*([0-9]+)T\s*([0-9]+)T\s*([0-9]+)T\s*([0-9]+)%$/',trim($input),$matches)) {
    $x = $matches[1];
    $y = $matches[2];
    $p = $matches[6];
    if (!isset($field[$y])) $field[$y]='';
    while (!isset($field[$y][$x])) $field[$y].=' ';
    if ($p==0) {
      $empty = array($x,$y); 
      $field[$y][$x] = '_';
    } elseif ($p>90) {
      $field[$y][$x] = '#';
    } else {
      $field[$y][$x] = '.';
    }
  }
}
$field[0][strlen($field[0])-1]='S';
$field[0][0]='T';

function step($field) {
  if ($field[0][strlen($field[0])-2]=='_') {
    return 0;
  }
  $next = array();
  for ($y=0;$y<count($field);$y++) {
    $next[$y] = $field[$y];
  }
  for ($y=0;$y<count($field);$y++) {
    for ($x=0;$x<strlen($field[$y]);$x++) {
      if ($field[$y][$x]=='_') {
        $next[$y][$x] = '-';
        if ($y-1>=0 && $next[$y-1][$x]=='.') {
          $next[$y-1][$x] = '_';
        }
        if ($y+1<count($next) && $next[$y+1][$x]=='.') {
          $next[$y+1][$x] = '_';
        }
        if ($x-1>=0 && $next[$y][$x-1]=='.') {
          $next[$y][$x-1] = '_';
        }
        if ($x+1<strlen($next[$y]) && $next[$y][$x+1]=='.') {
          $next[$y][$x+1] = '_';
        }
      }
    }
  }
  return step($next)+1;
}

echo step($field)+5*(strlen($field[0])-2)+1;