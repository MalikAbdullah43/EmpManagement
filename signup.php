<?php
header("Content-Type: Application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Methods: post");
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Headers,Authorization,X-Requested-With');

include "validation.php";
require "Database.php";



    
     $table_name;
     $cnic;
     $id;
     $name;
     $phone;
     $address;
     $password;
     $gender;




    $data=json_decode(file_get_contents("php://input"),true);

   $cnic=$data["cnic"];
   $name=$data["name"];
   $phone=$data["phone"];
   $address=$data["address"];
   $password=$data["password"];
   $gender=$data["gender"];
   $email=$data["email"];
   
  
   

    function vali($parameter){

        $che=true;
        $obj=new Validate();
                                                                
       if(!$obj->cnic_validate($parameter[4]))  { $che=false; }   // validating cnic
                                                                 
       if(!$obj->name_validate($parameter[0]))  { $che=false; }   // validating name
                                                                
       if(!$obj->phone_validate($parameter[1]))  { $che=false; }  // validating phone
                                                                
        if(!$obj->email_validate($parameter[5]))  { $che=false; }   // validating email                                           
                                                                
        if(!$obj->password_validate($parameter[6]))  { $che=false; }  // validating password

        return $che;

    }

    $parameter=array($name,$phone,$address,$gender,$cnic,$email,$password);
    if(vali($parameter))
    { 
        
        $data=new Database();
        $table_name="user";
        $data->insert($table_name,$parameter);
        echo "update";
    }
    else{

        echo "invalid data";
        
    }
    /*$cni1c="35401-6613668-7";
    $obj=new Validate();
    
    $id;
    $name;
    $phone;
    $address;
    $email;
    $department;
    $gender;*/








?>