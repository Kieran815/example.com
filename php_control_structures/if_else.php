<?php

//Initialize your variables
$label = null;
$color = null;

//Check for get parameters
if(!empty($_GET)){
    $color = "#{$_GET['color']}";
}

//Can we name the color by it's hex value
if($color == "#ff0000"){
  $label = "red";
}elseif($color == "#00ff00"){
  $label = "green";
}elseif($color == "#0000ff"){
  $label = "blue";
}else{
  $label = "unknown";
}

//Output the data
echo "<div style=\"color:{$color}\">The color is {$label}</div>";

// Now open a browser and navigate to https://localhost/php/if_else.php and you will see the message The color is unknown. Now add the following string to the end of the URL ?color=ff0000. Now your message will read The color is red and it will be written in red font.