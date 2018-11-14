<?php
$inputs = file('input');
$trans = array();
$inserts = array();
foreach ($inputs as $input) {
    if (preg_match('/^(bot [0-9]+) gives low to ([a-z]+ [0-9]+) and high to ([a-z]+ [0-9]+)$/', trim($input), $matches)) {
        $trans[$matches[1]] = array($matches[2], $matches[3]);
    }
    if (preg_match('/^value ([0-9]+) goes to (bot [0-9]+)$/', trim($input), $matches)) {
        $inserts[] = array($matches[1], $matches[2]);
    }
}

function give($value, $to, $trans, $values)
{
    if (substr($to, 0, 6) == 'output') {
        $values[$to][] = $value;
        return $values;
    }
    if (!isset($values[$to])) {
        $values[$to] = $value;
        return $values;
    }
    $min = min($values[$to], $value);
    $max = max($value, $values[$to]);
    if (array($min, $max) == array(17, 61)) {
        echo $to;
    }
    unset($values[$to]);
    $values = give($min, $trans[$to][0], $trans, $values);
    $values = give($max, $trans[$to][1], $trans, $values);
    return $values;
}

$values = array();
foreach ($inserts as $insert) {
    $values = give($insert[0], $insert[1], $trans, $values);
}
