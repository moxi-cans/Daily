<?php

require_once "BoxFactory.php";

$factory = BoxFactory::getInstance();

$box = $factory->getBox('square');

$factory->getBox('square')->display('red');
$factory->getBox('circle')->display('green');
$factory->getBox('triangle')->display('blue');
