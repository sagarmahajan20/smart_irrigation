<?php


$response = array();    
include('dbconnect.php');
 

 

if (isset($_GET["id"])) 
{
    $id = $_GET['id'];
 
$result ="SELECT * FROM `motor` WHERE id = '$id'"; 
$res = mysqli_query($con, $result);

        if (mysqli_num_rows($res) > 0)
        {
            $response["motor"] = array();
            while ($row = mysqli_fetch_array($res)) 
            {
                $motor = array();
                $motor["id"] = $row["id"];    
                $motor["status"] = $row["status"];           
                array_push($response["motor"], $motor);
                
            }
            $response["success"] = 1;
            $motor = json_encode($response);
            echo $motor;

        }   
        else 
        {
            $response["success"] = 0;
            $response["message"] = "No data of farm found";
        
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