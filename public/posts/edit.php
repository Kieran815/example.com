<?php

// code refactored with `functions.php`
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

// get selected post
$get = filter_input_array(INPUT_GET);
$id = $get['id'];
// method to get post matching id
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=:id");
// call method with selected post id
$stmt->execute(['id'=>$id]);
$row = $stmt->fetch();

// id not found
if(empty($row)) {
  http_response_code(404);
  die('Page Not Found. <a href="/")>Return Home</a>');
}

$meta['title'] = "Edit {$row['title']}";

// Update Post
$message = null;

$args = [
  'id'=>FILTER_SANITIZE_STRING,  // strips HMTL
  'title'=>FILTER_SANITIZE_STRING,
  'meta_description'=>FILTER_SANITIZE_STRING,
  'meta_keywords'=>FILTER_SANITIZE_STRING,
  'body'=>FILTER_UNSAFE_RAW // null filter
];

// method to filter post input against sanitation args
$input = filter_input_array(INPUT_POST, $args);

if (!empty($input)) {
  // strip extra white space
  $input = array_map('trim', $input);

  // allow only white-listed html
  $input['body'] = cleanHTML($input['body']);

  // `slug` method moved to `functions.php`
  $slug = slug($input['title']);

  // insert sanitized values into database
  $sql = 'UPDATE posts SET title=:title, slug=:slug, body=:body, meta_description=:meta_description, meta_keywords=:meta_keywords WHERE id=:id';

  if($pdo->prepare($sql)->execute([
    $input['title'],
    $slug,
    $input['body'],
    $input['meta_description'],
    $input['meta_keywords'],
    $input['id']
  ])) {
    header('LOCATION:/view.php?slug='. $row['slug']);
  } else {
    $message = 'Something happened...';
  }
}

$content = <<<EOT
<h1>Edit Post</h1>
{$message}
<form method="post">
  <input id="id" name="id" value="{$row['id']}" type="hidden">
  <div class="form-group">
    <label for="title">Title</label>
    <input id="title" value="{$row['title']}" name="title" type="text" class="form-control">
  </div>

  <div class="form-group">
    <label for="body">Body</label>
    <textarea id="body" name="body" rows="10" class="form-control">{$row['body']}</textarea>
  </div>

  <div class="row">
    <div class="form-group col-md-6">
      <label for="meta_description">Description</label>
      <textarea id="meta_description" name="meta_description" rows="2" class="form-control">{$row['meta_description']}</textarea>
    </div>

    <div class="form-group col-md-6">
      <label for="meta_keywords">Keywords</label>
      <textarea id="meta_keywords" name="meta_keywords" rows="2" class="form-control">{$row['meta_keywords']}</textarea>
    </div>
  </div>

  <div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
  </div>
</form>
EOT;

include '../../core/layout.php';