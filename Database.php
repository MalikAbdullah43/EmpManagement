<?php

class Database{

    private function build_connection(){
        $conn = new mysqli("localhost","root","","emp");
        if ($conn->connect_error){
            echo "Database Connection Error";
            die;
        }
        else{
            return $conn;
        }
        
    }
    private function close_connection($conn){
        $conn->close();
    }
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

    function Fetch_list($tableName)
    {
        $conn = self::build_connection();
        $q = "select * from ".$tableName;
        $result = $conn->query($q);
        if ($result->num_rows > 0){
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        else{
            return "There is no Record in Database";
        }
        self::close_connection($conn);
        return $data;
    }
     function searchEmployee($Name,$CNIC){
        $conn = self::build_connection();
        $N = "'$Name'";
        $C = "'$CNIC'";
        $q = "select * from employee where CNIC = $C and Name = $N";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        self::close_connection($conn);
        return $row;
    }
   
}
?>
