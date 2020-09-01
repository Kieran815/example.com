<?php
// function active($name){
//   $current = $_SERVER['REQUEST_URI'];
//   if($current === $name){
//     return 'active';
//   }

//   return null;
// }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Contact | Kieran Milligan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  </head>

  <body>
    <div class="container">

      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">MicroTrain2007 Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <!-- <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> -->
            <li class="nav-item">
              <a class="nav-link <?php echo active('/'); ?>" href="index.php">Home</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link <?php echo active('resume.php'); ?>" href="resume.php">Resume</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link <?php echo active('contact.php'); ?>" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo active('/posts/'); ?>" href="posts/">Posts</a>
            </li>
          </div>
        </div>
      </nav>

      <div class="row">
        <div id="Content">
          <?php echo $content; ?>
        </div>
      </div>
      <div id="Footer" class="clearfix">
        <small>&copy; 2020 - Kieran Milligan</small>
      </div>

    </div>
  </body>
</html>