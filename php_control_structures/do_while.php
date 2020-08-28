<?php

$items = [
  'for',
  'foreach',
  'while',
  'do-while'
];

echo 'PHP Supports ' . count($items) . ' of loops.';

$i = 0;
$li=null;
// do/while will ensure the code is run at least one time before checking against the control statement.
do {
  $li .= "<li>{$items[$i++]}</li>";
} while ($i < 4);

echo "<ul>{$li}</ul>";