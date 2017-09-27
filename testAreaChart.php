<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<div style="position:absolute; top:90px; left:450px; width:500px; height:500px">
<canvas id="stackLineChart"></canvas>



<script>
    var ctx = document.getElementById('stackLineChart').getContext('2d');
   
    var data1 = [12,14,10,7,15,13,7,4,3,2,10,15];  
    var data2 = [7,7,10,12,15,2,0,0,0,8,12,14,17];
    var data3 = [3,4,2,7,12,5,7,6,7,2,3,7,4,11,13];

    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["January","Febuary","March","April","May","June","July","August","September","October","November","December"],
        datasets: [{
            label: "Used to buy coffee",
           // backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 0, 255)',
         
            data: data1
,
        },{
            label: "Used in library",
          //  backgroundColor: 'rgb(255, 150, 255)',
            borderColor: 'rgb(120, 99, 200)',
            data: data2
,
        }, {label: "Use for late night drinks",
           // backgroundColor: 'rgb(124, 02, 132)',
            borderColor: 'rgb(20, 180, 132)',
            data: data3
}]
    },
    options: {
        elements:{
            line:{
                tension:0,
            }
        }
    }
});
</script>
</div>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

