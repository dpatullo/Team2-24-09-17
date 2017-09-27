<!DOCTYPE html>
<html lang="en">
<head>
<!-- Date picker -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Black Card Trends</title>
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
                changeYear: true
         
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
            $newDate = $Date;
            $tempDate = $newDate++;
            echo $newDate;
           
          include('connectToDatabase.php');
            $outlet = "Level 2 Reception"; // change to session variable once set up 
            $first_Datetime = "$Date 17:00:00";
            $last_Datetime = "$newDate 02:59:59"; 
            $count = 0;
            $firstCount = 0; 
            $secondCount = 0; 
            $thirdCount = 0; 
            $fourthCount = 0; 
            $fifthCount = 0; 
            $sixthCount = 0; 
            $seventhCount = 0;
            $eighthCount = 0;
            $ninthCount = 0;
            $tenthCount = 0;
           
            echo "<br> first date " .$first_Datetime;
                    
            
            ini_set('max_execution_time', 1000000000000000);
            $qr = $conn->query("CALL payment_entry('$outlet', '$first_Datetime', '$last_Datetime')");
            $times = array();
            while ($row = $qr->fetch_assoc())
            {   
                $count++;
                echo "<br> " .$row["new_user"];
               
               if (($row["date_time"] >= "$Date 17:00:00") && ($row["date_time"] <= "$Date 17:59:59"))
               {
                    $firstCount++;
               }
               if (($row["date_time"] >= "$Date 18:00:00") && ($row["date_time"] <= "$Date 18:59:59"))
               {
                    $secondCount++;
               }
              
              if (($row["date_time"] >= "$Date 19:00:00") && ($row["date_time"] <= "$Date 19:59:59"))
               {
                    $thirdCount++;
               }
              
               if (($row["date_time"] >= "$Date 20:00:00") && ($row["date_time"] <= "$Date 20:59:59"))
                {
                    $fourthCount++;
                }
             
                if (($row["date_time"] >= "$Date 21:00:00") && ($row["date_time"] <= "$Date 21:59:59"))
                {
                    $fifthCount++;
                }
                
               if (($row["date_time"] >= "$Date 22:00:00") && ($row["date_time"] <= "$Date 22:59:59"))
               {
                   $sixthCount++;
               }
                 if (($row["date_time"] >= "$Date 23:00:00") && ($row["date_time"] <= "$Date 23:59:59"))
               {
                   $seventhCount++;
               }
                 if (($row["date_time"] >= "$newDate 00:00:00") && ($row["date_time"] <= "$newDate 00:59:59"))
               {
                   $eighthCount++;
               }
                if (($row["date_time"] >= "$newDate 01:00:00") && ($row["date_time"] <= "$newDate 01:59:59"))
               {
                   $ninthCount++;
               }
                if (($row["date_time"] >= "$newDate 02:00:00") && ($row["date_time"] <= "$newDate 02:59:59"))
               {
                   $tenthCount++;
               }
            }
            echo "Total No. of Sales for Today between " .$first_Datetime. " and " .$last_Datetime. ": " .$count. "<br>";
            echo "5pm to 5.59pm count: " .$firstCount. "<br> 6pm to 6.59pm count: " .$secondCount. "<br> 7pm to 7.59pm count: " .$thirdCount. "<br> 8pm to 8.59pm count: " . $fourthCount. "<br>  9pm to 9.59pm count: " .$fifthCount. 
                    "<br> 10pm to 10.59pm count: " .$sixthCount. "<br> 11pm to 11.59pm count: " .$seventhCount. "<br> 0.00am to 0.59am count: " .$eighthCount. "<br> 1.00am to 1.59am count: " .$ninthCount. "<br> 2.00am to 2.59am count: " .$tenthCount;
        ?>
<canvas id="line-chart" width="1200" height="450"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
      labels: ["1700-1759", "1800-1859", "1900-1959", "2000-2059", "2100-2159", "2200-2259", "2300-2359", "0000-0059", "0100-0159", "0200-0259"],
    datasets: [{ 
        data: ["<?php Print($firstCount); ?>","<?php Print($secondCount); ?>","<?php Print($thirdCount); ?>","<?php Print($fourthCount); ?>","<?php Print($fifthCount); ?>","<?php Print($sixthCount); ?>", "<?php Print($seventhCount); ?>", "<?php Print($eighthCount);  ?>", "<?php Print($ninthCount); ?>", "<?php Print($tenthCount); ?>"],
        label: "<?php Print($outlet); ?>",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Transactions By Black Card Holders'
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