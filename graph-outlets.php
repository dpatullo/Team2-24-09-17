<?php
/**
 * Created by IntelliJ IDEA.
 * User: cmckillop
 * Date: 13/09/2017
 * Time: 10:45
 */
?>

<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="assets/styles.css" rel="stylesheet">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <title>Outlets | Graphs</title>
  

    </head>
    <body>

        <?php $currentPage = "graph"; include "header.php";?>
		

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="graph-overview.php">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graph-consumers.php">Consumers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="graph-outlets.php">Outlets<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graph-transactions.php">Transactions</a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Export</a>
                        </li>
                    </ul>
                </nav>

                <main class="ml-sm-auto col-md-10 pt-3" role="main">
			
                    <h1 id="overview">Outlets</h1>
					
					<canvas id="line-chart" width = "1200" height="450"></canvas>
					
				
					<form action="" method="post">
						<p>Date: <input name="date" type="text" id="datepicker" ></p>
						<input type="submit"  value="Submit" /></p>
					</form>
					
				</main>

            </div>
        </div>
	
	<?php 
		$Date = filter_input(INPUT_POST, 'date'); 
	
	   	   include('connectToDatabase.php');
            $outlet = "Mono"; // change to session variable once set up 
            $first_Datetime = "$Date 00:00:00";
            $last_Datetime = "$Date 23:59:59"; 
            $count = 0;
            $firstCount = 0; 
            $secondCount = 0; 
            $thirdCount = 0; 
            $fourthCount = 0; 
            $fifthCount = 0; 
            $sixthCount = 0; 
            $seventhCount = 0;
            
           // echo "<br> first date " .$first_Datetime;

            
            ini_set('max_execution_time', 1000000000000000);
            $qr = $conn->query("CALL sort_By_Date('$outlet','$first_Datetime', '$last_Datetime')");
            $times = array();
            while ($row = $qr->fetch_assoc())
            {   
                $count++;
               
               if (($row["date_time"] >= "$Date 00:00:00") && ($row["date_time"] <= "$Date 03:59:59"))
               {
                    $firstCount++;
               }
               if (($row["date_time"] >= "$Date 04:00:00") && ($row["date_time"] <= "$Date 07:59:59"))
               {
                    $secondCount++;
               }
              
              if (($row["date_time"] >= "$Date 08:00:00") && ($row["date_time"] <= "$Date 11:59:59"))
               {
                    $thirdCount++;
               }
              
               if (($row["date_time"] >= "$Date 12:00:00") && ($row["date_time"] <= "$Date 15:59:59"))
                {
                    $fourthCount++;
                }
             
                if (($row["date_time"] >= "$Date 16:00:00") && ($row["date_time"] <= "$Date 19:59:59"))
                {
                    $fifthCount++;
                }
                
               if (($row["date_time"] >= "$Date 20:00:00") && ($row["date_time"] <= "$Date 23:59:59"))
               {
                   $sixthCount++;
               }
              
            }
          //echo "Total No. of Sales for Today between " .$first_Datetime. " and " .$last_Datetime. ": " .$count. "<br>";
            //echo "midnight to 4am count: " .$firstCount. "<br> 4am to 8am count: " .$secondCount. "<br> 8am to 12pm count: " .$thirdCount. "<br> 12pm to 4pm count: " . $fourthCount. "<br>  4pm to 8pm count: " .$fifthCount. "<br> 8pm to midnight count: " .$sixthCount;
        ?>

<script>
    new Chart(document.getElementById("line-chart"), {
	  type: 'line',
	  data: {
		  labels: ["0000 - 0400", "0400 - 0800", "0800-1200", "1200-1600", "1600-2000", "2000-2359"],
		datasets: [{ 
			data: ["<?php Print($firstCount); ?>","<?php Print($secondCount); ?>","<?php Print($thirdCount); ?>","<?php Print($fourthCount); ?>","<?php Print($fifthCount); ?>","<?php Print($sixthCount); ?>", "<?php Print($seventhCount); ?>"],
			label: "<?php Print($outlet)?>",
			
			borderColor: "#3e95cd",
			fill: false
		  }
		]
	  },
	  options: {
		title: {
		  display: true,
		  text: 'No. of Sales: <?php Print($Date); ?>' 
		}
	  }
	});
	
  $( function() {
	$( "#datepicker" ).datepicker(
			{
				dateFormat: 'yy-mm-dd',
				maxDate: "0",
				yearRange: "2015:+nn",
				changeYear: true,
				showButtonPanel: true
		   });
	} );

</script>

	  
 <?php   
     mysqli_close($conn); 
 ?>

    </body>
</html>