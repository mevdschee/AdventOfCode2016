<?php
$elves = trim(file_get_contents('day19.txt'));
$presents = array();
for ($i=0;$i<$elves;$i++) {
  $presents[$i]=array($i+1,1);
}

$left = $elves;
while ($left>1){
  $presents = array_merge(array_filter($presents)); 
  $len = count($presents);
  for ($i=0;$i<$len;$i+=2) {  
    $next = ($i+1)%$len;
      
    $presents[$i][1]+=$presents[$next][1];
    $presents[$next]=null;
    $left--;
    if ($left==1) {
      var_dump($presents[$i][0]);
      break;
    } 
  }
}