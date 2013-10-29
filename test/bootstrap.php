<?php

$autoloader = require __DIR__ . "/../vendor/autoload.php";

$autoloader->add('Accountancy\\', array(
    __DIR__ . "/..//src/",
    __DIR__ . "/tests/src/",
));
