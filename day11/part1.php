<?php
list($generators, $microchips, $floors) = parse("input");
$visited = array();

function parse($file)
{
    $lines = file($file);

    $floors = array();
    foreach ($lines as $i => $line) {
        $floors[$i] = array();
    }

    $generators = array();
    foreach ($lines as $i => $line) {
        if (preg_match_all('/([a-z][a-z])[a-z]* generator/', $line, $matches)) {
            foreach ($matches[1] as $match) {
                $generator = $match . "g";
                $generators[] = $generator;
                $floors[$i][] = $generator;
            }
        }
    }
    $generators = array_unique($generators);

    $microchips = array();
    foreach ($lines as $i => $line) {
        if (preg_match_all('/([a-z][a-z])[a-z]*-compatible microchip/', $line, $matches)) {
            foreach ($matches[1] as $match) {
                $microchip = $match . "m";
                $microchips[] = $microchip;
                $floors[$i][] = $microchip;
            }
        }
    }
    $microchips = array_unique($microchips);

    foreach ($floors as $i => $floor) {
        sort($floors[$i]);
    }

    return array($generators, $microchips, $floors);
}

function move($floors, $floor, $pos, $direction)
{
    $nfloors = array();
    for ($f = 0; $f < count($floors); $f++) {
        $nfloors[$f] = array();
        for ($i = 0; $i < count($floors[$f]); $i++) {
            if ($f != $floor || !in_array($i, $pos)) {
                $nfloors[$f][] = $floors[$f][$i];
            }
        }
    }
    foreach ($pos as $p) {
        $nfloors[$floor + $direction][] = $floors[$floor][$p];
    }
    sort($nfloors[$floor + $direction]);
    return $nfloors;
}

function valid($floors)
{
    global $generators, $microchips;
    for ($f = 0; $f < count($floors); $f++) {
        foreach ($microchips as $i => $microchip) {
            if (in_array($microchip, $floors[$f]) && !in_array($generators[$i], $floors[$f])) {
                foreach ($generators as $generator) {
                    if (in_array($generator, $floors[$f])) {
                        return false;
                    }
                }
            }
        }
    }
    return true;
}

function visited($e, $floors)
{
    global $visited;
    $json = json_encode(array($e, $floors));
    if (isset($visited[$json])) {
        return true;
    }
    $visited[$json] = true;
    return false;
}

function done($floors)
{
    global $generators, $microchips;
    return count($floors[count($floors) - 1]) == count($generators) + count($microchips);
}

$current = array(array(0, $floors));
$steps = 0;
while (count($current)) {
    $previous = $current;
    $current = array();
    foreach ($previous as list($e, $floors)) {
        if (done($floors)) {
            echo $steps;
            $current = array();
            break;
        }
        if (valid($floors) && !visited($e, $floors)) {
            foreach (array(-1, 1) as $m) {
                if (isset($floors[$e + $m])) {
                    for ($i = 0; $i < count($floors[$e]); $i++) {
                        $current[] = array($e + $m, move($floors, $e, array($i), $m));
                        for ($j = $i + 1; $j < count($floors[$e]); $j++) {
                            $current[] = array($e + $m, move($floors, $e, array($i, $j), $m));
                        }
                    }
                }
            }
        }
    }
    $steps++;
}
