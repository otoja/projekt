<?php

/**
 * Description of confid
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/phpmailer/class.phpmailer.php';

class mailConfig {
    public function __construct($to,$subject,$msg) {
        $mail=new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port

        $mail->Username   = "eprzychodnia@gmail.com";  // GMAIL username
        $mail->Password   = "przychodnia";            // GMAIL password

        $mail->From       = "eprzychodnia@gmail.com";
        $mail->FromName   = "E-Przychodnia";
        $mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
        $mail->WordWrap   = 50; // set word wrap

        $mail->AddReplyTo($mail->Username,$mail->Password);
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->MsgHTML($msg);
        $mail->IsHTML(true); // send as HTML

        if(!$mail->Send()) {
            echo "Nastąpił problem z wysłaniem maila: " . $mail->ErrorInfo;
        } else {
            echo "Wiadomość zostala wysłana na adres ".$to;
        }

    }
}
?>
