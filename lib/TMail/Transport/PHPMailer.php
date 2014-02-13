<?php
class TMail_Transport_PHPMailer extends AbstractObject {
    function connect(){
        $this->fid = fsockopen(
            $this->api->getConfig("tmail/smtp/host"),
            $this->api->getConfig("tmail/smtp/port"),
            $this->errorNr,
            $this->errorStr,
            $this->errorTimeout
        );     
        if (!$this->fid){
            throw $this->exception("Could not connect to mail server: " . $this->errorStr);
        }   
    } 
    function send($to,$from,$subject,$body,$headers=""){
        require_once("PHPMailer/class.phpmailer.php");
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = $this->api->current_website['email_username']?true:false;                  // enable SMTP authentication
        $mail->Host       = $this->api->current_website['email_host'];
        $mail->Port       = $this->api->current_website['email_port'];
        $mail->Username   = $this->api->current_website['email_username'];
        $mail->Password   = $this->api->current_website['email_password'];
        
        if($this->add('Controller_EpanCMSApp')->emailSettings($mail) !== true){
            $mail->AddReplyTo($this->api->current_website['email_reply_to'], $this->api->current_website['email_reply_to_name']);
            $mail->SetFrom($this->api->current_website['email_from'], $this->api->current_website['email_from_name']);
        }

        $mail->SMTPAuthSecure = 'ssl';
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AltBody = null;
        $mail->IsHTML(true);
        foreach (explode("\n", $headers) as $h){
            $mail->AddCustomHeader($h);
        }
        $mail->Send();
    }
}
 
