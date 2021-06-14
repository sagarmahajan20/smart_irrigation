<?php
error_reporting(0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
$con  = mysqli_connect("localhost","root","","iot");

 if (!$con) {

    echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         
 		 $sql ="SELECT * FROM soil";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) 
        { 
 
             $productname=$row['soil'];
            $month[]  = date_format(date_create( $row['timestamp']),"M d, Y")  ;
            $sales[] = $row['soil'];
        }
 
 		

 }
?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Smart Farming</title> 
    </head>
<style>

.form{
		padding-top: 50px;
		padding-right: 30px;
		padding-bottom: 50px;
		padding-left: 30px;
	}

	.button {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		padding: 16px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
		cursor: pointer;
	}

	.button1 {
		background-color: white; 
		color: black; 
	}

	.button1:hover {
		background-color: #4CAF50;
		color: white;
	}

	.button3 {
		background-color: white; 
		color: black; 
	}

	.button3:hover {
		background-color: #F44336;
		color: white;
	}

	.ip{
		background-color: #fffff; /* Green */
		border: none;
		color: black;
		padding: 16px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		-webkit-transition-duration: 0.4s; /* Safari */
	}

	.footer{
		background:#64B5F6;
		width:100%;
		height:100px;
		position:absolute;
		bottom:0;
		left:0;
	}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;

}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Control the left side */
.left {
  left: 0;
}

/* Control the right side */
.right {
  right: 0;
}

/* If you want the content centered horizontally and vertically */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

/* Style the image inside the centered container, if needed */
.centered img {
  width: 150px;
  border-radius: 50%;
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin: 40px 10px 0px 0px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;
margin: 54px 30px 30px;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;

}	


</style>
    <body>
    	 

   	<table width = "100%" border = "0">
         
         <tr>
            <td colspan = "2" bgcolor = "#b5dcb3">
               <h1 align="center">Smart Irrigation System</h1>
            </td>
         </tr>
         <tr valign = "top">
            <td bgcolor = "#aaa" width = "50%" height = "200">
              	<div style="width:50%;hieght:20%;text-align:center">
	            <h2 class="page-header" >Soil Moisture Content </h2>
	            <div><?php echo $productname; ?> </div>
	            <canvas  id="chartjs_line"></canvas> 
            </td>
          
            <td bgcolor = "#aaa" width = "50%" height = "200">
               
				<center>
						<h1 style="font-family: Helvetica;color: white;">MOTOR CONTROL</h1>
					</center>
				   
				   <div class="center">
					<div align="center" class="form">
				       <form action="" method="get">
				              <button type="button" id="D1-on" class="button button1" >D1 ON</button>
							  <button type="button" id="D1-off" class="button button3" >D1 OFF</button>
							  <br>
							  <button type="button" id="D2-on" class="button button1" >D2 ON</button>
							  <button type="button" id="D2-off" class="button button3" >D2 OFF</button>
							  <br>
							  <button type="button" id="D3-on" class="button button1" >D3 ON</button>
							  <button type="button" id="D3-off" class="button button3" >D3 OFF</button>
							  <br>
						        </form>
						<br><br>
					 </div>
					</div>
			
            </td>

            
            
         </tr>

 		

         <!--tr>
             <td bgcolor = "#aaa" width = "50%" height = "200">
              	<div style="width:50%;hieght:20%;text-align:center">
	            <h2 class="page-header" >Humidity Level </h2>
	            <div><?php echo $productname; ?> </div>
	            <canvas  id="chartjs_line"></canvas> 
            </td>
         </tr>-->
         
      </table>     
   		
<table id="customers">


	  <?php
		include('dbconnect.php');
		
		

		$result = "SELECT id, temp, hum, timestamp FROM weather";
		$res = mysqli_query($con, $result);

		 if (mysqli_num_rows($res) > 0)
        {
        	echo "<h1>Temprature and Humidity Level</h1>";
        	echo "<table><tr><th>ID</th><th>Temprature</th><th>Humidity</th><th>Timestamp</th></tr>";
		 
            $response["weather"] = array();
            while ($row = mysqli_fetch_array($res)) 
            {
               
                echo "<tr><td>".$row["id"]."</td><td>".$row["temp"]."</td><td>".$row["hum"]."</td><td>".$row["timestamp"]."</td></tr>";
                
            }
            $response["success"] = 1;
            $soil = json_encode($response);
            echo $weather;

        }   


		
		?>	
  
 
  
</table>



    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
    	document.getElementById('D1-on').addEventListener('click', function() {
				var url = "http://localhost/iot/motor_control.php?id=1&status=on";
				$.getJSON(url, function(data) {
					console.log(data);
				});
		});
		
		document.getElementById('D1-off').addEventListener('click', function() {
				var url = "http://localhost/iot/motor_control.php?id=1&status=off";
				$.getJSON(url, function(data) {
					console.log(data);
				});
		});
		
		
		document.getElementById('D2-on').addEventListener('click', function() {
				var url = "http://localhost/iot/motor_control.php?id=2&status=on";
				$.getJSON(url, function(data) {
					console.log(data);
				});
		});
		
		document.getElementById('D2-off').addEventListener('click', function() {
				var url = "http://localhost/iot/motor_control.php?id=2&status=off";
				$.getJSON(url, function(data) {
					console.log(data);
				});
		});
		
		
		document.getElementById('D3-on').addEventListener('click', function() {
				var url = "http://localhost/iot/motor_control.php?id=3&status=on";
				$.getJSON(url, function(data) {
					console.log(data);
				});
		});
		
		document.getElementById('D3-off').addEventListener('click', function() {
				var url = "http://localhost/iot/motor_control.php?id=3&status=off";
				$.getJSON(url, function(data) {
					console.log(data);
				});
		});



      var ctx = document.getElementById("chartjs_line").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:<?php echo json_encode($month); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</html>
