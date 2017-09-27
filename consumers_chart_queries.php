<?php
include('connectToDatabase.php');
$connection =$conn;
$au = array();

function getData($value, $conn):array
{
    $year=null ;
    $query=null;
    $year = $value;
    $query = mysqli_query($conn, "select count(distinct new_user) as au from ip17team2db.raw_data where YEAR(date_time)='$year' GROUP BY MONTH(date_time)");
    $au=null;

    while ($row = mysqli_fetch_assoc($query)) {
        $au[] = $row['au'];
    }
    //mysqli_close($conn);
    return $au;
}

function processDropdown($selectedVal)
{
    echo "Selected value in php " . $selectedVal;
}

if (isset($_POST['dropdownValue'])) {
    //call the function or execute the code
    processDrpdown($_POST['dropdownValue']);
}
?>