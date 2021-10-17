<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database{

    private function build_connection(){     //build sql database connection 
        $conn = new mysqli("localhost","root","","emp1");
        if ($conn->connect_error){
            echo "Database Connection Error";
        }
        else{
            return $conn;
        }
        
    }
    private function close_connection($conn){   //close database connection
        $conn->close();
    }

    /**
     * Function to insert user in database.
     * 
     */
    function insert($tableName,$perameter){
        //$perameter = "'$Name'".','.$Phone.','."'$Address'".','."'$Gender'".','."'$CNIC'".','."'$Email'";
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
    // function insertEmployee($Name,$Phone,$Address,$Deparment,$Gender,$CNIC,$Email){
    //     $perameter = "'$Name'".','.$Phone.','."'$Address'".','."'$Deparment'".','."'$Gender'".','."'$CNIC'".','."'$Email'";
    //     $conn = self::buildConnection();
    //     $q = "insert into employee(Name,Phone,Address,Deparment,Gender,CNIC,Email) values($perameter)";
    //     $conn->query($q);
    //     self::closeConnection($conn);
    // }

    /**
     * This function is used to fetch users from table.
     */
    function Fetch_list($tableName)
    {
        $conn = self::build_connection();
        $q = "select * from ".$tableName;
        $result = $conn->query($q);
        $data = $result->fetch_all(MYSQL_ASSOC);
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
        if($result->num_rows > 0)
        {
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * This functioon is used to search employee with specific id and name.
     */
    function searchEmployee($Id,$Name){
        $conn = self::build_connection();
        $N = "'$Name'";
        $q = "select * from employee where EmployeeId = $Id and Name = $N";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        self::close_connection($conn);
        return $row;
    }
   
}

// $db = new Database();
// $pera = array("Ali","04351234567","lahore","male","bio","2345432345","malik@aldjksf");
// $db->insert("employee",$pera);

?>