<!DOCTYPE html>
<!--
    Filter by Date over all Outlets 
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $servername = "silva.computing.dundee.ac.uk";
            $username = "ip17team2";
            $password = "9032.ip17t.2309";
            $db = "ip17team2db";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $db);
            
            // Check connection
            if ($conn->connect_error) {
                echo "Unsuccessful";
                die("Connection failed: " . $conn->connect_error);
            } 
            else 
            {
                echo "Connected successfully <br>";  
            }
            
            $first_dateTime = "04/08/2017 00:00";
            $last_dateTime = "04/08/2017 23:59";
            $count = 1;
            ini_set('max_execution_time', 1000000000000000);

            $qr = $conn->query("CALL filter_by_date('$first_dateTime', '$last_dateTime')");
            echo "Between ". $first_dateTime. " and ". $last_dateTime;
            while ($row = $qr->fetch_assoc()) {
              ?><br><?php echo $count. ": " .$row["transaction_ID"]. " " .$row["outlet_name"]. " Total Amount " .$row["total_amount"]. "<br>";
            $count++;
            }           
            mysqli_close($conn); 
        ?>
    </body>
</html>