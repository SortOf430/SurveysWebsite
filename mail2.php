<?php
include("cambia.php");
include("Utility/PHPHelper.php");
require 'PHPMailer-master/PHPMailerAutoload.php';

$helper = new PHPHelper();

                        //////////  C9.io non ha smtp quindi non possiamo usare!!!!!!!!! 
  
  
  
   #  $address=$_POST['address'];
  #   $listaEmail = $_REQUEST['emails'];
 #    $questionario = $_REQUEST['sondaggio'];
 #    $array_email = explode("-",$listaEmail);

  #   foreach($array_email as $email)
  #   {
  #   if(!$helper->matchesEmail($email))
  #   {
  #       continue;
  #   }
    
   #  $stringa = RandomString();
    
    $mail  = new PHPMailer();
    include("PHPMailer-master/class.smtp.php");
    # $body="aaa";//"<a href='https://sitoscuola-dz191.c9users.io/questionario.php?id=".$stringa.">Link al sondaggio</a>";
    $body             = file_get_contents('tables.html');
    $body             = eregi_replace("[\]",'',$body);
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->Host       = "smtp.gmail.com"; // SMTP server
    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 25;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "ultrafake10@gmail.com";  // GMAIL username
    $mail->Password   = "";            // GMAIL password

    set_time_limit(3);
    $mail->Timeout = 3;       

    $mail->SetFrom('Sondaggi Levi', 'First Last');

    $mail->AddReplyTo("ultrafake10@gmail.com","First Last");

    $mail->Subject    = "Nuovo sondaggio da Sondaggi";

    $mail->AltBody    = "Per visualizzare il messaggio usa un browser che supporta HTML"; // optional, comment out and test

    $mail->MsgHTML($body);
   
    $address = "andreacendron97@gmail.com";
    $mail->AddAddress($address, "AC");

    if(!$mail->Send()) {
        echo "error mail not send<br>";
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
 #}

function RandomString()
{
    $characters = ’0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ’;
    $randstring = '';
    for ($i = 0; $i < 6; $i++) {
        $randstring = $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}
    ?>
