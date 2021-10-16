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

    function login()//Login function
    {  
        $query = "SELECT * FROM ".$this->tb_name." WHERE Userpassword= '".$this->userpassword."'AND Email='".$this->email."'";//sql query to check Password and email is present in databse 
        $flag = $this->conn->prepare($query);
        $flag->execute();
        return $flag;
    }
}
$data = json_decode(file_get_contents("php://input"), true);
if($_SERVER["REQUEST_METHOD"] != "POST")
{
    echo"404 page not found";
    return false;
}
$userpassword= $data['userpassword'];
$email= $data['email'];
$database = new Database();
$db = $database ->db_connection();
$usersystem = new User($db);
$usersystem->userpassword=isset($_POST['userpassword'])? $_POST['userpassword'] : die();
$usersystem->email= isset($_POST['email']) ? $_POST['email']:die();
$flag = $usersystem->login();//Calling login fucnction
if($flag->rowcount()>0)
{
    $row = $flag->fetch(PDO::FETCH_ASSOC);
    $message_display=array("status" => true, "message"=>"Successfully Login!");//if password and email are matched display this message
}
else
{
    $message_display=array("status"=>false,"message"=>"422 Invalid Email or password");//if password and email are wrong display error message
}
print_r(json_encode($message_display));
?>