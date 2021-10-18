<?php
session_start(); 
require 'Database.php';
require 'validation.php';

class savePassword extends Database
{

    function save_password($new_pass,$conf_pass)  //function for confirm password
    {
      $status =  $_SESSION['status'];   //status from database 
      $email  =  $_SESSION['email'];   //email for updation
     
        if($status===0)
        {
            if($new_pass===$conf_pass){
                $conn = self::build_connection(); //database connection
                $sql = "update user set status=1,UserPassword='{$new_pass}' where email = '{$email}'";  //sql query for saving code in database which user enter
                $res = $conn->query($sql);
                self::close_connection($conn);   //connection close with database
            
                    $msg = array("Status"=>"200","Message"=>"Ok Password Set");  //msg okay
                    echo json_encode($msg);  //print on sreen
                    Session_destroy();//destroy all sessions 
                
    
            }
            else{ 
                  $msg =array("Status"=>"422","Message"=>"Both Passsword Not Match");  //password not match
                  echo json_encode($msg);  //print message
            }
          }
        else
        {
            $msg = array("Status"=>"401","Message"=>"Unauthorized Request"); //error message user try to enter unathorized way
            echo json_encode($msg);
        }
    }




}






$data     = json_decode(file_get_contents('php://input'),true);    //input from postman
$new_pass = $data['npass']; 
$conf_pass = $data['cpass'];

$valid_pass = new Validate();            //validate class object for password validation
$valid_pass->password_validate($new_pass);
$valid_pass->password_validate($conf_pass);


$obj = new savePassword();  //object of savePassword class for updating password
$obj->save_password($new_pass,$conf_pass);











?>
