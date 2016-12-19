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
  for ($i=0;$i<floor($len/2);$i++) {
    $next = ($i+($len+$i)/2)%$len;
      
    $presents[$i][1]+=$presents[$next][1];
    $presents[$next]=null;
    $left--;
    if ($left==1) {
      var_dump($presents[$i]);
      break;
    }
  }
  $presents = array_merge(array_slice($presents,$i),array_slice($presents,0,$i));
}