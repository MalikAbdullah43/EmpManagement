<?php
session_start();   //For getting Variables of api_forget.php Page
require 'Database.php';   //This line include Database connectivity file
date_default_timezone_set("Asia/Karachi"); //for local time



class otpCheck extends Database  //class database inherit in otpCheck
{

public function check_otp($otp,$email)
{
     $email = $_SESSION['email'];

    $conn = self::build_connection();
     if(!empty($otp))
     {
    $res = $conn->query("select  otp from user where email = '{$email}' and status != 1 and otp='{$otp}' and now() <=date_add(create_at,interval 15 minute)");

    if($res->num_rows>0)
    { 
        self::send_pass($email);
    }
    else{
        $msg = array("status"=>"410","message"=>"otp may be expire");
        echo json_encode($msg);
    }}
    


}

public function send_pass($email)
{
    $conn = self::build_connection();
    global $otp;
    $sql = "select UserPassword from user where otp={$otp}";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
    ///mail function 
    $to_email = $email;

    

    
    if (mail($to_email, "For Reset Password", "hi,this is your log-in password:'{$otp}'", "from: malikabdullah3011@gmail.com")) {
        $msg = array("status"=>"200","message"=>"Password Send to email '{$to_email}'");
        echo json_encode($msg);
        $res = $conn->query("UPDATE user SET status = 1 where email='{$to_email}'");
        Session_destroy();
        
    } else {
        $msg = array("status"=>"500","message"=>"Internal Server Error");
    }}
}




}
$data = json_decode(file_get_contents('php://input'),true);
$otp  = $data['u_otp'];  
$email =$_SESSION['email'];




$otp_ch = new otpCheck();
$otp_ch->check_otp($otp,$email);




?>