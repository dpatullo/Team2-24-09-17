<?php
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<canvas id="multipleLineChart"></canvas>
<script>
    var ctx = document.getElementById('multipleLineChart').getContext('2d');
    
   var data1 = [];
    for( i =0;i<7;i++){
        data1.push(Math.random()*26000);
    }
    
  var myMultiChart = new Chart(ctx, {
    data: data,
    type: 'polarArea',
    options: options
});
</script>

