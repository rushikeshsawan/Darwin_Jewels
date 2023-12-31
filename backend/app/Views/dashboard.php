<?= $this->extend('main') ?>
<?= $this->section('content') ?>

 <div class="row">
    <div class="col-md-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                            Total Product</p>
                        <h4 class="fs-22 fw-semibold mb-3"> <?php echo $productCount; ?></h4>
                        <div class="d-flex align-items-center gap-2">
                            <?php if ($productPercentage > 0) { ?>
                                <h5 class="text-success fs-12 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                    +<?php echo number_format($productPercentage, 2); ?>%
                                </h5>
                            <?php } else if ($productPercentage < 0) { ?>
                                <h5 class="text-danger fs-12 mb-0">
                                    <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                    <?php echo number_format($productPercentage, 2); ?>%
                                </h5>
                            <?php } else { ?>
                                <h5 class="text-muted fs-12 mb-0">
                                    No Change
                                </h5>
                            <?php } ?>
                            <p class="text-muted mb-0">than last week</p>
                        </div>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title <?php echo $productPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                            <i class="bx bx-dollar-circle <?php echo $productPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                            Total Category</p>
                        <h4 class="fs-22 fw-semibold mb-3"> <?php echo $categoryCount; ?></h4>
                        <div class="d-flex align-items-center gap-2">
                            <?php if ($categoryPercentage > 0) { ?>
                                <h5 class="text-success fs-12 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                    +<?php echo number_format($categoryPercentage, 2); ?>%
                                </h5>
                            <?php } else if ($categoryPercentage < 0) { ?>
                                <h5 class="text-danger fs-12 mb-0">
                                    <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                    <?php echo number_format($categoryPercentage, 2); ?>%
                                </h5>
                            <?php } else { ?>
                                <h5 class="text-muted fs-12 mb-0">
                                    No Change
                                </h5>
                            <?php } ?>
                            <p class="text-muted mb-0">than last week</p>
                        </div>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title <?php echo $categoryPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                            <i class="bx bx-dollar-circle <?php echo $categoryPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                            Total Admin</p>
                        <h4 class="fs-22 fw-semibold mb-3"> <?php echo $totalAdminsCount; ?></h4>
                        <div class="d-flex align-items-center gap-2">
                            <?php if ($AdminsPercentage > 0) { ?>
                                <h5 class="text-success fs-12 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                    +<?php echo number_format($AdminsPercentage, 2); ?>%
                                </h5>
                            <?php } else if ($AdminsPercentage < 0) { ?>
                                <h5 class="text-danger fs-12 mb-0">
                                    <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                    <?php echo number_format($AdminsPercentage, 2); ?>%
                                </h5>
                            <?php } else { ?>
                                <h5 class="text-muted fs-12 mb-0">
                                    No Change
                                </h5>
                            <?php } ?>
                            <p class="text-muted mb-0">than last week</p>
                        </div>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title <?php echo $AdminsPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                            <i class="bx bx-dollar-circle <?php echo $AdminsPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                            Total Orders</p>
                        <h4 class="fs-22 fw-semibold mb-3"> <?php echo $orderCount; ?></h4>
                        <div class="d-flex align-items-center gap-2">
                            <?php if ($productPercentage > 0) { ?>
                                <h5 class="text-success fs-12 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                    +<?php echo number_format($productPercentage, 2); ?>%
                                </h5>
                            <?php } else if ($productPercentage < 0) { ?>
                                <h5 class="text-danger fs-12 mb-0">
                                    <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                    <?php echo number_format($productPercentage, 2); ?>%
                                </h5>
                            <?php } else { ?>
                                <h5 class="text-muted fs-12 mb-0">
                                    No Change
                                </h5>
                            <?php } ?>
                            <p class="text-muted mb-0">than last week</p>
                        </div>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title <?php echo $productPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                            <i class="bx bx-dollar-circle <?php echo $productPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                            Delivered Orders</p>
                        <h4 class="fs-22 fw-semibold mb-3"> <?php echo $countUniqueDeliveredOrders; ?></h4>
                        <div class="d-flex align-items-center gap-2">
                            <?php if ($categoryPercentage > 0) { ?>
                                <h5 class="text-success fs-12 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                    +<?php echo number_format($categoryPercentage, 2); ?>%
                                </h5>
                            <?php } else if ($categoryPercentage < 0) { ?>
                                <h5 class="text-danger fs-12 mb-0">
                                    <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                    <?php echo number_format($categoryPercentage, 2); ?>%
                                </h5>
                            <?php } else { ?>
                                <h5 class="text-muted fs-12 mb-0">
                                    No Change
                                </h5>
                            <?php } ?>
                            <p class="text-muted mb-0">than last week</p>
                        </div>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title <?php echo $categoryPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                            <i class="bx bx-dollar-circle <?php echo $categoryPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                            Accepted Orders</p>
                        <h4 class="fs-22 fw-semibold mb-3"> <?php echo $countUniqueAcceptedOrders; ?></h4>
                        <div class="d-flex align-items-center gap-2">
                            <?php if ($AdminsPercentage > 0) { ?>
                                <h5 class="text-success fs-12 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                    +<?php echo number_format($AdminsPercentage, 2); ?>%
                                </h5>
                            <?php } else if ($AdminsPercentage < 0) { ?>
                                <h5 class="text-danger fs-12 mb-0">
                                    <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                    <?php echo number_format($AdminsPercentage, 2); ?>%
                                </h5>
                            <?php } else { ?>
                                <h5 class="text-muted fs-12 mb-0">
                                    No Change
                                </h5>
                            <?php } ?>
                            <p class="text-muted mb-0">than last week</p>
                        </div>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title <?php echo $AdminsPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                            <i class="bx bx-dollar-circle <?php echo $AdminsPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="chart_div" style="width: 100%; height: 400px;"></div>
<div id="GoogleColumnChart" style="height: 500px; width: 100%"></div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart); 
    function drawChart() {
        var chartData = <?php echo json_encode($orders); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day and Month');
        data.addColumn('number', 'Unique Order Count');
        for (var i = 0; i < chartData.length; i++) {
            var dayMonth = chartData[i].day + '/' + chartData[i].month;
            var count = chartData[i].count;
            data.addRow([dayMonth, count]);
            if (i > 0 && count > chartData[i - 1].count) {
                 data.setRowProperty(i, 'style', 'color: green');
            } else if (i > 0 && count < chartData[i - 1].count) {
                data.setRowProperty(i, 'style', 'color: red');
            }
        }
        var options = {
            title: 'Unique Order Count by Day and Month',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    } 
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script>
			google.charts.load('visualization', "1", {
				packages: ['corechart']
			});
			function showChart() {
				var data = google.visualization.arrayToDataTable([
					['Day', 'Total Order'], 
					<?php foreach($orders as $row) {
						echo "['".$row['day']."',".$row['count']."],";
					} ?>
				]);
				var options = {
					title: 'Last month sales',
					isStacked: true
				};
				var chart = new google.visualization.ColumnChart(document.getElementById('GoogleColumnChart'));
				chart.draw(data, options);
			}
			google.charts.setOnLoadCallback(showChart);
		</script>
<?= $this->endSection() ?>