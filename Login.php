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
    public $userpassword;
    private $conn;
    private $tb_name="user";
    public function __construct($db)
    {
        $this->conn=$db; 
    }
    function validation()//check validation if userpassword pattern and email pattern is correct
    {
        if(strlen($this->userpassword) < 8){
            $message_display=array(422,'Your password must be at least 8 characters!');
            print_r(json_encode($message_display));
            return false;
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $message_display=array(422,'Invalid Email pattern');
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
        $query = "SELECT * FROM ".$this->tb_name." WHERE Userpassword= '".$this->userpassword."'AND Email='".$this->email."'";//sql query to check Password and email is present in databse 
        $flag = $this->conn->prepare($query);
        $flag->execute();
        return $flag;
    }
}
$data = json_decode(file_get_contents("php://input"), true);//decode input request parameters and store them in an array.
if($_SERVER["REQUEST_METHOD"] != "POST")//Check if request method is not $_POST send error message
{
    echo"404 page not found";
    return false;
}
$userpassword= $data["userpassword"];
$email= $data["email"];
$database = new Database();
$db = $database ->db_connection();
$usersystem = new User($db);
$usersystem->userpassword=isset($_POST['userpassword'])? $_POST['userpassword'] : die();
$usersystem->email= isset($_POST['email']) ? $_POST['email']:die();
$check=$usersystem->validation();
if($check==false)
{
 exit();
}
if($check==true)
{
  $flag = $usersystem->login();//Calling login function
}
if($flag->rowcount()>0)
{
   $row = $flag->fetch(PDO::FETCH_ASSOC);
   $message_display=array(200,"Successfully Login!");//if password and email are matched display this message
}
else
{
   $message_display=array(422,"Invalid Email or password");//if password and email are wrong display error message
}
print_r(json_encode($message_display));
?>