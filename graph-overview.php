<?php
$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

/**
 * Created by IntelliJ IDEA.
 * User: cmckillop
 * Date: 13/09/2017
 * Time: 10:45
 */

include 'getOverviewData.php';
$totalData = [];
$totalData = $_SESSION['data'];
$totalJS=[];

while($row = mysqli_fetch_assoc($totalData)) {
        foreach($row as $r){
            if($r){
                array_push($totalJS, $r);
            } 
        }
}

$totalJS = json_encode($totalJS);

?>

<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="assets/styles.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>

        <title>Overview | Graphs</title>

    </head>
    <body>

        <?php $currentPage = "graph"; include "header.php";?>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="graph-overview.php">Overview<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graph-consumers.php">Consumers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graph-outlets.php">Outlets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graph-transactions.php">Transactions</a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Export</a>
                        </li>
                    </ul>
                </nav>

                <main class="ml-sm-auto col-md-10 pt-3" role="main">
                    <h1 id="overview">Overview</h1>

                    <section class="row">
                        <div class="col-md-3 left">

                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Year</label>
                                    <select class="form-control" id="yearOption">
                                        <option value="3000">All years</option>
                                        <option value="2017">2017</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Timescale</label>
                                    <select class="form-control" id="scaleOption">
                                        <option value="1">Week</option>
                                        <option value="2">Four Weeks</option>
                                        <option value="3">Quarter</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect3">Outlet</label>
                                    <select  class="form-control" id="outletOption">
                                        <option value="238">Library</option>
                                        <option value="239">Spare</option>
                                        <option value="236">Air Bar</option>
                                        <option value="243">Ents</option>
                                        <option value="343">Remote Campus Shop</option>   
                                        <option value="241">Liar Bar</option>
                                        <option value="240">Food on Four</option>
                                        <option value="242">Mono</option>
                                        <option value="237">Floor Five</option>
                                        <option value="235">DOJ Catering</option>
                                        <option value="456">DUSA The Union - Marketplace</option>   
                                        <option value="2676">Premier Shop</option>
                                        <option value="2677">College Shop</option>
                                        <option value="2679">Air Bar</option>
                                        <option value="237">Ninewells Shop</option>
                                       

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label" style="float: left;">
                                        <input class="form-check-input" type="checkbox" value="" id="compareCheck"> 
                                       Compare To
                                    </label>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="compareOption">
                                        <option value="3000">All years</option>
                                        <option value="2017">2017</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                    </select>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-9 right">
                            <canvas id="line-chart"></canvas>
                        </div>
                    </section>
                </main>

            </div>
        </div>

        <script>
            
            
            var totData = <?php echo $totalJS; ?>;
            
            
            window.onload = function() {
                constructGraph(totData,"Mono");
              };
              
              
            $(function () {
                    $("#compareOption, #scaleOption, #yearOption, #outletOption").change(function () {
                    var yearOption = $("#yearOption").val();
                    var scaleOption = $("#scaleOption").val();
                    var outletOption = $("#outletOption").val();
                    var compareOption = $("#compareOption").val();
                    var compareCheck = document.getElementById('compareCheck').checked;
                    
                    console.log(compareCheck);
                    
                    if(!compareCheck){
                        $.post("getOverviewData.php",{yearOption: yearOption, scaleOption: scaleOption, outletOption:outletOption}).done(function(data){
                           constructGraph(JSON.parse(data),outletOption, scaleOption);
                        });    
                    } else {
                        
                        var tempData1 = [];
                        var tempData2 = [];
                        
                        $.post("getOverviewData.php",{yearOption: yearOption, scaleOption: scaleOption, outletOption:outletOption}).done(function(data1){
                           tempData1 =  JSON.parse(data1);
                                $.post("getOverviewData.php",{yearOption: compareOption, scaleOption: scaleOption, outletOption:outletOption}).done(function(data2){
                               tempData2 =  JSON.parse(data2);
                               constructGraph2(tempData1,tempData2,outletOption, scaleOption, yearOption, compareOption);
                                 });
                        });
                        
                        
                        
                        
                    }
            });
        });

        
  
        //Single Line Graph
        function constructGraph(newData, outletName, scaleOp){
           // alert(newData);
         var numData = []; 
         numData = parseData(newData,scaleOp);
         
         var labelNames = [];
         labelNames = parseNames(newData,scaleOp);
         
                 new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                    labels: labelNames,
                    datasets: [{
                        data: numData,
                        label: outletName,
                        borderColor: "#3e95cd",
                        fill: false
                    }]
                },
                options: {
                    title: {
                        display: false,
                        text: 'Overall Sales in #outletNameHere#'
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Total (£)'
                            }
                        }]
                    }
                }
            });
    }
    
    function parseData(data, scale){
          var numData =[];
            for (var i = 0; i < data.length; i++) {
                if(i % 2 === 0) { // index is even
                    numData.push(data[i]);
                }
            }

            numData.reverse();

            if(scale == "1"){       
            } else if(scale == "2"){ 
                
                var newNum = [];
                var count =0;
                for (var i = 0; i < Math.ceil((data.length/4)); i++) {
                    var tempNum = 0.00;
                    for (var j = count; j < count+4; j++) {
                        tempNum = parseFloat(data[j]) + parseFloat(data[j+1]) + parseFloat(data[j+2]) + parseFloat(data[j+3]);
                    }
                    count = count + 4;
                    
                    newNum[i] = tempNum;
          
                }
                
                numData = newNum;
                
                
            } else if(scale == "3"){
                
                var newNum = [];
                var count =0;
                for (var i = 0; i < Math.ceil((data.length/13)); i++) {
                    var tempNum = 0.00;
                    for (var j = count; j < count+13; j++) {
                         for (var z = 0; z < 13; z++) {
                            tempNum = tempNum + parseFloat(data[j+z]);
                        }
                    }
                    count = count + 13;        
                    newNum[i] = tempNum;
                }   
                numData = newNum;
            }  
             numData = numData.filter(function( element ){
                return element !== undefined;
             });
              
              console.log(numData);
              return numData;
              
    }
    
    function parseNames(data, scale){
    
      var labelNames = [];
            for (var i = 0; i < data.length; i++) {
                if(i % 2 === 1) { // index is odd
                    labelNames.push(data[i]);
                }
            }

            labelNames.reverse();
            
            if(scale == "1"){
              
                
            } else if(scale == "2"){ 
                
                
                var newlabelNames = [];
                for (var k = 0; k < data.length; k+=4) {
                        newlabelNames.push(labelNames[k]);
                    
                }
                
                labelNames.length = 0;
                labelNames = newlabelNames;
                
                
            } else if(scale == "3"){
                
     
                var newlabelNames = [];
                for (var k = 0; k < data.length; k+=13) {
                        newlabelNames.push(labelNames[k]);
                    
                }
                
                labelNames.length = 0;
                labelNames = newlabelNames;
                
            }
            
            

             labelNames = labelNames.filter(function( element ) {
                return element !== undefined;
             });
            
            
            return labelNames;
            
    }
    //double line graph
    function constructGraph2(newData, newData2, outletName, scaleOp, yearOption, compareOption){

        var numData1 = []; 
        numData1 = parseData(newData,scaleOp);

        var labelNames1 = [];
        labelNames1 = parseNames(newData,scaleOp);

        var numData2 = []; 
        numData2 = parseData(newData2,scaleOp);

        var labelNames2 = [];
        labelNames2 = parseNames(newData2,scaleOp);
        
        console.log(numData1.length);
        console.log(numData2.length);


         if(numData1.length !== 52){
          var zeros = [];
          zeros = Array.apply(null, Array(52 - numData1.length)).map(Number.prototype.valueOf,0);
          if(labelNames1[0] > labelNames1[0]){
              numData1 = zeros.concat(numData1);
          } else {
              numData1 = numData1.concat(zeros);
          }
        } 
        
        if(numData2.length !== 52){
            var zeros = [];
          zeros = Array.apply(null, Array(52 - numData2.length)).map(Number.prototype.valueOf,0);
            if(labelNames1[0] > labelNames2[0]){
              numData2 = zeros.concat(numData2);
          } else {
              numData2 = numData2.concat(zeros);
          }
        }
        
        /*
        if(numData2.length < numData1.length){
          var zeros = []
          zeros = Array.apply(null, Array(numData1.length - numData2.length)).map(Number.prototype.valueOf,0);
          if(labelNames1[0] > labelNames2[0]){
              numData2 = zeros.concat(numData2);
          } else {
              numData2 = numData2.concat(zeros);
          }
          console.log(zeros.length);
        } else if(numData2.length > numData1.length){
          var zeros = []
          zeros = Array.apply(null, Array(numData2.length - numData1.length)).map(Number.prototype.valueOf,0);
           if(labelNames1[0] > labelNames2[0]){
              numData1 = zeros.concat(numData1);
          } else {
              numData1 = numData1.concat(zeros);
          }
          console.log(zeros.length);
        } else if(labelNames1[0] != labelNames2[0]){
            
          var zeros = []
          zeros = Array.apply(null, Array(52 - numData2.length)).map(Number.prototype.valueOf,0);
          if(labelNames1[0] < labelNames2[0]){
              numData2 = zeros.concat(numData2);
              numData1 = numData1.concat(zeros);
          } else {
              numData1 = zeros.concat(numData1);
              numData2 = numData2.concat(zeros);
          }
        }*/
        
        
    
        
        console.log("Lengths");
        console.log(numData1.length);
        console.log(numData2.length);

                 new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                    labels: labelNames1,
                    datasets: [{
                        data: numData1,
                        label: yearOption,
                        borderColor: "#3e95cd",
                        fill: false
                    }, {
                        data: numData2,
                        label: compareOption,
                        borderColor: "#cc0000",
                        fill: false
                    }]
                },
                options: {
                    title: {
                        display: false,
                        text: 'Overall Sales in #outletNameHere#'
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Total (£)'
                            }
                        }]
                    }
                }
            });
    }
            // ORIGINAL CHART - REMOVED FOR TESTING
            
            /*
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
                datasets: [{
                    data: [86,114,106,106,107,111,133,221,783,2478],
                    label: "Mono",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    data: [282,350,411,502,635,809,947,1402,3700,5267],
                    label: "Liar",
                    borderColor: "#8e5ea2",
                    fill: false
                }, {
                    data: [168,170,178,190,203,276,408,547,675,734],
                    label: "Air Bar",
                    borderColor: "#3cba9f",
                    fill: false
                }, {
                    data: [40,20,10,16,24,38,74,167,508,784],
                    label: "Floor 5",
                    borderColor: "#e8c3b9",
                    fill: false
                }, {
                    data: [6,3,2,2,7,26,82,172,312,433],
                    label: "Entertainments",
                    borderColor: "#c45850",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                    display: false,
                    text: 'World population per region (in millions)'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Total (£)'
                        }
                    }]
                }
            }
        });
        */

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    </body>
</html>