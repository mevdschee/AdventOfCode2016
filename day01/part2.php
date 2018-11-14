<?php
$inputs = explode(', ', file_get_contents('input'));
$x = 0;
$y = 0;
$d = 0;
$directions = array('N', 'E', 'S', 'W');
$positions = array("0,0");
foreach ($inputs as $input) {
    if ($input[0] == 'R') {
        $d = ($d + 1) % 4;
    } else {
        $d = ($d + 3) % 4;
    }
    for ($i = 0; $i < substr($input, 1); $i++) {
        switch ($directions[$d]) {
            case 'N':$y--;
                break;
            case 'E':$x++;
                break;
            case 'S':$y++;
                break;
            case 'W':$x--;
                break;
        }
        if (in_array("$x,$y", $positions)) {
            echo abs($x) + abs($y);
            exit(0);
        }
        $positions[] = "$x,$y";
    }
}
