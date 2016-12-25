<?php

function run($init) {
  $inputs = file('day23.txt');
  $registers = array('a'=>$init,'b'=>0,'c'=>0,'d'=>0);
  $pc = 0;
  do {
    $parts = explode(' ',trim($inputs[$pc]));
    switch($parts[0]) {
      case 'cpy':
        if (!is_numeric($parts[1])) $parts[1] = $registers[$parts[1]];
        if (isset($registers[$parts[2]])) $registers[$parts[2]] = $parts[1];
        break;
      case 'jnz':
        if (!is_numeric($parts[1])) $parts[1] = $registers[$parts[1]];
        if (!is_numeric($parts[2])) $parts[2] = $registers[$parts[2]];
        if ($parts[1]) $pc+=$parts[2]-1;
        break;
      case 'inc':
        if (isset($registers[$parts[1]])) $registers[$parts[1]]++;
        break;
      case 'dec':
        if (isset($registers[$parts[1]])) $registers[$parts[1]]--;
        if ($parts[1]=='b') echo json_encode($registers)."\n";
        break;
      case 'tgl':
        if (!is_numeric($parts[1])) $parts[1] = $registers[$parts[1]];
        $ic = $pc+$parts[1];
        if ($ic<count($inputs)) {
          $parts2 = explode(' ',trim($inputs[$ic]));
          if (count($parts2)==2) {
              if ($parts2[0]=='inc') $parts2[0]='dec';
              else $parts2[0]='inc';
          } elseif (count($parts2)==3) {
              if ($parts2[0]=='jnz') $parts2[0]='cpy';
              else $parts2[0]='jnz';
          }
          $inputs[$ic] = implode(' ',$parts2);
        }
        break;
    }
    $pc++;
  } while ($pc<count($inputs));
  return $registers['a'];
}

for ($i=6;$i<10;$i++) {
  echo $i.': '.run($i)."\n";
}

function factorial($n) {
  $product = array_product(range(1,++$n));
  return $product / $n;
}

var_dump(factorial(12)+5964);