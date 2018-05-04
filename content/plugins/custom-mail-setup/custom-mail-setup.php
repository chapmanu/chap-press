<?php
/*
 Plugin Name: Custom Mail Setup
 Description: Modify WordPress default mail setup
 Version:     1.0
 Author:      Chapman SMC
*/

class smc_mail_Customization {

  public function __construct() {

    // Override default WP email settings
    add_action('phpmailer_init', array($this, 'cu_phpmailer_init'));
  
  } 

  // use SMTP instead of PHP Mail
  function cu_phpmailer_init($PHPMailer) {

    $smc_keychain = new smc_keychain('petethepanther!');

    $PHPMailer->IsSMTP();
    $PHPMailer->SMTPAuth = true;
    $PHPMailer->SMTPSecure = 'tls';
    $PHPMailer->Host = 'smtp.gmail.com';
    $PHPMailer->Port = 587;
    $PHPMailer->Username = $smc_keychain->get('email_username');
    $PHPMailer->Password = $smc_keychain->get('email_password');

  }

}  

$smc_mail_Customization = new smc_mail_Customization();

?>
