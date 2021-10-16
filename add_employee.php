<?php

require "Database.php";
require "validation.php";

header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content_Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

$validate= new Validate();
$database= new Database();

$data=json_decode(file_get_contents("php://input"),true);

// $Name=$data['name'];
// $Phone=$data['phone'];
$Address=$data['address'];
// $Department=$data['department'];
$Gender=$data['gender'];

if($validate->name_validate($data['name'])==true)
{
    $Name = $data['name'];
}
else
{
    die("Name is not valid");
}
if($validate->phone_validate($data['phone'])==true)
{
    $Phone = $data['phone'];
}
else
{
    die("Phone number is not valid");
}
if($validate->dep_validate($data['department'])==true)
{
    $Department = $data['department'];
}
else
{
    die("Department is not valid");
}
if($validate->cnic_validate($data['cnic'])==true)
{
    $CNIC = $data['cnic'];
}
else
{
    die("CNIC is not valid");
}
if($validate->email_validate($data['email'])==true)
{
    $Email = $data['email'];
}
else
{
    die("Email is not valid");
}
$parameter = array($Name,$Phone,$Address,$Department,$Gender,$CNIC,$Email);
$database->insert("employee",$parameter);
$output = "your data has been successfully inserted in Database";
echo json_encode($output);
?>