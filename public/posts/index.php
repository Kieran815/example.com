<?php
// include connection to database
include '../../core/db_connect.php';

$content = null;

// GET posts from db
$stmt = $pdo->query('Select * FROM posts');

// while there is a row in the db table, fetch row data
while ($row = $stmt->fetch()) {
  // and dump on page
  // var_dump($row);

  // update `content` to list and concatenate fetched data
  // in PHP, `.=` means `concat`
  $content .= "<a href=\"post?slug={$row['slug']}\">{$row['title']}</a> ";
}

// add `layout` template
include '../../core/layout.php';