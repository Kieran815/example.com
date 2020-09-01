<?php

require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

// sanitize arg values against params in functions.php
$args = [
  'id'=>FILTER_UNSAFE_RAW,
  'confirm'=>FILTER_VALIDATE_INT
];
// sanitize input values
$input = filter_input_array(INPUT_GET, $args);
$id=$input['id'];

// method to call db and request post via id
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=:id");
// callback method with id passed
$stmt->execute(['id'=>$id]);
$row = $stmt->fetch();

// post found, delete in db
if(!empty($input['confirm'])) {
  $stmt = $pdo->prepare("DELETE FROM posts WHERE id=:id");
  if($stmt->execute(['id'=>$id])) {
    header('Location: /example.com/public/posts');
  }
}

$meta=[];
$meta['title']="DELETE: {$row['title']}";

$content=<<<EOT
<h1 class="text-danger text-center">DELETE: {$row['title']}</h1>
<p class="text-danger text-center">Are you sure you want to delete {$row['title']}?</p>
<div class="text-center">
  <a href="delete.php?id={$row['id']}&confirm=1" class="btn btn-link text-danger">Delete</a>
  <br><br>
  <a href="./" class="btn btn-success btn-lg">Cancel</a>
</div>
EOT;

require '../../core/layout.php';