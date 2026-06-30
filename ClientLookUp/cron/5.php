<?php
    require '../PHPMailer/PHPMailerAutoload.php';
    function _createMailer()
    {
        $mailer = new \PHPMailer;
        $mailer->isSMTP();
        $mailer->Host = 'mail.policetax.com.au';
        $mailer->SMTPAuth = TRUE;
        $mailer->Username = 'customerservice@policetax.com.au';
        $mailer->Password = '$%Dusty@0077';
        //$mailer->SMTPSecure = 'ssl';
        $mailer->Port = 587;
        $mailer->IsHTML(false);
        $mailer->CharSet = 'windows-1250';
        return $mailer;
    }
    $mail = _createMailer();
