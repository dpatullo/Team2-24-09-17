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
$query = sprintf("SELECT total_transacted,outlet,outlet_id FROM ip17team2db.totals WHERE end_date = (Select Max(end_date) from ip17team2db.totals) ORDER BY total_transacted DESC");

//execute query
$result = mysqli_query($mysqli, $query);

//loop through the returned data


/*
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        foreach($row as $r){
            if($r){
            echo $r;
            echo "<br>" ;
            }
        }
    }
} else {
    echo "0 results";
}
*/


$_SESSION['data'] = $result;
?>