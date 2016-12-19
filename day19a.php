<?php
$elves = trim(file_get_contents('day19.txt'));
$presents = array();
for ($i=0;$i<$elves;$i++) {
  $presents[$i]=$i+1;
}

$left = $elves;
while ($left>1){
  $presents = array_merge(array_filter($presents)); 
  $len = count($presents);
  for ($i=0;$i<$len;$i+=2) {  
    $next = ($i+1)%$len;
      
    $presents[$next]=0;
    $left--;
    if ($left==1) {
      var_dump($presents[$i]);
      break;
    } 
  }
}