<?php
session_start();
header('Content-Type:application/json');   //Here we set header as json Format
include 'Database.php';

 class forgetPassword extends Database   {
    public function check_email($semail)
    {   
        
        $conn= self::build_connection();
        $sql = "select *from user where email = '{$semail}'";
        $res = $conn->query($sql);
       if( $semail == "")
       {
           $msg = array("status"=>"204","message"=>"no content send");
           echo json_encode($msg);
       }
       elseif($res->num_rows > 0)
       {
           self::send_email($semail);
       }
       else
       { 
            $msg = array("status"=>"404","message"=>"result not found");
            echo json_encode($msg);
       }
       
       
      
    }
     
   
     public function send_email($remail)   //here we genrate otp and send to user email
    {
        $otp = rand(100000,999999);
        
        $to_email = "malikabdullah4300@gmail.com";
        $subject = "simple email test via php";
        $body = "hi,this is your six digit otp(one time pin)-{$otp}";
        $headers = "from: malikabdullah3011@gmail.com";
        
        if (mail($to_email, $subject, $body, $headers)) {
            $msg = array("status"=>"200","message"=>"otp send on '{$to_email}'");
            echo json_encode($msg);
            self::save_otp_in_db($otp,$remail);
        } else {
            $msg = array("status"=>"500","message"=>"internal server error");
        }
    }


     public function save_otp_in_db($otp,$email)    //here we set otp in database
    {
        
         $sql = "update user set otp='{$otp}' where email='{$email}'"; 
         $conn = self::build_connection();
         $res = $conn->query($sql) or exit("sql query failed");

    }   

 }



$data = json_decode(file_get_contents('php://input'),true);
$email = $data['u_email'];
$pass = new forgetPassword();
$pass->check_email($email);
$_SESSION['email'] = $email;


?>