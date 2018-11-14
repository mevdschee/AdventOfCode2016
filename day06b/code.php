<?php
$inputs = file('input');
$columns = array();
for ($i = 0; $i < strlen(trim($inputs[0])); $i++) {
    $columns[$i] = array();
    foreach ($inputs as $input) {
        $columns[$i][] = $input[$i];
    }
}
$pwd = '';
foreach ($columns as $column) {
    $counts = array_count_values($column);
    asort($counts);
    $keys = array_keys($counts);
    $pwd .= $keys[0];
}
echo $pwd;
