<?PHP
require_once '../PHPMailer/PHPMailerAutoload.php';

class SendMail
{
    // Singleton object. Leave $me alone.
    private static $me;
    public $db;
    public $username;
    public $password;
    // Singleton constructor
    private function __construct()
    {
        $this->username   = "abc";
        $this->password   = "xyz";
        $this->connect();
    }
    // Waiting (not so) patiently for 5.3.0...
    public static function __callStatic($name, $args)
    {
        return self::$me->__call($name, $args);
    }
    // Get Singleton object
    public static function getSendMail()
    {
        if(is_null(self::$me)) self::$me = new SendMail();
        return self::$me;
    }
    public function isConnected()
    {
        return is_object($this->db);
    }
    public function connect()
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->Mailer = "smtp";
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
        $mail->Host = "smtp.office365.com";
        $mail->Port = 587;
        $mail->Priority = 1;
        $mail->Username = 'admin@policetax.com.au';
        $mail->Password = '$%Dusty@0077';
        $mail->CharSet = 'windows-1250';
        $mail->SetFrom ('customerservice@policetax.com.au', 'Police Tax team');
        //$mail->Subject = "No-Reply: Reminder from Police Tax";
        $mail->ContentType = 'text/plain';
        $mail->IsHTML(false);
        //$mail->Body = "Hi,\n\r\n\rThis is test email from Client Look Up only. Please disregard it.\n\r\n\rSincerely,\n\r\n\rPolice Tax Customer Service";
        //$mail->AddAddress ("lamtrvu@gmail.com", "lamtrvu");
        $this->db = $mail;
        /*
        $recipients = array(
           'lamtrvu@gmail.com' => 'Lam 1',
           'vutrlam@gmail.com' => 'Lam 2',
           'vinajava@gmail.com' => 'Lam 3',
           'lam4b4@yahoo.com' => 'Lam 4',
           'conho1@gmail.com' => 'Lam 5',
           'conho2@gmail.com' => 'Lam 6'
        );
        foreach($recipients as $email => $name) {
           $mail->AddCC($email, $name);
        }*/

        /*
        if(!$mail->Send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
        echo 'Message has been sent.';
        }*/
        if($this->db === false) return false;
        return $this->isConnected();
    }
    public function setHTML($value)
    {
        $this->db->IsHTML($value);
    }
    public function attach($file_name)
    {
		$this->db->addAttachment("../PoliceTemplates2021/".$file_name);
    }
    public function setSubjectAndClient($email, $name, $subject)
    {
        $this->db->Subject = $subject;
        $this->db->ClearAddresses();
        $this->db->ClearCCs();
        $this->db->ClearBCCs();
        $this->db->AddAddress ($email, $name);
    }
    public function setBody($name, $body)
    {
        $this->db->Body = "Hi ".$name.",\n\r\n\r".$body."\n\r\n\rRegards,\n\r\n\rThe Police tax team";
    }
    public function setBodyHTML($name, $body)
    {
        $this->db->Body = "Hi ".$name.",<br><br>".$body."<br><br>Regards,<br><br>The Police tax team";
    }
    public function setBodyHTMLOnly($body)
    {
        $this->db->Body = $body;
    }
    public function setBodyBCC($subject, $body)
    {
        $this->db->Subject = $subject;
        $this->db->Body = "Hi,\n\r\n\r".$body."\n\r\n\rSincerely,\n\r\n\rPolice Tax team";
        $this->db->ClearAddresses();
        $this->db->ClearCCs();
        $this->db->ClearBCCs();
    }
    public function setClientInfo($email, $name)
    {
        $this->db->AddAddress ($email, $name);
    }
    public function setClientInfoBCC($email, $name)
    {
        $this->db->AddBCC ($email, $name);
    }
    public function sendMail()
    {
        if($this->isConnected())
        {
            $rs = $this->db->Send();
            return $rs;
            /*
            if(!$mail->Send()) {
            echo 'Message was not sent.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {
            echo 'Message has been sent.';*/
        }
        else return false;
    }
    public function getErrorInfo()
    {
        return $this->db->ErrorInfo;
    }
}