<?php

// require 'phpmailer/phpmailer/src/Exception.php';
// require 'phpmailer/phpmailer/src/PHPMailer.php';
// require 'phpmailer/phpmailer/src/SMTP.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';
?>