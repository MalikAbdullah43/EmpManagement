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
  if ($validate->cnic_validate($data['CNIC']) == true){
    $CNIC = $data['CNIC'];
  }
  else{
    die("CNIC is not valid");
  }

  $Employee = $db->searchEmployee($Name,$CNIC);
  echo json_encode($Employee);
?>