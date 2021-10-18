<?php
header('Content_type: Application/jason');
header('Access-Control-Allow-Origin:*');;
header('Access-Control-Method:POST');

require 'Database.php';
class EmpList{
    // This fucntion will take php object , conver to json format and return json
    function json_conversion($data)
    {
        return json_encode($data);
    }

    //This Function Call Database function To show all data from employee table
    public function show_employee_list()
    {
        $db = new Database();
        $row = $db->Fetch_list("employee");
        $data = self::json_conversion($row);
        return $data;

    }
    
    

}
$emp_list = new EmpList ();               // Craete object of EmpList class
$data = $emp_list->show_employee_list();
echo $data;



?>