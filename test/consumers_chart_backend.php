<?php
$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

include('connectToDatabase.php');

$au = array();
$year = $_POST['year'];
$timescale = $_POST['timescale'];
$outlet = $_POST['outlet'];

$query = mysqli_query($conn, "select count(distinct new_user) as au from ip17team2db.raw_data where YEAR(date_time)='$year' GROUP BY MONTH(date_time)");

while ($row = mysqli_fetch_assoc($query)) {
    $au[] = $row['au'];
}
echo json_encode($au);
?>