#!/bin/bash
if [ $# -lt 1 ]; then
  echo "Argument DAY missing".
  exit 1
fi;
DAY=`printf %02d $1`
if [ ! -f day$DAY.txt ]; then
  code .
  firefox http://adventofcode.com/2016/day/$1
  wget http://adventofcode.com/2016/day/$1/input -O day$DAY.txt -o /dev/null
  touch day${DAY}a.php
  touch day${DAY}b.php
fi;
