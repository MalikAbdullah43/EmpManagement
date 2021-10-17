<?php

require "Database.php";
require "validation.php";

header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content_Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
class AddEmployees extends Database{
    
    private $cnic;
    private $name;
    private $phone;
    private $address;
    private $password;
    private $gender;
    private $data;
    private $parameter;

    function get_data()
    {
        $data=json_decode(file_get_contents("php://input"),true);
        $Name = $data['name'];
        $Phone = $data['phone'];
        $Department = $data['department'];
        $CNIC = $data['cnic'];
        $Email = $data['email'];
        $Address=$data['address'];
        $Gender=$data['gender'];
        $parameter = array($Name,$Phone,$Address,$Department,$Gender,$CNIC,$Email);
        return $parameter;
    }
    function validation($parameter)
    {
       $flag=true;
       $validate= new Validate();                                                  
       if(!$validate->cnic_validate($parameter[5]))  { $flag=false; }   // validating cnic                                                   
       if(!$validate->name_validate($parameter[0]))  { $flag=false; }   // validating name                                                            
       if(!$validate->phone_validate($parameter[1]))  { $flag=false; }  // validating phone
       if(!$validate->email_validate($parameter[6]))  { $flag=false; }   // validating email                                           
       if(!$validate->dep_validate($parameter[3]))  { $flag=false; }  // validating department
       return $flag;
    }

    function check_empty($parameter)
    {
        if((empty($parameter[0])) || (empty($parameter[1])) || (empty($parameter[2])) || (empty($parameter[3])) || (empty($parameter[4])) || (empty($parameter[5])))
        {
            echo json_encode(array('Message'=>'Enter into the fields :','status'=>false));
        }
        else
        {
            self::insert_in($parameter);
        }
    }

    function insert_in($parameter)
    {
        $database= new Database();
        if(($parameter))
        { 
            $database->insert("employee",$parameter);
            echo json_encode(array('Message'=>'Updated Successfully :','status'=>true));
        }
        else{
            echo json_encode(array('Message'=>'Please Enter valid Data :','status'=>false));
        }
    }
}
$Add= new AddEmployees();
$vali = $Add->get_data();
if($Add->validation($vali)==false)
{
    echo json_encode(array('Message'=>'Validation failed :','status'=>false));
    die("!");
}
$Add->check_empty($vali);
?>