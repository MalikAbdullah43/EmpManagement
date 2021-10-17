<?php
session_start();   //start session
header('Content-Type:application/json');   //Here we set header as json Format
include 'Database.php';

 class forgetPassword extends Database   {
    public function check_email($semail)    //email verification it exist or not
    {   
          
        $conn= self::build_connection();     //connection building with database
        $sql = "select *from user where email = '{$semail}'";   //check email exist in database or not
        $res = $conn->query($sql);      //sql query running
       if( $semail == "")               //if empty request then show error
       { 
           $msg = array("status"=>"204","message"=>"no content recieve");  //message in array form
           echo json_encode($msg);                                        //conversion in json form and printing on console
       }
       elseif($res->num_rows > 0)      //if value >0 then call inside functiom
       {
           self::send_email($semail);
       }
       else
       { 
            $msg = array("status"=>"404","message"=>"result not found");   //if email not exist then show this
            echo json_encode($msg);
       }
       
       
      
    }
     
   
     public function send_email($remail)   //here we genrate otp and send to user email
    {
        $otp = rand(100000,999999);        // Random number and set as otp 
        
        $to_email = "malikabdullah4300@gmail.com";
        $subject = "simple email test via php";
        $body = "hi,this is your six digit otp(one time pin)-{$otp}";
        $headers = "from: malikabdullah3011@gmail.com";
        
        if (mail($to_email, $subject, $body, $headers)) {   //PHP mail Function Use For Sending mail
            $msg = array("status"=>"200","message"=>"otp send on '{$to_email}'");
            echo json_encode($msg);
            self::save_otp_in_db($otp,$remail);        //call Function saving OTP in DATABASE
        } else {
            $msg = array("status"=>"500","message"=>"internal server error");  //Any Error occur
        }
    }


     public function save_otp_in_db($otp,$email)    //here we set otp in database
    {
        
         $sql = "update user set otp='{$otp}' , status = 0 where email='{$email}'";   //Status change if 1  and otp setting
         
         $conn = self::build_connection();                                           //connectivity with database
         $res = $conn->query($sql) or exit("sql query failed");                      //Running Query

    }   

 }


//Data get from user through Postmen
$data  = json_decode(file_get_contents('php://input'),true);     //Postman Input
$email = $data['u_email'];                                       //Fecth email in variable
$_SESSION['email'] = $email;                                     //Creating Session for otp_check page for checks
//Object and Function Call
$pass  = new forgetPassword();                                   // object initilization of class
$pass->check_email($email);                                      // call function through object



?>