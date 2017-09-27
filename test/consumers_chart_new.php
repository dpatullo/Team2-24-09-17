<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<form method="POST" action="" id="filterConsumers">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Year</label>
        <select class="form-control" id="exampleFormControlSelect1" name="year">
            <option value="2017">2017</option>
            <option value="2016">2016</option>
            <option value="2015">2015</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Timescale</label>
        <select class="form-control" name="timescale" id="exampleFormControlSelect2">
            <option value="week">Week</option>
            <option value="month">Month</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect3">Outlet</label>
        <select class="form-control" name="outlet" id="exampleFormControlSelect3">
            <option value="Mono">Mono</option>
            <option value="Liar">Liar</option>
            <option value="Air Bar">Air Bar</option>
            <option value="Floor 5">Floor 5</option>
            <option value="Entertainment">Entertainments</option>
        </select>
    </div>
    <div class="form-group">
        <label class="form-check-label" style="float: left;">
            <input class="form-check-input" type="checkbox" value="">
            Compare To
        </label>
    </div>
    <button type="submit" class="btn btn-primary" name="submit" onclick="create()">View chart</button>
</form>
<canvas id="myChart" width="400" height="400"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>
    function create () {
        $.ajax({
            url:"consumers_chart_backend.php", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: $("#filterConsumers").serialize(),
            success: function(result){
                console.log(result);
                drawChart(result);
            }
        });
    }

    function drawChart(result){
        console.log(result);
        var jArray = result;
        var ctx = document.getElementById("myChart").getContext('2d');
        var config = {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                    label: '# of Votes',
                    data: [jArray],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        };
        var myChart = new Chart(ctx, config);
    };
</script>
</body>
</html>