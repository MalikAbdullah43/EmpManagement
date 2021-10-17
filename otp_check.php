<?php
session_start();
require 'Database.php';
date_default_timezone_set("Asia/Karachi");
class otpCheck extends Database
{

public function check_otp($otp)
{
    $email = $_session['email'];
    $conn = self::build_connection();
     
    $res = $conn->query("select  otp from user where email = '{$email}' and status != 1 and now() <=date_add(create_at,interval 15 minute)");
    if($res->num_rows>0)
    { 
        if($res === $otp)
        self::send_pass();
        else{
        $msg = array("status"=>"401","message"=>"otp not match");
        echo json_encode($msg);}
    }
    else{
        $msg = array("status"=>"$otp","message"=>"otp may be expire");
        echo json_encode($msg);
    }
    


}

public function send_pass()
{
    $conn = self::build_connection();
    global $otp;
    $sql = "select UserPassword from user where otp={$otp}";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
    $email = $_session['email'];
    ///mail function 
    $to_email = "{$email}";
    $subject = "simple email test via php";
    $body = "hi,this is your log-in password";
    $headers = "from: malikabdullah3011@gmail.com";
    
    if (mail($to_email, $subject, $body, $headers)) {
        $msg = array("status"=>"200","message"=>"Password Send to email");
        echo json_encode($msg);
        self::save_otp_in_db($otp,$remail);
    } else {
        $msg = array("status"=>"500","message"=>"internal server error");
    }}
}




}
$data = json_decode(file_get_contents('php://input'),true);
$otp  = $data['u_otp'];  
$otp_ch = new otpCheck();
$otp_ch->check_otp($otp);



?>