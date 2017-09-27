<?php
$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");
echo $q;

session_start();

//database
define('DB_HOST', 'silva.computing.dundee.ac.uk');
define('DB_USERNAME', 'ip17team2');
define('DB_PASSWORD', '9032.ip17t.2309');
define('DB_NAME', 'ip17team2db');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
    die("Connection didn't work amigo. Error: " . $mysqli->error);
}

//query to get data from the table
$query1 = sprintf("SELECT total_amount FROM ip17team2db.raw_data WHERE total_amount > 100 ORDER BY date_time ASC");
//Query for time
$query2 = sprintf("SELECT date_time FROM ip17team2db.raw_data WHERE total_amount > 100 ORDER BY date_time ASC");

//execute cost query
$result1 = mysqli_query($mysqli, $query1);
//Execute time query
$result2 = mysqli_query($mysqli, $query2);

$cost = Array();
$time = Array();

/* if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result1)) {
        foreach($row as $r){
			$cost[] = $r;
        }
	}
		
	while($row = mysqli_fetch_assoc($result2)) {
        foreach($row as $r){
			$time[] = $r;
        }
    }
}

 else {
    echo "0 results";
} */

$_SESSION['cost'] = $cost;
$_SESSION['time'] = $time;

?>