<?php

//Include non-vendor files
require '../core/About/src/Validation/Validate.php';
// vendor files and keys
include '../vendor/autoload.php';
require '../config/keys.php';

//Declare Namespaces
use About\Validation;
use Mailgun\Mailgun;

//Validate Declarations
$valid = new About\Validation\Validate();

$filters = [
  'name'=>FILTER_SANITIZE_STRING,
  'message'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
];

$input = filter_input_array(INPUT_POST, $filters);

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
# Instantiate the client with imported keys
$mgClient = Mailgun::create(MG_KEY,MG_API); //MailGun key 
$domain = MG_DOMAIN; //API Hostname
$from = "Mailgun Sandbox <postmaster@{$domain}>";

# Make the call to the client.
$result = $mgClient->messages()->send($domain,
array   (  
          'from'    => "{$input['name']} <{$input['email']}>",      
          'to'      => 'Kieran <kieran.milligan@gmail.com>',
          'subject' => 'New Message from Portfolio',
          'text'    => $input['message']
        )
    );   
  // Use To Show Input When Needed
  var_dump($result);

  $message = "<div class=\"message-success\">Your form has been submitted!</div>";
  }else{
    $message = "<div class=\"message-error\">Your form has errors!</div>";
  }
}