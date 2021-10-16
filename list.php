<?php

header('Content_type: Application/jason');
header('Access-Control-Allow-Origin:*');;
header('Access-Control-Method:POST');

require 'Database.php';


$db = new Database();                      // Creating object of  Database Class
$row = $db->Fetch_list("employee");        // Call Function to fetch all data of employee table  
echo json_encode($row);                    //Encode the json formate and show data

?>