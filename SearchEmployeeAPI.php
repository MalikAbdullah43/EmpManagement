<?php
  require "Database.php";
  require "validation.php";
class SearchEmployeeApi{

    // This Function contain all headers of Rest API
    
    function headers_function(){    
        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods:POST");
    }

    // This function will take Name and CNIC as perameter and check validation

    function perameter_validation(&$Name,&$CNIC){
        $validate = new Validate();
        $data = json_decode(file_get_contents("php://input"),true);
        if ($validate->name_validate($data['Name']) == true){
            $Name = $data['Name'];
        }
        else{
            die("Name is not valid");
        }
        if ($validate->cnic_validate($data['CNIC']) == true){
            $CNIC = $data['CNIC'];
        }
        else{
            die("CNIC is not valid");
        }
    }

    // This fucntion will take php object , conver to json format and return json

    function json_conversion($Object)
    {
        return json_encode($Object);
    }

    // This fucntion will take table Name , Name, CNIC and fetch data and print in json format

    function Api($tableName,$Name,$CNIC)
    {
        self::headers_function();
        self::perameter_validation($Name,$CNIC);
        $db = new Database();
        $Employee = $db->searchEmployee($tableName,$Name,$CNIC);
        $Employee = self::json_conversion($Employee);
        echo $Employee;
    }
}
    $tableName = "employee";
    $Name = null;
    $CNIC = null;
    $SearchAPI = new SearchEmployeeApi();
    $SearchAPI->API($tableName,$Name,$CNIC);
  
  

  
  
?>