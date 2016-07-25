# My simple calculator

This is just a simple calculator which does manipulations with integers.
Although it has simple functional, it's based on MVC pattern, Twitter Bootstrap framework, AJAX requests and implemented some basic PHPUnit tests.

### Prerequisities

If you are seriously interested in this application, please follow the instruction below.

Please have preinstalled PHPUnit testing framework for testing if required.
The latest version can be got there -> [phpunit](https://phpunit.de/)

### Installing

There are two ways of setting this app up:
* You can simply download the ZIP file
* You can clone it by the command:

```
git clone https://github.com/AliceMakk/calculator.git
```

The repository will be downloaded into calculator directory

## Running the tests

If the testing framework is installed, you can simply run testing by the command:

```
phpunit Tests/CalculatorTest.php
```

The result must (I hope) be:

```
PHPUnit 5.4.6 by Sebastian Bergmann and contributors.

............                                                      12 / 12 (100%)

Time: 76 ms, Memory: 11.75MB

OK (12 tests, 12 assertions)
```