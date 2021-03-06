<?php
$inputs = file('input');
$field = array();
for ($i = 0; $i < 6; $i++) {
    $field[$i] = str_repeat('.', 50);
}
foreach ($inputs as $input) {
    if (preg_match('/rect ([0-9]+)x([0-9]+)/', trim($input), $matches)) {
        $w = $matches[1];
        $h = $matches[2];
        for ($i = 0; $i < $h; $i++) {
            $field[$i] = str_repeat('#', $w) . substr($field[$i], $w);
        }
    }
    if (preg_match('/rotate row y=([0-9]+) by ([0-9]+)/', trim($input), $matches)) {
        $y = $matches[1];
        $r = $matches[2];
        $field[$y] = substr($field[$y], -$r) . substr($field[$y], 0, -$r);
    }
    if (preg_match('/rotate column x=([0-9]+) by ([0-9]+)/', trim($input), $matches)) {
        $x = $matches[1];
        $r = $matches[2];
        $column = array();
        for ($i = 0; $i < 6; $i++) {
            $column[($i + $r) % 6] = $field[$i][$x];
        }
        for ($i = 0; $i < 6; $i++) {
            $field[$i][$x] = $column[$i];
        }
    }
}

$alphabet = array(
'.##..###...##..###..####.####..##..#..#..###...##.#..#.#....#..#.#..#..##..###...##..###...###.######..#.#..#.#..#.#..#.#...#####.',
'#..#.#..#.#..#.#..#.#....#....#..#.#..#...#.....#.#.#..#....####.##.#.#..#.#..#.#..#.#..#.#......#..#..#.#..#.#..#.#..#.#...#...#.',
'#..#.###..#....#..#.###..###..#....####...#.....#.##...#....#..#.##.#.#..#.#..#.#..#.#..#.#......#..#..#.#..#.#..#..##...#.#...#..',
'####.#..#.#....#..#.#....#....#.##.#..#...#.....#.#.#..#....#..#.#.##.#..#.###..#..#.###...##....#..#..#.#..#.#..#..##....#...#...',
'#..#.#..#.#..#.#..#.#....#....#..#.#..#...#..#..#.#.#..#....#..#.#.##.#..#.#....#.##.#.#.....#...#..#..#..##..####.#..#...#..#....',
'#..#.###...##..###..####.#.....###.#..#..###..##..#..#.####.#..#.#..#..##..#.....###.#..#.###....#...##...##..####.#..#...#..####.',
);

$letters = array();
for ($i = 0; $i < 26; $i++) {
    $letter = '';
    for ($j = 0; $j < 6; $j++) {
        $letter .= "\n".substr($alphabet[$j], $i * 5, 5);
    }
    $letters[$letter]=chr(ord('a')+$i);
}

for ($i = 0; $i < strlen($field[0])/5; $i++) {
    $letter = '';
    for ($j = 0; $j < 6; $j++) {
        $letter .= "\n".substr($field[$j], $i * 5, 5);
    }
    if (isset($letters[$letter])) {
        echo $letters[$letter];
    } else {
        echo $letter . "\n";
    }
}

echo "\n";