<?php
// include connection to database
include '../../core/db_connect.php';
// require '../../core/bootstrap.php';

$content = "<h1>Blog Posts</h1>";

// GET posts from db
$stmt = $pdo->query('Select * FROM posts');

// while there is a row in the db table, fetch row data
while ($row = $stmt->fetch()) {
  // and dump on page
  // var_dump($row);
  // update `content` to list and concatenate fetched data
  // in PHP, `.=` means `concat`
  $content .= "<a href=\"view.php?slug={$row['slug']}\">{$row['title']}</a>";
}

$content .= <<<EOT
<div class="form-group">
  <a href="add.php" class="btn btn-primary">New Post</a>
</div>
EOT;

// add `layout` template
include '../../core/layout.php';