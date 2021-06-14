<?php
error_reporting(0);

$response = array();
 
if ( isset($_GET['temp']) && isset($_GET['hum'])  && $_GET['id'] == "vit" && $_GET['password'] == "vit")
{
    $tablename = $_GET['temp'];
    $userid = $_GET['hum'];
   


    include('dbconnect.php');
    
    


    $result = "INSERT INTO `weather`(`temp`, `hum`) VALUES ('1','2')";
    
    $run=mysqli_query($con,$result);
    


    if ($result) 
    {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "hey Sagar, Data of yoyr farm added sucesfully!! ";
 
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