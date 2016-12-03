#!/bin/bash
DAY=$1
if [ ! -f day$DAY.txt ]; then
  firefox http://adventofcode.com/2016/day/$DAY
  wget http://adventofcode.com/2016/day/$DAY/input -O day$DAY.txt -o /dev/null
  touch day${DAY}a.php
  touch day${DAY}b.php
fi;
