<?php

require "Database.php";
require "validation.php";

header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content_Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

$validate= new Validate();
$database= new Database();

$data=json_decode(file_get_contents("php://input"),true);

$Address=$data['address'];
$Gender=$data['gender'];

function for_validate($data,$validate)
    {
       $che=true;
                                                                    
       if(!$validate->cnic_validate($data['cnic']))  { $che=false; }   // validating cnic
                                                                     
       if(!$validate->name_validate($data['name']))  { $che=false; }   // validating name
                                                                    
       if(!$validate->phone_validate($data['phone']))  { $che=false; }  // validating phone
                                                                    
       if(!$validate->email_validate($data['email']))  { $che=false; }   // validating email                                           
                                                                    
       if(!$validate->dep_validate($data['department']))  { $che=false; }  // validating department
    
       return $che;
    }

if(!for_validate($data,$validate))
{
    echo json_encode(array('Message'=>'Validation failed :','status'=>false));
}
$Name = $data['name'];
$Phone = $data['phone'];
$Department = $data['department'];
$CNIC = $data['cnic'];
$Email = $data['email'];

$parameter = array($Name,$Phone,$Address,$Department,$Gender,$CNIC,$Email);
check_empty($parameter,$database);

echo $Name;
echo $Phone;
echo $Address;
echo $Department;
echo $Gender;
echo $CNIC;
echo $Email;

function check_empty($parameter,$database)
    {
        if((empty($parameter[0])) || (empty($parameter[1])) || (empty($parameter[2])) || (empty($parameter[3])) || (empty($parameter[4])) || (empty($parameter[5]))){
            echo json_encode(array('Message'=>'Enter into the fields :','status'=>false));
        }
        else{
            insert_in($parameter,$database);
        }
    }

function insert_in($parameter,$database)
    {
        if(($parameter))
        { 
            $database->insert("employee",$parameter);
            echo json_encode(array('Message'=>'Updated Successfully :','status'=>true));
        }
        else{
            echo json_encode(array('Message'=>'Please Enter valid Data :','status'=>false));
        }
    }

?>