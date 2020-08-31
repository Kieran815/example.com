<?php

require '../core/processContactForm.php';

//Build the page metadata
$meta = [];
$meta['description'] = "About and Contact page for Kieran Milligan";
$meta['keywords'] = "Contact Me, Contact, Me, About";

// The form element <form></form> is used for creating forms in HTML. Every form should have at least two attributes action and method:
//     action - the web address to which the form data will be sent.
//     method - the type of request the form should make (probably GET or POST). 

$content = <<<EOT
<div id='con-tainer'>
  <div id='con-intro'>
    <h1>Contact Me!</h1>
    <p>I would love to discuss how we can work together.</p>
  </div>
  <form id="con-form" action="contact.php" method="POST">
    <input type="hidden" name="subject" value="MSG from Portfolio Site">

    <div class="form-control">
      <label for="name">Name:</label>
      <br>
      <!-- The form will call a method in the validate array using the name of the field as the argument. This will retrieve any error messages for that field. -->
      <input id="name" type="text" name="name" value="{$valid->userInput('name')}">
      <div class="text-error">
        {$valid->error('name')}
      </div>
    </div>

    <div class="form-control">
      <label for="email">Email:</label>
      <br>
      <input id="email" type="text" name="email" value="{$valid->userInput('email')}">
      <div class="text-error">
        {$valid->error('email')}
      </div>  
    </div>

    <div class="form-control">
      <label for="message">Message:</label>
      <br>
      <textarea id="message" name="message" rows="4" cols="50" placeholder="How can I help you?">
        {$valid->error('message')}
      </textarea>
      <div class="text-error">
        {$valid->error('message')}
      </div>
    </div>

    <div class="form-control">
      <input type="submit" value="Send">
    </div>

  </form>
  <!-- END OF FORM -->
</div>
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
EOT;

include '../core/layout.php';