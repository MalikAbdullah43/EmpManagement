<?php
session_start();   //For getting Variables of api_forget.php Page
require 'Database.php';   //This line include Database connectivity file
date_default_timezone_set("Asia/Karachi"); //for local time



class otpCheck extends Database  //class database inherit in otpCheck
{

public function check_otp($otp,$email)   //two parameters accepting 
{

    $conn = self::build_connection();   //connectivity with database
     if(!empty($otp))                   //if variable is empty
    {
         //query for changes in database
         $res = $conn->query("select  otp from user where email = '{$email}' and status != 1 and otp='{$otp}' and now() <=date_add(create_at,interval 15 minute)");
         $count = $res->num_rows;
         self::close_connection();   //connection close with database
         if($count>0)
         { 
            // self::send_pass($email);  //if query recieve data from database then call this function

             $msg = array("status"=>"200","message"=>"All Okay Kindly Save Password");  //message for okay call
             echo json_encode($msg);
             $_SESSION['status'] = 0;
             
        
         }
      else  {
             $msg = array("status"=>"410","message"=>"otp may be expire");  //message in array
             echo json_encode($msg);                                        //conversion array to json format
             
            }
    }
    


}


}
$data = json_decode(file_get_contents('php://input'),true);  //fetching data from postman
$otp  = $data['u_otp'];  
$email =$_SESSION['email'];   //getting value from session




$otp_ch = new otpCheck();
$otp_ch->check_otp($otp,$email);




?>