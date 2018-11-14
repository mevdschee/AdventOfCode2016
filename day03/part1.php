<?php
$lines = file('input');
for ($i = 0; $i < count($lines); $i++) {
    $lines[$i] = preg_split('/\s+/', trim($lines[$i]));
}
$possible = 0;
for ($i = 0; $i < count($lines); $i++) {
    $t = $lines[$i];
    if ($t[0] + $t[1] > $t[2] && $t[1] + $t[2] > $t[0] && $t[2] + $t[0] > $t[1]) {
        $possible++;
    }
}
echo $possible;
