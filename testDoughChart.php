<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<div style="position:absolute; top:90px; left:450px; width:500px; height:500px">
<canvas id="stackLineChart" width="200" height="200"></canvas>

<?php
include 'getTotalsData.php';
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
<script>
    var totData = <?php echo $totalJS; ?>;
    
    var numData =[];
    for (var i = 0; i < totData.length; i++) {
        if(i % 3 === 0) { // index is even
            numData.push(totData[i]);

        }
    }
    
    var labelNames = [];
    for (var i = 0; i < totData.length; i++) {
        if(i % 3 === 1) { // index is odd
            labelNames.push(totData[i]);
        }
    }
    
    var outletRefs = [];
    for (var i = 0; i < totData.length; i++) {
        if(i % 3 === 2) { // index is odd
            outletRefs.push(totData[i]);
        }
    }
    
    var ctx = document.getElementById('stackLineChart').getContext('2d');
  
    var mixedChart = new Chart(ctx, {
    type: 'doughnut',
    data:{
    datasets: [{
        data: numData,
         backgroundColor: ['rgb(186, 0, 186)','rgb(174,46,174)','rgb(153, 0, 153)','rgb(190, 92, 190)','rgb(126,0,126)','rgb(186, 0, 186)','rgb(174,46,174)','rgb(153, 0, 153)','rgb(190, 92, 190)','rgb(126,0,126)' ]
    },  {
        data: [350],
        backgroundColor: 'rgb(8, 25, 42)',
        type: 'pie',
        options: {segmentShowStroke: false,
        borderWidth:0}
       
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: labelNames
       
}, 
    options: {cutoutPercentage:0,
    borderWidth:0,
    legend:{display:false},
    segmentShowStroke: false

}
    
    
    
});
 
   
    
 Chart.pluginService.register({
    afterDraw: function(chart) {
      var width = chart.chart.width,
          height = chart.chart.height,
          ctx = chart.chart.ctx;

      ctx.restore();
      var fontSize = (height / 150).toFixed(2);
      ctx.font = fontSize + "em sans-serif";
      ctx.textBaseline = "middle";
      
    var sum = numData.reduce(add, 0);

    function add(a, b) {
        return parseInt(a) + parseInt(b);
    }
      var text = "£"+sum,
          textX = Math.round((width - ctx.measureText(text).width) / 2),
          textY = height / 2;
  
   
      
      ctx.fillStyle = 'white';
      ctx.fillText(text, textX, textY);
      ctx.save();
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

