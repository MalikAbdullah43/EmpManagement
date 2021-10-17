<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: Application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Methods: post");
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Headers,Authorization,X-Requested-With');

    include "validation.php";
    require "Database.php";
    
    class signup extends Database{

        private $table_name;
        private $cnic;
        private $name;
        private $phone;
        private $address;
        private $password;
        private $gender;
        private $data;
        private $parameter;
        /**
         * Function to get the information through the postman
         */
        function get_data(){
            $data=json_decode(file_get_contents("php://input"),true);   //decde input request parameters and store them in an array.
    
            $cnic=$data["cnic"];
            $name=$data["name"];
            $phone=$data["phone"];
            $address=$data["address"];
            $password=$data["password"];
            $gender=$data["gender"];
            $email=$data["email"];
            $parameter=array($name,$phone,$address,$gender,$cnic,$email,$password); //store all data in array(parameter)

            if($parameter[0]=="" || $parameter[1]=="" || $parameter[2]=="" || $parameter[4]=="" || $parameter[5]=="" || $parameter[6]==""){
                return false;}
            else{ return $parameter; }
        }
        /**
         * Function to validate request input.
         */
        function validation($parameter){
            $che=true;
            $obj=new Validate();
            if(!$obj->cnic_validate($parameter[4]))  { $che=false; }   // validating cnic                                                   
            if(!$obj->name_validate($parameter[0]))  { $che=false; }   // validating name                                                            
            if(!$obj->phone_validate($parameter[1]))  { $che=false; }  // validating phone
            if(!$obj->email_validate($parameter[5]))  { $che=false; }   // validating email                                           
            if(!$obj->password_validate($parameter[6]))  { $che=false; }  // validating password
            return $che;
        }
        /**
         * function to insert data in data base after successful signup by the user
         */
        function insert_data($parameter){
            if(self::search_employ_by_cnic("user",$parameter[4])) //checking whether user already exists or not
            {
                echo json_encode(array('Message'=>'User Already Exist With This CNIC','status'=>"409"));  //status code 409 because user data added successfuly
            }
            else{
                $table_name="user";
                self::insert($table_name,$parameter);  //insert data for new user
                echo json_encode(array('Message'=>'SignUp Successfully :','status'=>"201"));  //status code 201 because user data added successfuly
            }
        }
    }
    $obj = new signup();    //create object signup class 
    $p1=$obj->get_data();   //function call and get array
    if(!$obj->get_data()){      //check get_data return true or false
        echo json_encode(array('Message'=>'Please Fill All the Fields :','status'=>"422")); //status code 422 because user not fill important field
    }
    else{
        if($obj->validation($p1)){
            $obj->insert_data($p1);
        }
        else{
            echo json_encode(array('Message'=>'Please Enter valid Data :','status'=>"422"));    //status code 422 because user enter invalid data
        }   
    }
?>