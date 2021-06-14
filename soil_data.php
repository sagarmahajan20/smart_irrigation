<?php
error_reporting(0);

$response = array();
 
if (  $_GET['soil'] && $_GET['id'] == "vit" && $_GET['password'] == "vit")  
{
    $soil = $_GET['soil'];
   


    include('dbconnect.php');
    
    


    $result = "INSERT INTO `soil`(`soil`) VALUES ($soil)";
    
    $run=mysqli_query($con,$result);
    


    if ($result) 
    {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "hey Sagar, Data of your farm added sucesfully!!  ";
 
        // Show JSON response
        echo json_encode($response);
    }
     else 
     {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
 
        // Show JSON response
        echo json_encode($response);
    }

} 
else
{
    
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    
    echo json_encode($response);
}
?>