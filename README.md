primapp
=======

## Overview

CLI command that generates a multiplication table of the first N numbers on a specified pattern (**prime** by default).

## Usage

php app/console app:number-pattern-table [*length*, *pattern*]

Parameters:
* _length_: how many numbers you want to generate (10 by default)
* _pattern_: by default is prime, and so far the only one implemented

## TODO
Refactor the number series generator to avoid having to iterate number by number.
