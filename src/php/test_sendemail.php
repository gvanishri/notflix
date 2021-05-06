<?php

try {
$recipient = 'gvanitha.shri@gmail.com';
$headers = 'From: gvanitha.shri@gmail.com';
$subject = 'Hello World';
$message = 'This is a test';
mail ($recipient, $subject, $message, $headers);
} catch (RuntimeException $e) {
    echo $e->getMessage();
    exit();
}
//echo "Email sent successfully";
?>