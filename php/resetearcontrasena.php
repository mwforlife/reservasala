<?php
include 'PHPMailer/PHPMailerAutoload.php';
require 'controller.php';

$c = new Controller();

$email = $_POST['email__reset'];

if (strlen($email) < 8) {
    echo "1";
}else{
    $result = $c->buscartoken($email);
    if(strlen($result)==40){
        $message ="http://localhost/reservasala/reset/?token=$result";
        //*********************************************************************** */
        define("DEMO", false); // setting to TRUE will stop the email from sending.

        $templates_file = file_get_contents("templates/reset.php");

        // create a list of the variables to be swapped in the html template
        $swap_var = array(
            "{SITE_ADDR}" => "https://www.colegiograneros.cl/reservasala",
            "{EMAIL_LOGO}" => "https://colegiograneros.cl/Inventario/img/logo/log.png",
            "{EMAIL_TITLE}" => "Restablecer Contraseña",
            "{CUSTOM_URL}" => "http://http://localhost/reservasala/reset/",
            "{CUSTOM_IMG}" => "",
            "{TO_EMAIL}" => $email,
            "{EMAIL}" => $email,
            "{MESSAGE}" => $message
        );
        
        $email_message = $templates_file;

        // search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
        foreach (array_keys($swap_var) as $key){
            if (strlen($key) > 2 && trim($swap_var[$key]) != '')
                $email_message = str_replace($key, $swap_var[$key], $email_message);
        }

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "mail.colegiograneros.cl";
        $mail->Port = 465;
        $mail->Username = "mail";
        $mail->Password = "password";
        $mail->From = "mail";
        $mail->FromName = "Sistema de reserva";
        $mail->Subject = "Restablecer Contraseña";
        $mail->Body = $email_message;
        $mail->AddAddress($email, "Usuario");
        $mail->IsHTML(true);
        $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

        // check if the email script is in demo mode, if it is then dont actually send an email
        if (DEMO){
            die("<hr /><center>This is a demo of the HTML email to be sent. No email was sent. </center>");
        }
        // send the email out to the user  
        /*if (mail($email_to, $email_subject, $email_message, $email_headers)){
            echo 1;
        } else {
            echo "The email message was not sent.";
        }*/

        if ($mail->send()) {
            echo 3;
        }else{
        echo "Error al enviar el mensaje: ".$mail->ErrorInfo;
        }
    //*********************************************************************** */
    }else{
        echo "2";
    }
}