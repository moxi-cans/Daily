<?php

require_once 'Composite.php';
require_once 'Leaf.php';

$root = new Composite("root");
$root->add(new Leaf("Leaf A"));
$root->add(new Leaf("Leaf B"));

$comp = new Composite("Composite X");
$comp->add(new Leaf("Leaf XA"));
$comp->add(new Leaf("Leaf XB"));
$root->add($comp);

$comp2 = new Composite("Composite XY");
$comp2->add(new Leaf("Leaf XYA"));
$comp2->add(new Leaf("Leaf XYB"));
$comp->add($comp2);

$root->add(new Leaf("Leaf C"));

$leaf = new Leaf("Leaf D");
$root->add($leaf);

$root->remove($leaf);

$root->display(1);
