<?php
// include db connection information
include '../../core/db_connect.php';
// require '../../core/bootstrap.php';

// filter input for security
$input = filter_input_array(INPUT_GET);

// (un-sanitized slug get request)
//$slug = "'{$_GET['slug']}'";
// $slug="(SELECT slug FROM posts WHERE slug = 'hello')";

// method to sanitize the slug by forcing it into a predefined format; prevents user manipulation.
$slug = preg_replace("/[^a-z0-9-]+/","",$input['slug']);
// method to pass slug variable into sql query
$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug=:slug");

// call method with slug;
$stmt->execute(['slug'=>$slug]);
$row = $stmt->fetch();

$meta=[];
$meta['title']=$row['title'];
$meta['description']=$row['meta_description'];
$meta['keywords']=$row['meta_keywords'];

$content=<<<EOT
<h1>{$row['title']}</h1>
{$row['body']}<br>
{$row['meta_description']}<br>
{$row['meta_keywords']}<br>
{$row['created']}
<hr>
<div>
  <a class="btn btn-link" href="edit.php?id={$row['id']}">Edit</a>
  <a class="btn btn-link text-danger" href="delete.php?id={$row['id']}">Delete</a>
</div>
EOT;

require '../../core/layout.php';
