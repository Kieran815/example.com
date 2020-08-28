<?php

//Include non-vendor files
require '../core/About/src/Validation/Validate.php';

//Declare Namespaces
use About\Validation;

//Validate Declarations
$valid = new About\Validation\Validate();

$args = [
  'name'=>FILTER_SANITIZE_STRING,
  'subject'=>FILTER_SANITIZE_STRING,
  'message'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
];

$input = filter_input_array(INPUT_POST, $args);

// Validates each field for errors.
// If an error occurs, return a message to the user
if(!empty($input)) {
  $valid->validation = [
    'email'=>[[
      // Store each error in an array using the name of the field as the array key. The value will be the error message to display to the user.
      'rule'=>'email',
      // Show each field-level message.
      'message'=>'Please enter a Valid E-Mail.'
      ],[
      // call params from above class methods
      'rule'=>'notEmpty',
      'message'=>'Please Enter a Valid E-Mail'
    ]],
    'name'=>[[
      'rule'=>'notEmpty',
      'message'=>'Please Enter your Name'
    ]],
    'message'=> [[
      'rule'=>'notEmpty',
      'message'=>'Please add you Message'
    ]]
  ];

  // check inputs against valid
  $valid->check($input);

  // Show a page-level message.
  if(empty($valid->errors)) {
    $message = "<div class=\"message-success\">You Form has been Submitted</div>";
  } else {
    $message  = "<div class=\"message-error\">Your Form Has Errors.</div>";
  }
}
?>

<!DOCTYPE html>

<html>

  <head>

    <meta lang='en'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kieran Milligan Contact Form Page">
    <meta name="keywords" content="hello, introduction, intro, full-stack, web developer, full-stack web developer">
    <link rel="stylesheet" type="text/css" href="./dist/css/main.min.css">

    <title>Contact Me | Kieran Milligan</title>

    <!-- style tag: temp red error messages -->
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
    <header>
      <span class="logo">Kieran Milligan</span>
      <a id="toggleMenu">Menu</a>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="resume.html">Resume</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </header>

      
    <main>    
      <div>
        <h1>Contact Me!</h1>
        <p>I would love to discuss how we can work together.</p>
      </div>
      <!-- if there IS a message, display the message. If not, render null -->
      <?php echo (!empty($message) ? $message : null); ?>

      <!-- The form element <form></form> is used for creating forms in HTML. Every form should have at least two attributes action and method:
        action - the web address to which the form data will be sent.
        method - the type of request the form should make (probably GET or POST). 
      -->
      <form
        action="contact.php"
        method="POST"
      >
        
        <input type="hidden" name="subject" value="New submission!">

        <div>
          <label for="name">Name:</label>
          <br>
          <!-- The form will call a method in the validate array using the name of the field as the argument. This will retrieve any error messages for that field. -->
          <input id="name" type="text" name="name" value="<?php echo $valid->userInput('name'); ?>">
          <div class="text-error">
            <?php echo $valid->error('name'); ?>
          </div>
        </div>

        <div>
          <label for="email">Email:</label>
          <br>
          <input id="email" type="text" name="email" value="<?php echo $valid->userInput('email'); ?>">
          <div class="text-error"><?php echo $valid->error('email'); ?></div>  
        </div>

        <div>
          <label for="message">Message:</label>
          <br>
          <textarea id="message" name="message" rows="4" cols="50" placeholder="How can I help you?"></textarea>
          <div class="text-error"><?php echo $valid->error('message')?></div>
        </div>

        <div>
          <input type="submit" value="Send">
        </div>

      </form>
      <!-- END OF FORM -->
    </main>

    <script>
      var toggleMenu = document.getElementById('toggleMenu');
      var nav = document.querySelector('nav');
      toggleMenu.addEventListener(
        'click',
        function(){
          if(nav.style.display=='block'){
            nav.style.display='none';
          }else{
            nav.style.display='block';
          }
        }
      );
    </script>
  </body>

</html>