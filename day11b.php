<?php
$generators = array('dig','elg','plg','prg','rug','stg','thg');
$microchips = array('dim','elm','plm','prm','rum','stm','thm');
// for $floors values, see: day11.txt
$floors = array(
  array('dig','dim','elg','elm','plg','stg','thg','thm'),
  array('plm','stm'),
  array('prg','prm','rug','rum'),
  array(),
);
$visited = array();

function move($floors,$floor,$pos,$direction){
  $nfloors = array();
  for ($f=0;$f<count($floors);$f++) {
    $nfloors[$f] = array();
    for ($i=0;$i<count($floors[$f]);$i++) {
      if ($f!=$floor || !in_array($i,$pos)) {
        $nfloors[$f][] = $floors[$f][$i];
      } 
    }
  }
  foreach ($pos as $p) {
    $nfloors[$floor+$direction][] = $floors[$floor][$p];
  }
  sort($nfloors[$floor+$direction]);
  return $nfloors;
}

function valid($floors) {
  global $generators,$microchips,$visited;
  for ($f=0;$f<count($floors);$f++) {
    foreach ($microchips as $i=>$microchip) {
      if (in_array($microchip,$floors[$f]) && !in_array($generators[$i],$floors[$f])) {
        foreach ($generators as $generator) {
          if (in_array($generator,$floors[$f])) {
            return false;
          }
        }
      }
    }
  }
  return true;
}

function visited($e,$floors) {
  global $visited;
  $json = md5(json_encode(array($e,$floors)));
  if (isset($visited[$json])) {
    return true;
  }
  $visited[$json]=true;
  return false;
}

function done($floors) {
  global $generators,$microchips;
  return count($floors[count($floors)-1])==count($generators)+count($microchips);
}

$current = array(json_encode(array(0,$floors)));
$steps = 0;
while (count($current)) {
  $previous = $current;
  $current = array();
  foreach ($previous as $json) {
    list($e,$floors) = json_decode($json);
    if (done($floors)) {
      var_dump($steps);
      $current = array();
      break;
    }
    if (valid($floors) && !visited($e,$floors)) {
      foreach (array(-1,1) as $m) {
        if (isset($floors[$e+$m])) {
          for ($i=0;$i<count($floors[$e]);$i++) {
            $current[] = json_encode(array($e+$m,move($floors,$e,array($i),$m)));
            for ($j=$i+1;$j<count($floors[$e]);$j++) {
              $current[] = json_encode(array($e+$m,move($floors,$e,array($i,$j),$m)));
            }
          }
        }
      }
    }
  }
  $steps++;
}