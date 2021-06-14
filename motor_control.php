<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$response = array();
include('dbconnect.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
 
    $id = $_GET['id'];
    $status= $_GET['status'];
    
     $result = "UPDATE motor SET status= '$status' WHERE id = '$id'";
    
    $run=mysqli_query($con,$result);
 
   
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "MOTOR Status successfully updated.";
 
        echo json_encode($response);
    } else {
 
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    echo json_encode($response);
}
?>
