<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database{

    public function build_connection(){     //build sql database connection 
        $conn = new mysqli("localhost","root","","emp");
        if ($conn->connect_error){
            echo "Database Connection Error";
        }
        else{
            return $conn;
        }
        
    }
    public function close_connection($conn){   //close database connection
        $conn->close();
    }

    /**
     * Function to insert user or Employee in database.
     * 
     */
    function insert($tableName,$perameter){
        if ($tableName == "user"){
            $innerPera = "Name,Phone,Address,Gender,CNIC,Email,UserPassword";
        }else{
            $innerPera = "Name,Phone,Address,Deparment,Gender,CNIC,Email";
        }
        $S = implode("','",$perameter);
        $T = "'".$S."'";
        $conn = self::build_connection();
        $q = "insert into $tableName($innerPera) values($T)";
        $conn->query($q);
        self::close_connection($conn);
    }

    /**
     * This function is used to fetch users from table.
     */
    function Fetch_list($tableName)
    {
        $conn = self::build_connection();
        $q = "select * from ".$tableName;
        $result = $conn->query($q);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        self::close_connection($conn);
        return $data;
    }

    /**
     * This function is used to select user from table with the specific cnic.
     */
    function search_employ_by_cnic($tableName,$cnic)        // searching employee by cnic
    {
        $conn = self::build_connection();
        $q = "select * from ".$tableName ." WHERE cnic='{$cnic}'";
        $result = $conn->query($q);
        self::close_connection($conn);
        if($result->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * This functioon is used to search employee with specific CNIC and name.
     */
    function searchEmployee($tableName,$Name,$CNIC){
        $conn = self::build_connection();
        $N = "'$Name'";
        $C = "'$CNIC'";
        $q = "select * from $tableName where CNIC = $C and Name = $N";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        self::close_connection($conn);
        return $row;
    }
   
}

?>
