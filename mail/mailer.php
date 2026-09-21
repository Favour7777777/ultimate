<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../mail-config.php";

function sendUltimateMail($toEmail, $toName, $subject, $body){

    $mail = new PHPMailer(true);

    try{

        $mail->SMTPDebug = defined("SMTP_DEBUG") ? (int) SMTP_DEBUG : 0;
        $mail->Debugoutput = "error_log";
        $mail->isSMTP();
        $mail->Host       = defined("SMTP_HOST") ? SMTP_HOST : "smtp.gmail.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = defined("SMTP_USERNAME") ? SMTP_USERNAME : "oluwatobilobakadri947@gmail.com";
        $mail->Password   = defined("SMTP_PASSWORD") ? SMTP_PASSWORD : "";
        $mail->Timeout    = defined("SMTP_TIMEOUT") ? (int) SMTP_TIMEOUT : 10;

        $smtp = $mail->getSMTPInstance();
        $smtp->Timelimit = defined("SMTP_TIMELIMIT") ? (int) SMTP_TIMELIMIT : 5;

        $smtpPort = defined("SMTP_PORT") ? (int) SMTP_PORT : 587;
        $mail->Port = $smtpPort;

        $smtpUsername = defined("SMTP_USERNAME") ? SMTP_USERNAME : "";

        if($smtpUsername === "" || $mail->Password === ""){
            throw new Exception("SMTP username or password is not configured.");
        }

        if($smtpPort === 465){
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        }else{
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }

        $mail->setFrom($smtpUsername, "Ultimate");
        $mail->addReplyTo($smtpUsername, "Ultimate");
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $sent = $mail->send();

        if(!$sent){
            error_log("Ultimate email failed: " . $mail->ErrorInfo);
        }

        return $sent;

    }catch(Exception $e){

        error_log("Ultimate email exception: " . $e->getMessage());
        return false;

    }
}

