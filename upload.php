<?php
    $q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

    session_start();
    
    
    echo $_FILES["fileToUpload"]["tmp_name"];
    /*
    $arrCSV = array();
    if (($handle = fopen($_FILES["fileToUpload"]["tmp_name"], "r")) !==FALSE) {
    $key = 0;
    while (($data = fgetcsv($handle, 0, ";")) !==FALSE) {
       $c = count($data);
       for ($x=0;$x<$c;$x++) {
       $arrCSV[$key][$x] = $data[$x];
       }
       $key++;
    } 
    fclose($handle);
    } 
    echo "<pre>";
    echo print_r($arrCSV);
    echo "</pre>";

    //make sure you have created the **upload** directory

    $filename    = $_FILES["fileToUpload"]["tmp_name"];
    $destination = $q . $_FILES["fileToUpload"]["name"]; 
    if(move_uploaded_file($filename, $destination)){
        echo "Success";
    } else {
        echo "Failure";
    }
     * 
     * 
     */
     //save uploaded picture in your directory


