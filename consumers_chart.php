<?php
include('consumers_chart_queries.php');
if (!isset($_SESSION['year'])) {
    $_SESSION['year']='2017';
    $au = getData($_SESSION['year'], $conn);
}
?>
<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<section class="row">
    <div class="col-md-3 left">

        <form method="POST" action="">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Year</label>
                <select class="form-control" id="exampleFormControlSelect1" name="year">
                    <option>2017</option>
                    <option>2016</option>
                    <option>2015</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Timescale</label>
                <select class="form-control" id="exampleFormControlSelect2">
                    <option>Week</option>
                    <option>Month</option>
                    <option>Quarter</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect3">Outlet</label>
                <select multiple class="form-control" id="exampleFormControlSelect3">
                    <option>Mono</option>
                    <option>Liar</option>
                    <option>Air Bar</option>
                    <option>Floor 5</option>
                    <option>Entertainments</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-check-label" style="float: left;">
                    <input class="form-check-input" type="checkbox" value="">
                    Compare To
                </label>
            </div>
        </form>

    </div>
    <div class="col-md-8 left">
    </div>
    <canvas id="myChart" width="400" height="400"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
       //$(window).load(function() {
            var jArray = <?php echo json_encode($au); ?>;
            var ctx = document.getElementById("myChart").getContext('2d');
            var config = {
                type: 'bar',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: '# of Votes',
                        data: jArray,
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
        //});

        $(document).ready(function () {
            $('#exampleFormControlSelect1').change(function () {
                //Selected value
                var inputValue = $(this).val();
                if (inputValue == 2017) {
                    alert('2017');
                    <?php
                        $au = getData('2017', $conn);
                        ?>;
                }
                else if (inputValue == 2016) {
                    alert('2016');
                    <?php
                        $au=null ;
                        $value='2016';
                        $au = getData($value, $conn);
                        ?>;
                }
                else if (inputValue == 2015) {
                    alert('2015');
                    <?php
                        $au = getData('2015', $conn);
                        ?>;
                }
                jArray.length=0;
                jArray = <?php echo json_encode($au); ?>;

                alert(jArray);

                //config.data=jArray;
                var config = {
                    type: 'bar',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [{
                            label: '# of Votes',
                            data: jArray,
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
                myChart.destroy();
                myChart = new Chart(ctx, config);

                //Ajax for calling php function

            });
        });
    </script>
</body>
</html>