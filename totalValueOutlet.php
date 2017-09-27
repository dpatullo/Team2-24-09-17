<!DOCTYPE html>
<!--
    Total Value of individual outlet 
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include '//zeno.computing.dundee.ac.uk/2017-projects/team2/connectToDatabase.php';
            $outlet = "Liar Bar";
            ini_set('max_execution_time', 1000000000000000);
            $qr = $conn->query("CALL total_value_of_outlet('".$outlet."')");
            while ($row = $qr->fetch_assoc()) {
                ?><br><?php echo $outlet. " Total Value: £" . $row["sum(total_amount)"]. "<br>";
            }
            
            mysqli_close($conn); 
        ?>
    </body>
</html>


