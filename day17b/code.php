<?php
$input = trim(file_get_contents('input'));
$size = array(4, 4);
$start = array(0, 0);
$target = array(3, 3);
$results = array();

function find($current)
{
    global $input, $target, $size, $results;
    $next = array();
    foreach ($current as list($prefix, $position)) {
        if ($position == $target) {
            $results[] = $prefix;
            continue;
        }
        $hash = md5($input . $prefix);
        list($x, $y) = $position;
        list($w, $h) = $size;
        foreach (array('U', 'D', 'L', 'R') as $i => $dir) {
            if (in_array($hash[$i], array('b', 'c', 'd', 'e', 'f'))) {
                switch ($dir) {
                    case 'U':
                        if ($y - 1 >= 0) {
                            $next[] = array($prefix . $dir, array($x, $y - 1));
                        }
                        break;
                    case 'D':
                        if ($y + 1 < $h) {
                            $next[] = array($prefix . $dir, array($x, $y + 1));
                        }
                        break;
                    case 'L':
                        if ($x - 1 >= 0) {
                            $next[] = array($prefix . $dir, array($x - 1, $y));
                        }
                        break;
                    case 'R':
                        if ($x + 1 < $w) {
                            $next[] = array($prefix . $dir, array($x + 1, $y));
                        }
                        break;
                }
            }
        }
    }
    if (count($next) > 0) {
        find($next);
    }
}

find(array(array('', $start)));

$longest = 0;
foreach ($results as $result) {
    $longest = max($longest, strlen($result));
}
echo $longest;
