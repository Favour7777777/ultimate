<?php

require_once __DIR__ . "/mail-config.php";
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/mail/mailer.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$socket = fsockopen(
    SMTP_HOST,
    SMTP_PORT,
    $errno,
    $errstr,
    SMTP_TIMEOUT
);

if($socket){
    echo "PHP can connect to " . htmlspecialchars(SMTP_HOST) . ":" . (int) SMTP_PORT . ".<br>";
    fclose($socket);

    try{
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->Port = SMTP_PORT;
        $mail->Timeout = SMTP_TIMEOUT;
        $mail->getSMTPInstance()->Timelimit = SMTP_TIMELIMIT;
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = "html";
        $mail->SMTPSecure = SMTP_PORT === 465
            ? PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->smtpConnect();
        $mail->smtpClose();
        echo "SMTP authentication succeeded.";

        if(in_array("--send", $argv ?? [], true)){
            $sent = sendUltimateMail(
                SMTP_USERNAME,
                "Ultimate SMTP Test",
                "Ultimate SMTP test message",
                "<p>This is a controlled SMTP delivery test from Ultimate.</p>"
            );
            echo $sent ? " Test message accepted by Gmail." : " Test message was not accepted.";
        }
    }catch(Exception $exception){
        echo "SMTP authentication failed: " . htmlspecialchars($exception->getMessage());
        error_log("SMTP test failed: " . $exception->getMessage());
    }
}else{
    echo "PHP cannot connect to " . htmlspecialchars(SMTP_HOST) . ":" . (int) SMTP_PORT . ".<br>";
    echo "<br>";
    echo "Error: " . $errno;
    echo "<br>";
    echo $errstr;
}