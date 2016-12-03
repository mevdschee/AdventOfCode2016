#!/bin/bash
if [ $# -lt 1 ]; then
  echo "Argument DAY missing"
  exit 1
fi;
DAY=`printf %02d $1`
if [ ! -f day$DAY.txt ]; then
  code .
  firefox http://adventofcode.com/2016/day/$1
  firefox http://adventofcode.com/2016/day/$1/input
  touch day${DAY}.txt
  echo "<?php" > day${DAY}a.php
  echo "\$inputs = file('day${DAY}.txt');" >> day${DAY}a.php
  touch day${DAY}b.php
fi;
