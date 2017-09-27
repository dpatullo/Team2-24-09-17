<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<canvas id="stackLineChart"></canvas>
<br>
<p id="test"></p>
<canvas id="multipleLineChart"></canvas>


<script>
    var ctx = document.getElementById('stackLineChart').getContext('2d');
   
    var data1 = [];
    for( i =0;i<24;i++){
        data1.push(Math.random()*40);
    }
    
    var data2 = [];
    for( i =0;i<24;i++){
        data2.push(Math.random()*40);
    }
    
    var data3 = [];
    for( i =0;i<24;i++){
        data3.push(Math.random()*40);
    }
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["00:00", "01:00", "02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
        datasets: [{
            label: "Coffee Drinkers",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
         
            data: data1
,
        },{
            lbael: "Medical Students",
            backgroundColor: 'rgb(255, 150, 255)',
            borderColor: 'rgb(255, 99, 132)',
            data: data2
,
        }, {label: "Library Studiers",
            backgroundColor: 'rgb(124, 02, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: data3
}]
    },
    options: {
        scales:{
            yAxes: [{
                    stacked:true
            }]
        }
    }
});
</script>


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
