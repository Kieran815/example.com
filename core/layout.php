<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Contact | Kieran Milligan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/dist/css/main.css">
    <style>
      .text-error,
      .message-error {
        color: red;
      }
      .message-success {
        color: green;
      }

    </style>
  </head>

  <body>

    <div id="Wrapper">
      <span class="logo">Kieran Milligan</span>
      <a id="toggleMenu">Menu</a>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="resume.html">Resume</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
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