<?php

$response = array();
include('dbconnect.php');

$result ="SELECT * FROM `weather`"; 
$res = mysqli_query($con, $result);


if($_GET['id'] == "vit" && $_GET['password'] == "vit")
{


        if (mysqli_num_rows($res) > 0)
        {
            $response["weather"] = array();
            while ($row = mysqli_fetch_array($res)) 
            {
                $weather = array();
                $weather["id"] = $row["id"];    
                $weather["temp"] = $row["temp"];
                $weather["hum"] = $row["hum"];         
                $weather["timestamp"] = $row["timestamp"];   
                array_push($response["weather"], $weather);
                
            }
            $response["success"] = 1;
            $weather = json_encode($response);
            echo $weather;

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
    echo "Worng Password!";
}



?>