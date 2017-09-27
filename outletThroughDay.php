<!DOCTYPE html>
<html lang="en">
<head>
<!-- Date picker -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Sales Throughout Business Day</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
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
</head>
<body>
  <!-- Display Date picker -->
  <form action="" method="post">
         <p>Date: <input name="date" type="text" id="datepicker" ></p>
         <input type="submit"  value="Submit" /></p>
</form>
    <?php
    
          
            $Date = filter_input(INPUT_POST, 'date');
        
            echo $Date; 
          
    
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
            
            echo "<br> first date " .$first_Datetime;

            
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
            echo "Total No. of Sales for Today between " .$first_Datetime. " and " .$last_Datetime. ": " .$count. "<br>";
            echo "midnight to 4am count: " .$firstCount. "<br> 4am to 8am count: " .$secondCount. "<br> 8am to 12pm count: " .$thirdCount. "<br> 12pm to 4pm count: " . $fourthCount. "<br>  4pm to 8pm count: " .$fifthCount. "<br> 8pm to midnight count: " .$sixthCount;
        ?>
<canvas id="line-chart" width="1200" height="450"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
      labels: ["0000-0400", "0400-0800", "0800-1200", "1200-1600", "1600-2000", "2000-2359"],
    datasets: [{ 
        data: ["<?php Print($firstCount); ?>","<?php Print($secondCount); ?>","<?php Print($thirdCount); ?>","<?php Print($fourthCount); ?>","<?php Print($fifthCount); ?>","<?php Print($sixthCount); ?>", "<?php Print($seventhCount); ?>"],
        label: "<?php Print($outlet); ?>",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'No. of Sales Throughout the Day'
    }
  }
});

</script>

	  
 <?php   
     mysqli_close($conn); 
     echo "<br> closed";
 ?>
    
</body>
</html>