<?php

$response = array();
include('dbconnect.php');

$result ="SELECT * FROM `soil`"; 
$res = mysqli_query($con, $result);


if($_GET['id'] == "vit" && $_GET['password'] == "vit")
{


        if (mysqli_num_rows($res) > 0)
        {
            $response["soil"] = array();
            while ($row = mysqli_fetch_array($res)) 
            {
                $soil = array();
                $soil["id"] = $row["id"];    
                $soil["soil"] = $row["soil"];         
                $soil["timestamp"] = $row["timestamp"];   
                array_push($response["soil"], $soil);
                
            }
            $response["success"] = 1;
            $soil = json_encode($response);
            echo $soil;

        }   
        else 
        {
            $response["success"] = 0;
            $response["message"] = "No data of soil moistur level found";
        
            echo json_encode($response);
        }
      

}
else
{
    echo "Worng Password!";
}



?>