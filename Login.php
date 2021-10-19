<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST"); //header used to insert data
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "Database.php";
include "validation.php";

class User extends Validate
{
    public $email;
    public $user_password;
    private $conn;
    private $tb_name="user";
    public function __construct($db)
    {
        $this->conn=$db; 
    }
    function validation()//check validation if userpassword pattern and email pattern is correct
    {
        $validates = new Validate();  
        if($validates->password_validate($this->user_password)==true){
            return true;
        }
        else
        {
            $message_display=array("Status_code"=>422,"Message"=>'Your password must be at least 8 characters and Atleast One Upper case letter!');//status code 422 because user enter less than 8 characters
            print_r(json_encode($message_display));
            http_response_code(422); 
            return false;
        }
        if($validates->email_validate($this->email)==true){

            return true;
        } 
        else
        {
            $message_display=array("Status_code"=>422,"Message"=>'Invalid Email pattern');//status code 422 because user enter invalid email
            print_r(json_encode($message_display));
            http_response_code(422); 
            return false;
        }
    }
    function login()//Login function
    {
        $query = "SELECT * FROM ".$this->tb_name." WHERE Userpassword= '".$this->user_password."'AND Email='".$this->email."'";//sql query to check Password and email is present in databse 
        $result = $this->conn->query($query);
        return $result;            
    }
}
$data = json_decode(file_get_contents("php://input"), true);//decode input request parameters and store them in an array.
if($_SERVER["REQUEST_METHOD"] != "POST")//Check if request method is not $_POST send error message and terminate program
{
      $message_display=array("Status_code"=>404,"Message"=>'Page not found');//status code 404 because request method is wrong
      print_r(json_encode($message_display));
      http_response_code(404); 
      exit();
}
$user_password= $data["userpassword"];
$email= $data["email"];
$database = new Database(); //Creating Object of class Database
$db = $database ->build_connection();
$system_user = new User($db);//Creating Object of class User
$system_user->user_password=isset($_POST['userpassword'])? $_POST['userpassword'] : die();
$system_user->email= isset($_POST['email']) ? $_POST['email']:die();
$check=$system_user->validation();
if($check==false)//if function validation return false terminate program
{
 exit();
}
if($check==true)//if function validation return true call login function
{
  $result= $system_user->login();//Calling login function
}
if(mysqli_num_rows($result)>0)//if row count in the database is greater than zero 
{
   $get_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
   $message_display=array("Status_code"=>200,"Message"=>"Successfully Login");//if password and email are matched display this message
   http_response_code(200); 
}
else
{
   $message_display=array("Status_code"=>422,"Message"=>"Invalid Email or password");//if password and email are wrong display error message
   http_response_code(422); 
}

print_r(json_encode($message_display));
?>