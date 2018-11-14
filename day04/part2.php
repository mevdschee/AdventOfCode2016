<?php
$inputs = file('input');
$decoded = array();
foreach ($inputs as $input) {
    if (!preg_match('/([a-z\-]+)\-([0-9]+)\[([a-z]+)\]/', $input, $matches)) {
        die('parse error');
    }
    list($name, $sector, $checksum) = array($matches[1], $matches[2], $matches[3]);
    $letters = array_count_values(str_split($name));
    unset($letters['-']);
    arsort($letters);
    $groups = array();
    foreach ($letters as $letter => $count) {
        $groups[$count][] = $letter;
    }
    $check = '';
    foreach ($groups as $group) {
        sort($group);
        $check .= implode('', $group);
    }
    if ($checksum == substr($check, 0, 5)) {
        for ($i = 0; $i < strlen($name); $i++) {
            if ($name[$i] == '-') {
                $name[$i] = ' ';
            } else {
                $name[$i] = chr((ord($name[$i]) - 97 + $sector) % 26 + 97);
            }
        }
        $decoded[$name] = $sector;
    }
}
echo $decoded['northpole object storage'];
