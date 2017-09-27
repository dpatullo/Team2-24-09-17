<!DOCTYPE html>
<!--
   Connection to Database 
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
                echo "Connected successfully";  
            }
            
        ?>
    </body>
</html>