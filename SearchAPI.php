<?php
  require "Database.php";
  require "validation.php";

  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods:POST");
  $validate = new Validate();
  $db = new Database();
  $data = json_decode(file_get_contents("php://input"),true);
  if ($validate->name_validate($data['Name']) == true){
    $Name = $data['Name'];
  }
  else{
    die("Name is not valid");
  }
  $Id = $data['EmployeeId'];

  $Employee = $db->searchEmployee($Id,$Name);
  echo json_encode($Employee);
?>