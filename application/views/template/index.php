<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
    <?php foreach ($data as $k => $v) : ?>
        <div class="col">
            <div class="card bg-<?= $colors[$k]; ?> text-white mb-4">
                <div class="card-body text-center"><?= $v['name']; ?></div>
                <div class="card-footer">
                    <div class="row row-cols-5">
                        <?php foreach ($v['sensors'] as $value) : ?>
                            <div class="col">
                                <?= $value; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-chart-area me-1"></i>
        Area Chart Example
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <canvas id="myAreaChart" style="height:400px" class="table"></canvas>
        </div>

        <!-- <canvas id="myAreaChart" width="100%" height="30"></canvas> -->
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var canvas = document.getElementById("myAreaChart");
    var ctx = canvas.getContext('2d');

    // Global Options:
    // Chart.defaults.global.defaultFontColor = 'black';
    // Chart.defaults.global.defaultFontSize = 16;

    // Notice the scaleLabel at the same level as Ticks
    var options = {
        responsive: true,
        // responsive: false,
        // maintainAspectRatio: false,
        scales: {
            // yAxes: [{
            //     ticks: {
            //         // beginAtZero: true,
            //         min: -10,
            //         max: 100,
            //     },
            //     scaleLabel: {
            //         display: true,
            //         labelString: 'Moola',
            //         fontSize: 20
            //     }
            // }],
            // xAxes: [{
            //     gridLines: {
            //         zeroLineWidth: 3,
            //         zeroLineColor: "#2C292E",
            //     },

            // }]
        }
    };

    // Chart declaration:
    var myBarChart = new Chart(ctx, {
        type: 'line',
        options: options
    });

    $.ajax({
        url: '<?= base_url('dashboard/push'); ?>',
        dataType: "json",
        success: (data) => {
            myBarChart.data = data;
            myBarChart.update();
        }
    });


    function updateChart() {
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        myBarChart.data.labels.push(time);
        myBarChart.data.labels.shift();
        myBarChart.data.datasets.forEach((dataset) => {
            dataset.data.push(Math.floor(Math.random() * 100));
            dataset.data.shift();
        });

        myBarChart.update();
    }

    setInterval(updateChart, 1500);
</script>