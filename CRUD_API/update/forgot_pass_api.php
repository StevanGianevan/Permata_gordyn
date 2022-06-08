<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../usersdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;


require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../vendor/autoload.php';

class VerificationCode
{
    public $smtpHost;
    public $smtpPort;
    public $sender;
    public $password;
    public $receiver;
    public $code;

    public function __construct($receiver)
    {
        /**
         * Your email id  
         * For example : johndoe@gmail.com
         * contact@johndoe.com
         * 
         */
        $this->sender = "erlanggchakragenshin@gmail.com"; 

        /**
         *  YOUR PASSWORD 
         *  ************
         */               
        $this->password = "chakralg87";  

        /**
         * Receiver email
         * For example : johndoe@gmail.com
         */     
        $this->receiver = $receiver;  
        /**
         * YOUR SMTP HOST NAME 
         * For example : smtp.gmail.com 
         * OR mail.youwebsite.com
         */     
        $this->smtpHost="smtp.gmail.com";        
        
        /**
         * SMTP port number
         * For example :587
         */
        $this->smtpPort = 587;

    }
    public function sendMail(){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->AuthType = 'XOAUTH2';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Host = $this->smtpHost;   
        $mail->Port = $this->smtpPort;
        $mail->SMTPSecure = 'tls'; 
        $mail->SMTPDebug = 2;
        $mail->oauthUserEmail = "erlanggchakragenshin@gmail.com";
        $mail->oauthClientId = "477920074725-vuvrttigcgeeciao21rftqp62hhp6t1p.apps.googleusercontent.com";
        $mail->oauthClientSecret = "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";
        $mail->oauthRefreshToken = "1//0gqIdRrqGbl3GCgYIARAAGBASNwF-L9IrO4CHn0RpC5dMK9hnUEyQFVEioJAda3-5bGqzBo_Um_CLAXLFZixleQGxZzIWx1Ea5cU";   
        $mail->IsHTML(true);
        $mail->Username = $this->sender;
        $mail->Password = $this->password;
        $mail->Body=$this->getHTMLMessage();
        $mail->Subject = "Your verification code is {$this->code}";
        $mail->SetFrom($this->sender,"Verification Codes");
        $mail->AddAddress($this->receiver);
        if($mail->send()){
          echo "MAIL SENT SUCCESSFULLY";
          // return true;
          exit;  
        }
        echo "FAILED TO SEND MAIL";
        // return false;

    }
    public function getVerificationCode()
    {
        return (int) substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    }

    public function getHTMLMessage(){
        $this->code=$this->getVerificationCode();   
        $htmlMessage=<<<MSG
        <!DOCTYPE html>
        <html>
         <body>
            <h1>Your verification code is {$this->code}</h1>
            <p>Use this code to verify your account.</p>
         </body>
        </html>        
        MSG;
    return $htmlMessage;
    }

}

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $usersdb= new UsersDb($db);
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        // make sure data is not empty
        if(!empty($data->email)){
            // pass your recipient's email
            $email = $data->email;
            $vc=new VerificationCode($email); 
            $vc->sendMail(); // MAIL SENT SUCCESSFULLY
        } else {
            // set response code - 404 Not found
            http_response_code(404);
            throw new Exception("Please fill all the data");
        }
    } else {
        // set response code - 404 Not found
        http_response_code(404);
        throw new Exception("Not authorized access");
    }
} catch(Exception $e) {
    $error_schema["error_code"] = 1;
    $error_schema["message"] = "Failed";
  
    // tell the user no products found
    echo json_encode(
        array(
            "error_schema" => $error_schema,
            "output" => $e->getMessage()
        )
    );
    
    die();
}

?>