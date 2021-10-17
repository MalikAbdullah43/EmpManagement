<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST"); //header used to insert data
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
class Database{ //Class Database 
    private $host = 'localhost'; 
    private $username="root";
    private $password="";
    private $db_name= "emp";
    public $conn;
    public function db_connection(){ // Database Connection
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected";
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
    }
}
class User
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
        if(strlen($this->user_password) < 8){
            $message_display=array("Status_code"=>422,"Message"=>'Your password must be at least 8 characters!');//status code 422 because user enter less than 8 characters
            print_r(json_encode($message_display));
            return false;
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $message_display=array("Status_code"=>422,"Message"=>'Invalid Email pattern');//status code 422 because user enter invalid email
            print_r(json_encode($message_display));
            return false;
        } 
        else
        {
            return true;
        }
    }
    function login()//Login function
    {
        $query = "SELECT * FROM ".$this->tb_name." WHERE Userpassword= '".$this->user_password."'AND Email='".$this->email."'";//sql query to check Password and email is present in databse 
        $flag = $this->conn->prepare($query);
        $flag->execute();
        return $flag;
    }
}
$data = json_decode(file_get_contents("php://input"), true);//decode input request parameters and store them in an array.
if($_SERVER["REQUEST_METHOD"] != "POST")//Check if request method is not $_POST send error message and terminate program
{
    $message_display=array("Status_code"=>404,"Message"=>'Page not found');//status code 404 because request method is wrong
    print_r(json_encode($message_display));
    exit();
}
$user_password= $data["userpassword"];
$email= $data["email"];
$database = new Database(); //Creating Object of class Database
$db = $database ->db_connection();
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
  $flag = $system_user->login();//Calling login function
}
if($flag->rowcount()>0)//if row count in the database is greater than zero 
{
   $get_data = $flag->fetch(PDO::FETCH_ASSOC);
   $message_display=array("Status_code"=>200,"Message"=>"Successfully Login!","User_Id"=>$get_data['UserId'],"Name"=>$get_data['Name']);//if password and email are matched display this message
}
else
{
   $message_display=array("Status_code"=>422,"Message"=>"Invalid Email or password");//if password and email are wrong display error message
}
print_r(json_encode($message_display));
?>