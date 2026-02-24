
<?php $__env->startPush('css'); ?>
<style>
    .ai_year_estimation_sec {
        padding: 10px;
    }


    .ai_year_estimation_sec .analysis_tab .nav-item {
        width: 50%;
    }

    .ai_year_estimation_sec .card {
        margin-top: 20px;
        border: none;
        border-radius: 8px;
        box-shadow: 2px 0px 21px 0px rgba(0, 0, 0, 0.07);
        padding: 20px;
        background: white;
    }

    .ai_year_estimation_sec .analysis_tab {
        border-radius: 8px 8px 0px 0px;
        background: #FFF;
        box-shadow: 2px 0px 21px 0px rgba(0, 0, 0, 0.07);
        border: none;
        padding: 0;
    }

    .ai_year_estimation_sec .analysis_tab .nav-link {
        width: 100%;
        padding: 20px;
        text-align: left;
        border: none;
        border-bottom: 2px solid #BDBDBD;
        color: #BDBDBD;
        font-weight: 600;
        font-size: 23px;
        background: none;
        border-radius: 0;
    }

    .ai_year_estimation_sec .tab-content {
        margin: 0;
    }

    .ai_year_estimation_sec .analysis_tab .nav-link.active {
        color: #74C911;
        border-color: #74C911;
        font-weight: bold;
        background: white;
    }

    .ai_year_estimation_sec .box-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .ai_year_estimation_sec .clr-green {
        color: #74C911;
        font-weight: bold;
    }

    .ai_year_estimation_sec .revenue-amount {
        font-size: 28px;
        font-weight: bold;
        color: #74C911;
    }

    .ai_year_estimation_sec .chart-container {
        position: relative;
        height: 300px;
        margin: 20px 0;
    }

    .ai_year_estimation_sec .small-chart-container {
        position: relative;
        height: 200px;
        margin: 15px 0;
    }

    .ai_year_estimation_sec .stats-chart-container {
        position: relative;
        height: 250px;
        margin: 20px 0;
    }

    .ai_year_estimation_sec .referral-chart-container {
        position: relative;
        height: 180px;
        margin: 15px 0;
    }

    .ai_year_estimation_sec .goal-input-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-top: 15px;
    }

    .ai_year_estimation_sec .goal-input {
        display: flex;
        gap: 15px;
        align-items: end;
    }

    .ai_year_estimation_sec .form-group {
        flex: 1;
    }

    .ai_year_estimation_sec .form-group label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    .ai_year_estimation_sec .form-control {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
    }

    .ai_year_estimation_sec .btn-generate {
        background: #74C911;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 600;
        white-space: nowrap;
    }

    .ai_year_estimation_sec .btn-generate:hover {
        background: #5ea00d;
        color: white;
    }

    /* Peak Season Styling */
    .ai_year_estimation_sec .peak-season-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .ai_year_estimation_sec .peak-season-item:last-child {
        border-bottom: none;
    }

    .ai_year_estimation_sec .season-info {
        flex: 1;
    }

    .ai_year_estimation_sec .season-name {
        font-weight: 600;
        color: #333;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .ai_year_estimation_sec .season-type {
        font-size: 12px;
        color: #666;
    }

    .ai_year_estimation_sec .season-indicator {
        width: 8px;
        height: 40px;
        border-radius: 4px;
        margin-left: 15px;
    }

    .ai_year_estimation_sec .season-high {
        background: #74C911;
    }

    .ai_year_estimation_sec .season-medium {
        background: #ffc107;
    }

    .ai_year_estimation_sec .season-low {
        background: #dc3545;
    }

    .ai_year_estimation_sec .job-completion {
        font-size: 12px;
        color: #666;
        margin-right: 10px;
    }

    /* Referral Sources Styling */
    .ai_year_estimation_sec .referral-source-item {
        display: flex;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .ai_year_estimation_sec .referral-source-item:last-child {
        border-bottom: none;
    }

    .ai_year_estimation_sec .referral-icon {
        width: 24px;
        height: 24px;
        border-radius: 3px;
        margin-right: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }

    .ai_year_estimation_sec .google-icon {
        background: #4285f4;
    }

    .ai_year_estimation_sec .referral-icon-ref {
        background: #34a853;
    }

    .ai_year_estimation_sec.website-icon {
        background: #ea4335;
    }

    .ai_year_estimation_sec .truck-icon {
        background: #fbbc05;
        color: #333;
    }

    .ai_year_estimation_sec .siding-icon {
        background: #9aa0a6;
    }

    .ai_year_estimation_sec .referral-info {
        flex: 1;
    }

    .ai_year_estimation_sec .referral-name {
        font-weight: 600;
        font-size: 14px;
        color: #333;
    }

    .ai_year_estimation_sec .referral-leads {
        font-size: 12px;
        color: #666;
        margin-left: auto;
    }

    .ai_year_estimation_sec .referral-bar {
        width: 100%;
        height: 4px;
        background: #f0f0f0;
        border-radius: 2px;
        margin-top: 4px;
    }

    .ai_year_estimation_sec .referral-progress {
        height: 100%;
        background: #74C911;
        border-radius: 2px;
    }

    /* City Performance Styling */
    .ai_year_estimation_sec .city-performance-section {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .ai_year_estimation_sec .city-category {
        flex: 1;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .ai_year_estimation_sec .city-category h6 {
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .ai_year_estimation_sec .city-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    .ai_year_estimation_sec .city-item:last-child {
        border-bottom: none;
    }

    .ai_year_estimation_sec .city-rank {
        width: 20px;
        color: #666;
    }

    .ai_year_estimation_sec .city-name {
        flex: 1;
        margin-left: 10px;
    }

    .ai_year_estimation_sec .city-stats {
        display: flex;
        gap: 15px;
        font-size: 12px;
        color: #666;
    }

    .ai_year_estimation_sec .recommended .city-name {
        color: #28a745;
    }

    .ai_year_estimation_sec .moderate .city-name {
        color: #ffc107;
    }

    .ai_year_estimation_sec .not-recommended .city-name {
        color: #dc3545;
    }

    /* Tab content background */
    .ai_year_estimation_sec .tab-content {
        background: white;
        border-radius: 0 0 8px 8px;
        box-shadow: 2px 0px 21px 0px rgba(0, 0, 0, 0.07);
        padding: 0;
    }

    .ai_year_estimation_sec .tab-pane {
        padding: 20px;
    }

    /* Chart frame styling */
    .ai_year_estimation_sec .chart-frame {
        border: 2px solid #74C911;
        border-radius: 8px;
        padding: 15px;
        background: #f8fff8;
        position: relative;
    }



    /* Revenue tabs */
    .ai_year_estimation_sec .revenue-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .ai_year_estimation_sec .revenue-tab {
        padding: 8px 16px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 20px;
        font-size: 12px;
        cursor: pointer;
    }

    .ai_year_estimation_sec .revenue-tab.active {
        background: #74C911;
        color: white;
        border-color: #74C911;
    }

    /* Vector label */
    .ai_year_estimation_sec .vector-label {
        position: absolute;
        top: 10px;
        left: 15px;
        background: #007bff;
        color: white;
        padding: 2px 8px;
        font-size: 12px;
        border-radius: 3px;
    }

    .ai_year_estimation_sec .goal-input .form-group {
        margin: 0;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section class="ai_year_estimation_sec">
    <div class="container-fluid">
        <ul class="nav nav-tabs analysis_tab" id="analysisTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="sales-analysis-tab" data-bs-toggle="tab" data-bs-target="#sales-analysis" type="button" role="tab">
                    Sales Analysis
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="goal-analysis-tab" data-bs-toggle="tab" data-bs-target="#goal-analysis" type="button" role="tab">
                    Goal Analysis
                </button>
            </li>
        </ul>

        
        <div class="tab-content" id="analysisTabContent">
            <!-- Sales Analysis Tab -->
            <div class="tab-pane fade show active" id="sales-analysis" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- <h3 class="box-title">2025</h3> -->
                            <h6 style="color: #666;">Prediction of the next 12 months revenue based on historical trends.</h6>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <h6 style="color: #666; margin-bottom: 10px;">Revenue Generated</h6>
                            <h2 class="clr-green" id="revenue-generated"></h2>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <h6 style="color: #666; margin-bottom: 10px;">Forecasted Revenue <span style="color: #999;">(Upcoming 12 Months)</span></h6>
                            <h2 class="clr-green" id="projected-revenue"></h2>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <h3 class="box-title">Revenue</h3>
                            <div class="revenue-tabs">
                                <div class="revenue-tab">Monthly</div>
                                <div class="revenue-tab active">Yearly</div>
                                <div class="revenue-tab">Seasonal</div>
                            </div>
                            <div class="chart-container chart-frame">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="box-title">Peak Season For Construction</h3>
                            <div class="peak-seasons">
                                <i class="fa fa-spinner fa-spin"></i>
                                <!-- Placeholder for dynamic Peak Seasons -->
                            </div>

                            <div class="divider"></div> <!-- Divider between Peak and Low Seasons -->

                            <h3 class="box-title">Low Season For Construction</h3>
                            <div class="low-seasons">
                                <i class="fa fa-spinner fa-spin"></i>
                                <!-- Placeholder for dynamic Low Seasons -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <h3 class="box-title">Forecasted Statistics</h3>
                            <p style="color: #666; margin-bottom: 0;">Number of jobs completed per category</p>
                            <div class="stats-chart-container">
                                <canvas id="statsChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <h3 class="box-title">Average Job Cost</h3>
                            <div class="small-chart-container" style="position: relative;">
                                <canvas id="jobCostChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <h3 class="box-title">Average Job Margin</h3>
                            <div class="small-chart-container">
                                <canvas id="jobMarginChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <h3 class="box-title">Referral Sources</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 style="margin-bottom: 15px;">Top Referral Sources</h6>
                                    <div class="referral-sources-list" id="referral-sources-list">
                                        <i class="fa fa-spinner fa-spin"></i>
                                        <!-- <div class="referral-source-item">
                                            <div class="referral-icon google-icon">G</div>
                                            <div class="referral-info">
                                                <div class="referral-name">Google</div>
                                                <div class="referral-bar">
                                                    <div class="referral-progress" style="width: 90%;"></div>
                                                </div>
                                            </div>
                                            <div class="referral-leads">Total Leads: 584</div>
                                        </div>
                                        <div class="referral-source-item">
                                            <div class="referral-icon referral-icon-ref">R</div>
                                            <div class="referral-info">
                                                <div class="referral-name">Referral</div>
                                                <div class="referral-bar">
                                                    <div class="referral-progress" style="width: 75%;"></div>
                                                </div>
                                            </div>
                                            <div class="referral-leads">Total Leads: 136</div>
                                        </div>
                                        <div class="referral-source-item">
                                            <div class="referral-icon website-icon">W</div>
                                            <div class="referral-info">
                                                <div class="referral-name">Roofing Website</div>
                                                <div class="referral-bar">
                                                    <div class="referral-progress" style="width: 45%;"></div>
                                                </div>
                                            </div>
                                            <div class="referral-leads">Total Leads: 76</div>
                                        </div>
                                        <div class="referral-source-item">
                                            <div class="referral-icon truck-icon">T</div>
                                            <div class="referral-info">
                                                <div class="referral-name">Truck & Yard Signs</div>
                                                <div class="referral-bar">
                                                    <div class="referral-progress" style="width: 65%;"></div>
                                                </div>
                                            </div>
                                            <div class="referral-leads">Total Leads: 34</div>
                                        </div>
                                        <div class="referral-source-item">
                                            <div class="referral-icon siding-icon">S</div>
                                            <div class="referral-info">
                                                <div class="referral-name">Siding Website</div>
                                                <div class="referral-bar">
                                                    <div class="referral-progress" style="width: 25%;"></div>
                                                </div>
                                            </div>
                                            <div class="referral-leads">Total Leads: 07</div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="margin-bottom: 15px;">Referral Sources Growth</h6>
                                    <div style="margin-bottom: 10px;">
                                        <select class="form-control" id="periodSelector" style="font-size: 12px; padding: 5px;">
                                            <!-- Options will be populated dynamically here -->
                                        </select>
                                    </div>
                                    <div class="referral-chart-container">
                                        <canvas id="referralGrowthChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <h3 class="box-title">City Performance Analysis</h3>
                            <div class="city-performance-section">
                                <div class="city-category recommended">
                                    <h6>Recommended</h6>
                                </div>

                                <div class="city-category moderate">
                                    <h6>Moderate Performance</h6>
                                </div>

                                <div class="city-category not-recommended">
                                    <h6>Not Recommended for Investment</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goal Analysis Tab -->
            <div class="tab-pane fade" id="goal-analysis" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h3 class="box-title">Goal Analysis</h3>
                            <h6 style="color: #666;">Generate goal analysis by entering a goal for the next 12 months.</h6>
                            <form id="goal-analysis-form">
                                <?php echo csrf_field(); ?>
                                <div class="goal-input-section">
                                    <div class="goal-input">
                                        <div class="form-group">
                                            <label for="enteryourGoal">Goal Value *</label>
                                            <input type="number" min="1" class="form-control" id="enteryourGoal" placeholder="Enter your goal" value="">
                                        </div>
                                        <button type="submit" class="btn btn-generate">Generate Results</button>
                                    </div>
                                </div>
                            </form>
                            <div id="goal-analysis-result"></div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
    $.ajax({
        url: '<?php echo e(url("get_sales_report")); ?>',
        method: 'GET',
        success: function(response) {

            $('#referral-sources-list').empty();
            $.each(response.response_data.analysis.referral_analysis.top_sources, function(index, item) {
                        var progressWidth = 0;
                        if (index === 0) progressWidth = 90;  // For the first item, just a placeholder percentage
                        else if (index === 1) progressWidth = 75;  // Second item
                        else if (index === 2) progressWidth = 45;  // Third item
                        else if (index === 3) progressWidth = 65;  // Fourth item
                        else if (index === 4) progressWidth = 25;  // Fifth item

                        // Create the referral source HTML
                        var referralHTML = `
                            <div class="referral-source-item">
                                <div class="referral-icon">${item.source[0]}</div>
                                <div class="referral-info">
                                    <div class="referral-name">${item.source}</div>
                                    <div class="referral-bar">
                                        <div class="referral-progress" style="width: ${progressWidth}%;"></div>
                                    </div>
                                </div>
                                <div class="referral-leads">Total Leads: ${item.total_leads}</div>
                            </div>
                        `;

                        // Append the new HTML to the list
                        $('#referral-sources-list').append(referralHTML);
                    });





            // Loop through the 'high_performing' cities and add them to the 'recommended' section
            response.response_data.analysis.city_performance.high_performing.cities.forEach(function(city) {
                var recommendedCityHTML = `
                <div class="city-item">
                    <span class="city-rank">${city.rank}</span>
                    <span class="city-name">${city.city}</span>
                    <div class="city-stats">
                        <span>${city.jobs}</span>
                        <span>${city.percentage_of_total.toFixed(1)}%</span>
                    </div>
                </div>
            `;
                $('.city-category.recommended').append(recommendedCityHTML);
            });

            // Loop through the 'mid_range' cities and add them to the 'moderate' section
            response.response_data.analysis.city_performance.mid_range.cities.forEach(function(city) {
                var moderateCityHTML = `
                <div class="city-item">
                    <span class="city-rank">${city.rank}</span>
                    <span class="city-name">${city.city}</span>
                    <div class="city-stats">
                        <span>${city.jobs}</span>
                        <span>${city.percentage_of_total.toFixed(1)}%</span>
                    </div>
                </div>
            `;
                $('.city-category.moderate').append(moderateCityHTML);
            });

            // Loop through the 'low_performing' cities and add them to the 'not-recommended' section
            response.response_data.analysis.city_performance.low_performing.cities.forEach(function(city) {
                var notRecommendedCityHTML = `
                <div class="city-item">
                    <span class="city-rank">${city.rank}</span>
                    <span class="city-name">${city.city}</span>
                    <div class="city-stats">
                        <span>${city.jobs}</span>
                        <span>${city.percentage_of_total.toFixed(1)}%</span>
                    </div>
                </div>
            `;
                $('.city-category.not-recommended').append(notRecommendedCityHTML);
            });




                    var totalProjectedRevenue = 0;
                    $.each(response.response_data.predictions, function(index, item) {
                        if (item.Month === "Total") {
                            totalProjectedRevenue = item["Projected Revenue"];
                        }
                    });
                $('#projected-revenue').text('$'+ totalProjectedRevenue.toFixed(2));
                $('#revenue-generated').text('$'+ response.historical_total.toFixed(2));


            const growthData = response.response_data.analysis.referral_analysis.growth_data;
            const periodSelector = $('#periodSelector');
            const periods = []; // Initialize empty array to hold periods

            // Extract periods dynamically from the growth data
            Object.values(growthData).forEach(referralSourceData => {
                referralSourceData.forEach(item => {
                    if (!periods.includes(item.period)) {
                        periods.push(item.period); // Add unique periods to the array
                    }
                });
            });

            // Populate the dropdown with periods
            periods.forEach(period => {
                const option = $('<option>', {
                    text: period,
                    value: period  // Set the period as the value
                });
                periodSelector.append(option);
            });

            // Initialize chart variable
            let referralGrowthChart = null;

            // Function to render the chart based on selected period
            function renderChart(selectedPeriod) {
                const labels = Object.keys(growthData);  // Referral sources (e.g., 'Roofing Website', 'Google')
                const data = labels.map(source => {
                    const sourceData = growthData[source].find(item => item.period === selectedPeriod);
                    return sourceData ? parseFloat(sourceData.growth) : 0;  // Get growth percentage or 0 if not found
                });

                // Destroy the existing chart if it exists
                if (referralGrowthChart) {
                    referralGrowthChart.destroy();
                }

                // Chart rendering
                const referralGrowthCtx = document.getElementById('referralGrowthChart').getContext('2d');
                const gradient2 = referralGrowthCtx.createLinearGradient(0, 0, 0, 300);
                gradient2.addColorStop(0, '#74C911');
                gradient2.addColorStop(1, '#5AA800');

                referralGrowthChart = new Chart(referralGrowthCtx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: `Growth for ${selectedPeriod}`,
                            data: data,
                            borderColor: '#223274',
                            backgroundColor: '#223274',
                            fill: false,
                            borderWidth: 3,
                            tension: 0.4,
                            pointRadius: 0,
                            pointBackgroundColor: '#223274',
                            pointHoverRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'start',
                                usePointStyle: true,
                                pointStyle: 'circle',
                                labels: {
                                    font: {
                                        size: 14,
                                        family: "Rajdhani-Medium"
                                    },
                                    boxWidth: 20,
                                    padding: 15
                                }
                            },
                            tooltip: {
                                enabled: true,
                                backgroundColor: 'white',
                                titleColor: '#000',
                                bodyColor: '#000',
                                borderColor: '#bbb7b7',
                                borderWidth: 1,
                                cornerRadius: 4,
                                displayColors: true,
                                usePointStyle: true,
                                boxWidth: 10,
                                boxHeight: 10,
                                boxPadding: 5,
                                titleFont: {
                                    family: 'Rajdhani-Medium',
                                    size: 14
                                },
                                bodyFont: {
                                    family: 'Rajdhani-Medium',
                                    size: 14
                                },
                                bodySpacing: 10,
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    font: {
                                        family: "Rajdhani-Medium",
                                        size: 12
                                    },
                                    color: '#4A5568'
                                },
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                border: {
                                    display: false
                                },
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#d0d0d0',
                                    borderDash: [8, 8],
                                    drawBorder: false,
                                    offset: true
                                },
                                ticks: {
                                    stepSize: 30,
                                    font: {
                                        family: 'Rajdhani-Medium',
                                        size: 12
                                    },
                                    callback: function(value) {
                                        return value + '%';  // Add percentage symbol
                                    },
                                    padding: 15
                                },
                                border: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // On change of the select dropdown, re-render the chart with the selected period
            periodSelector.change(function() {
                const selectedPeriod = $(this).val();
                renderChart(selectedPeriod);
            });

            // Initial chart rendering with the first period (default)
            renderChart(periodSelector.val());

            revenueDataSets.monthly.forecasted = response.response_data.predictions.map(item => item["Projected Revenue"]);

            revenueDataSets.monthly.generated = response.historicalData.map(item => item);
            revenueDataSets.yearly.generated = response.historicalYearlyData.map(item => item);

            const forecastedMax = Math.max(...revenueDataSets.monthly.forecasted); // Max of forecasted values
            const generatedMax = Math.max(...revenueDataSets.monthly.generated); // Max of generated values

            revenueDataSets.monthly.max = Math.max(forecastedMax, generatedMax);
            revenueDataSets.yearly.max =  response.historicalYearlyData.map(item => item);
            updateRevenueChart('yearly');
        },
        error: function(error) {
            console.log('Error fetching data:', error);
        }
    });

        $.ajax({
            url: '<?php echo e(url("get_seasonal_prediction")); ?>',
            method: 'GET',
            success: function(response) {

                // Clear any previous content in both Peak and Low season containers
                $('.peak-seasons').empty();
                $('.low-seasons').empty();

                // Loop through peak_seasons and append to the peak-seasons div
                response.seasonalPrediction.peak_seasons.forEach(function(season) {
                    var peakSeasonHTML = `
                        <div class="peak-season-item">
                            <div class="season-info">
                                <div class="season-name">${season.season}</div>
                                <div class="season-type">Job Completion: ${season.job_completion} Jobs</div>
                            </div>
                            <div class="season-indicator season-high"></div>
                        </div>
                    `;
                    $('.peak-seasons').append(peakSeasonHTML);
                });

                // Loop through low_seasons and append to the low-seasons div
                response.seasonalPrediction.low_seasons.forEach(function(season) {
                    var lowSeasonHTML = `
                        <div class="peak-season-item">
                            <div class="season-info">
                                <div class="season-name">${season.season}</div>
                                <div class="season-type">Job Completion: ${season.job_completion} Jobs</div>
                            </div>
                            <div class="season-indicator season-low"></div>
                        </div>
                    `;
                    $('.low-seasons').append(lowSeasonHTML);
                });

              // Assuming the response is your complete response object
                const seasonalPrediction = response.seasonalPrediction; // Peak and low seasons from prediction
                const historicalSeasonalReport = response.historicalData.historical_seasonal_report; // Historical data

                // Create arrays to hold updated forecasted, generated, and labels values for seasonal
                const updatedSeasonalForecasted = [];
                const updatedSeasonalGenerated = [];

                // Initialize the seasonal data mapping for peak and low seasons
                const seasonalMapping = {
                    "Spring": {
                        forecasted: seasonalPrediction.peak_seasons[1].job_completion, // From prediction (Spring)
                        generated: historicalSeasonalReport.low_seasons[0].job_completion // From historical data (Spring)
                    },
                    "Summer": {
                        forecasted: seasonalPrediction.low_seasons[0].job_completion, // From prediction (Summer)
                        generated: historicalSeasonalReport.low_seasons[1].job_completion // From historical data (Summer)
                    },
                    "Fall": {
                        forecasted: seasonalPrediction.peak_seasons[0].job_completion, // From prediction (Fall)
                        generated: historicalSeasonalReport.peak_seasons[0].job_completion // From historical data (Fall)
                    },
                    "Winter": {
                        forecasted: seasonalPrediction.low_seasons[1].job_completion, // From prediction (Winter)
                        generated: historicalSeasonalReport.peak_seasons[1].job_completion // From historical data (Winter)
                    }
                };

                // Populate the seasonal forecasted and generated arrays based on seasonal mapping
                updatedSeasonalForecasted[0] = seasonalMapping["Spring"].forecasted;
                updatedSeasonalForecasted[1] = seasonalMapping["Summer"].forecasted;
                updatedSeasonalForecasted[2] = seasonalMapping["Fall"].forecasted;
                updatedSeasonalForecasted[3] = seasonalMapping["Winter"].forecasted;

                updatedSeasonalGenerated[0] = seasonalMapping["Spring"].generated;
                updatedSeasonalGenerated[1] = seasonalMapping["Summer"].generated;
                updatedSeasonalGenerated[2] = seasonalMapping["Fall"].generated;
                updatedSeasonalGenerated[3] = seasonalMapping["Winter"].generated;

                // Set the updated seasonal forecasted and generated arrays to revenueDataSets
                revenueDataSets.seasonal.forecasted = updatedSeasonalForecasted;
                revenueDataSets.seasonal.generated = updatedSeasonalGenerated;

                // Calculate the max value from seasonal forecasted and generated arrays
                const seasonalForecastedMax = Math.max(...revenueDataSets.seasonal.forecasted); // Max of forecasted values
                const seasonalGeneratedMax = Math.max(...revenueDataSets.seasonal.generated); // Max of generated values

                // Set the max value in seasonal max
                revenueDataSets.seasonal.max = Math.max(seasonalForecastedMax, seasonalGeneratedMax);

                // Final result in revenueDataSets
                console.log(revenueDataSets);






            },
            error: function(error) {
                console.log('Error in fetching data:', error);
            }
        });
    });

    // Chart configuration
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    Chart.defaults.color = '#666';

    // Revenue Chart Data Sets
    const revenueDataSets = {
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            generated: [10, 8, 12, 15, 18, 16, 20, 17, 14, 16, 12, 15],
            forecasted: [1, 2, 3, 4, 18, 20, 22, 19, 16, 18, 15, 17],
            max: 25
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023', '2024', '2025'],
            generated: [120, 145, 168, 190, 153, null],
            forecasted: [null, null, null, null, null, null],
            max: 200
        },
        seasonal: {
            labels: ['Spring', 'Summer', 'Fall', 'Winter'],
            generated: [45, 55, 32, 21],
            forecasted: [48, 52, 28, 18],
            max: 60
        }
    };
    const crosshairLine = {
        id: 'crosshairLine',
        afterDraw(chart) {
            if (chart.tooltip?._active?.length) {
                const ctx = chart.ctx;
                const x = chart.tooltip._active[0].element.x;
                const topY = chart.scales.y.top;
                const bottomY = chart.scales.y.bottom;

                ctx.save();
                ctx.beginPath();
                ctx.setLineDash([8, 5]);
                ctx.moveTo(x, topY);
                ctx.lineTo(x, bottomY);
                ctx.lineWidth = 3;
                ctx.strokeStyle = '#223274';
                ctx.stroke();
                ctx.restore();
            }
        }
    };

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
            datasets: [{
                label: 'Historical',
                data: [110000, 60000, 80000, 150000, 110000, 100000, 90000],
                borderColor: '#223274',
                backgroundColor: '#223274',
                fill: false,
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 0,
                pointBackgroundColor: '#223274',
                pointHoverRadius: 8
            }, {
                label: 'Predicted',
                data: [130000, 140000, 150000, 140000, 130000, 150000, 140000],
                borderColor: '#6CBD0E',
                backgroundColor: '#6CBD0E',
                fill: false,
                borderWidth: 3,
                borderDash: [8, 5],
                tension: 0.4,
                pointRadius: 0,
                pointBackgroundColor: '#6CBD0E',
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    position: 'top',
                    align: 'start',
                    usePointStyle: true,
                    pointStyle: 'circle',
                    labels: {
                        font: {
                            size: 14,
                            family: "Rajdhani-Medium"
                        },
                        boxWidth: 20,
                        padding: 15
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'white',
                    titleColor: '#000',
                    bodyColor: '#000',
                    borderColor: '#bbb7b7',
                    borderWidth: 1,
                    cornerRadius: 4,
                    displayColors: true,
                    usePointStyle: true,
                    boxWidth: 10,
                    boxHeight: 10,
                    boxPadding: 5,
                    titleFont: {
                        family: 'Rajdhani-Medium',
                        size: 14
                    },
                    bodyFont: {
                        family: 'Rajdhani-Medium',
                        size: 14
                    },
                    bodySpacing: 10,
                    callbacks: {
                        label: function(tooltipItem) {
                            // Format the tooltip value with two decimals
                            var formattedValue = tooltipItem.raw.toFixed(2); // Format to 2 decimal places
                            return tooltipItem.dataset.label + ': $' + formattedValue.toLocaleString(); // Format as currency
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            family: "Rajdhani-Medium",
                            size: 12
                        },
                        color: '#4A5568'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    border: {
                        display: false
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#d0d0d0',
                        borderDash: [8, 8],
                        drawBorder: false,
                        offset: true
                    },
                    ticks: {
                        stepSize: 30000,
                        font: {
                            family: 'Rajdhani-Medium',
                            size: 12
                        },
                        callback: function(value) {
                            return value / 1000 + 'k';
                        },
                        padding: 15
                    },
                    border: {
                        display: false
                    }
                }
            },
        },
        plugins: [crosshairLine]
    });




    // Chart.js default configuration
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.color = '#6c757d';

    $.ajax({
        url: '<?php echo e(url("get_category_prediction")); ?>',  // Replace with your actual URL
        method: 'GET',
        success: function(response) {
            console.log(response);

            // Initialize an object to hold the total jobs per category
            const categoryJobs = {};

            // Loop through each month's breakdown to calculate total jobs per category
            response.forecasted_statistics.forEach(function(monthData) {
                monthData.category_breakdown.forEach(function(category) {
                    // If the category already exists, add the jobs to it
                    if (categoryJobs[category.category]) {
                        categoryJobs[category.category] += category.jobs;
                    } else {
                        // If the category does not exist, initialize the job count
                        categoryJobs[category.category] = category.jobs;
                    }
                });
            });

            // Now prepare the chart data
            const categories = Object.keys(categoryJobs);  // Get all unique categories
            const jobsData = categories.map(category => categoryJobs[category]);  // Get job totals for each category

            // Now, update the chart
            const statsCtx = document.getElementById('statsChart').getContext('2d');
            const gradient1 = statsCtx.createLinearGradient(0, 0, 0, 400);
            gradient1.addColorStop(0, '#223274');
            gradient1.addColorStop(1, '#383E52');

            // Statistics Bar Chart
            const statsChart = new Chart(statsCtx, {
                type: 'bar',
                data: {
                    labels: categories,  // Category names from the response
                    datasets: [{
                        label: 'Projected Revenue',  // You can change this label if needed
                        data: jobsData,  // Total jobs for each category
                        backgroundColor: gradient1,
                        borderWidth: 0,
                        borderRadius: {
                            topLeft: 8,
                            topRight: 8,
                            bottomLeft: 0,
                            bottomRight: 0
                        },
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Jobs: ' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#d0d0d0',
                                borderDash: [8, 8],
                                drawBorder: false,
                                offset: true
                            },
                            ticks: {
                                stepSize: 10,
                                callback: function(value) {
                                    return value;
                                },
                                padding: 15
                            },
                            border: {
                                display: false
                            }
                        },
                        x: {
                            ticks: {
                                maxRotation: 0,
                                minRotation: 0
                            },
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            border: {
                                display: false
                            }
                        }
                    }
                }
            });
        },
        error: function(error) {
            console.log('Error in fetching data:', error);
        }
    });

    // Job Cost Chart

    $.ajax({
        url: '<?php echo e(url("get_job_cost_prediction")); ?>',
        method: 'GET',
        success: function(response) {
            console.log(response);

            // Process Historical Data
            const historicalData = response.historical;
            const predictedData = response.predicted.average_job_cost;

            // Initialize an array to store the final average historical job cost data
            const historicalAverages = [];
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            // Loop through each year in the historical data and calculate the average for each month
            months.forEach((month, monthIndex) => {
                let totalCost = 0;
                let yearCount = 0;

                // Loop through each year in historical data
                Object.values(historicalData).forEach(yearData => {
                    const monthlyData = yearData.monthly_averages.average_job_cost.find(item => item.month === month);
                    if (monthlyData && monthlyData.average_cost > 0) {
                        totalCost += monthlyData.average_cost;
                        yearCount++;
                    }
                });

                // Calculate average for the month
                const averageCost = yearCount > 0 ? totalCost / yearCount : 0;
                historicalAverages.push(averageCost);
            });

            // Prepare the chart data
            const labels = months; // X-axis labels are the months
            const historicalDataForChart = historicalAverages; // Y-axis data for Historical
            const predictedDataForChart = predictedData.map(item => item.average_cost); // Y-axis data for Predicted
            
            
            // Destroy any existing chart to avoid "Canvas is already in use" error
            // if (window.jobCostChart) {
            //     window.jobCostChart.destroy();
            // }

    const jobCostCtx = document.getElementById('jobCostChart').getContext('2d');
    const jobCostChart = new Chart(jobCostCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Historical',
                data: historicalDataForChart,
                borderColor: '#223274',
                backgroundColor: '#223274',
                fill: false,
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 0,
                pointBackgroundColor: '#223274',
                pointHoverRadius: 8
            }, {
                label: 'Predicted',
                data: predictedDataForChart,
                borderColor: '#6CBD0E',
                backgroundColor: '#6CBD0E',
                fill: false,
                borderWidth: 3,
                borderDash: [8, 5],
                tension: 0.4,
                pointRadius: 0,
                pointBackgroundColor: '#6CBD0E',
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    position: 'top',
                    align: 'start',
                    usePointStyle: true,
                    pointStyle: 'circle',
                    labels: {
                        font: {
                            size: 14,
                            family: "Rajdhani-Medium"
                        },
                        boxWidth: 20,
                        padding: 15
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'white',
                    titleColor: '#000',
                    bodyColor: '#000',
                    borderColor: '#bbb7b7',
                    borderWidth: 1,
                    cornerRadius: 4,
                    displayColors: true,
                    usePointStyle: true,
                    boxWidth: 10,
                    boxHeight: 10,
                    boxPadding: 5,
                    titleFont: {
                        family: 'Rajdhani-Medium',
                        size: 14
                    },
                    bodyFont: {
                        family: 'Rajdhani-Medium',
                        size: 14
                    },
                    bodySpacing: 10,
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            family: "Rajdhani-Medium",
                            size: 12
                        },
                        color: '#4A5568'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    border: {
                        display: false
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#d0d0d0',
                        borderDash: [8, 8],
                        drawBorder: false,
                        offset: true
                    },
                    ticks: {
                        stepSize: 5000,
                        font: {
                            family: 'Rajdhani-Medium',
                            size: 12
                        },
                        callback: function(value) {
                            return value;
                        },
                        padding: 15
                    },
                    border: {
                        display: false
                    }
                }
            },
        },
        plugins: [crosshairLine]
    });
        },
        error: function(error) {
            console.log('Error in fetching data:', error);
        }
    });

    // Job Margin Chart
    $.ajax({
        url: '<?php echo e(url("get_job_margin_prediction")); ?>',
        method: 'GET',
        success: function(response) {
            console.log(response);

            // Process Historical Data
            const historicalData = response.historical;
            const predictedData = response.predicted.average_job_margin;

            // Initialize an array to store the final average historical job margin data
            const historicalAverages = [];
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            // Loop through each year in the historical data and calculate the average for each month
            months.forEach((month, monthIndex) => {
                let totalMargin = 0;
                let yearCount = 0;

                // Loop through each year in historical data
                Object.values(historicalData).forEach(yearData => {
                    const monthlyData = yearData.monthly_averages.average_job_margin.find(item => item.month === month);
                    if (monthlyData && monthlyData.average_margin > 0) {
                        totalMargin += monthlyData.average_margin;
                        yearCount++;
                    }
                });

                // Calculate average for the month
                const averageMargin = yearCount > 0 ? totalMargin / yearCount : 0;
                historicalAverages.push(averageMargin.toFixed(2));
            });

            // Prepare the chart data
            const labels = months; // X-axis labels are the months
            const historicalDataForChart = historicalAverages; // Y-axis data for Historical
            const predictedDataForChart = predictedData.map(item => item.average_margin); // Y-axis data for Predicted

            // Destroy any existing chart to avoid "Canvas is already in use" error
            // if (window.jobMarginChart) {
            //     window.jobMarginChart.destroy();
            // }

            const jobMarginCtx = document.getElementById('jobMarginChart').getContext('2d');
            const gradient1 = jobMarginCtx.createLinearGradient(0, 0, 0, 400);
            gradient1.addColorStop(0, '#223274');
            gradient1.addColorStop(1, '#383E52');

            const gradient2 = jobMarginCtx.createLinearGradient(0, 0, 0, 400);
            gradient2.addColorStop(0, '#6CBD0E');
            gradient2.addColorStop(1, '#5AA800');

            // Initialize the Chart
            window.jobMarginChart = new Chart(jobMarginCtx, {
                type: 'line',
                data: {
                    labels: labels,  // X-axis labels are the months
                    datasets: [
                        {
                            label: 'Historical',
                            data: historicalDataForChart,  // Historical data
                            borderColor: gradient1,
                            backgroundColor: gradient1,
                            fill: false,
                            borderWidth: 3,
                            tension: 0.4,
                            pointRadius: 0,
                            pointBackgroundColor: gradient1,
                            pointHoverRadius: 8
                        },
                        {
                            label: 'Predicted',
                            data: predictedDataForChart,  // Predicted data
                            borderColor: gradient2,
                            backgroundColor: gradient2,
                            fill: false,
                            borderWidth: 3,
                            borderDash: [8, 5],
                            tension: 0.4,
                            pointRadius: 0,
                            pointBackgroundColor: gradient2,
                            pointHoverRadius: 8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'start',
                            usePointStyle: true,
                            pointStyle: 'circle',
                            labels: {
                                font: {
                                    size: 14,
                                    family: "Rajdhani-Medium"
                                },
                                boxWidth: 20,
                                padding: 15
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'white',
                            titleColor: '#000',
                            bodyColor: '#000',
                            borderColor: '#bbb7b7',
                            borderWidth: 1,
                            cornerRadius: 4,
                            displayColors: true,
                            usePointStyle: true,
                            boxWidth: 10,
                            boxHeight: 10,
                            boxPadding: 5,
                            titleFont: {
                                family: 'Rajdhani-Medium',
                                size: 14
                            },
                            bodyFont: {
                                family: 'Rajdhani-Medium',
                                size: 14
                            },
                            bodySpacing: 10,
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%'; // Display in percentage
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    family: "Rajdhani-Medium",
                                    size: 12
                                },
                                color: '#4A5568'
                            },
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            border: {
                                display: false
                            },
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#d0d0d0',
                                borderDash: [8, 8],
                                drawBorder: false,
                                offset: true
                            },
                            ticks: {
                                stepSize: 10, // Adjust step size based on your data
                                font: {
                                    family: 'Rajdhani-Medium',
                                    size: 12
                                },
                                callback: function(value) {
                                    return value + '%'; // Add percentage symbol
                                },
                                padding: 15
                            },
                            border: {
                                display: false
                            }
                        }
                    }
                }
            });
        },
        error: function(error) {
            console.log('Error in fetching data:', error);
        }
    });

    // Referral Growth Chart
    // const referralGrowthCtx = document.getElementById('referralGrowthChart').getContext('2d');
    // const referralGrowthChart = new Chart(referralGrowthCtx, {
    //     type: 'line',
    //     data: {
    //         labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
    //         datasets: [{
    //             label: 'Historical',
    //             data: [110000, 60000, 80000, 150000, 110000, 100000, 90000],
    //             borderColor: '#223274',
    //             backgroundColor: '#223274',
    //             fill: false,
    //             borderWidth: 3,
    //             tension: 0.4,
    //             pointRadius: 0,
    //             pointBackgroundColor: '#223274',
    //             pointHoverRadius: 8
    //         }, {
    //             label: 'Predicted',
    //             data: [130000, 140000, 150000, 140000, 130000, 150000, 140000],
    //             borderColor: '#6CBD0E',
    //             backgroundColor: '#6CBD0E',
    //             fill: false,
    //             borderWidth: 3,
    //             borderDash: [8, 5],
    //             tension: 0.4,
    //             pointRadius: 0,
    //             pointBackgroundColor: '#6CBD0E',
    //             pointHoverRadius: 8
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         interaction: {
    //             mode: 'index',
    //             intersect: false
    //         },
    //         plugins: {
    //             legend: {
    //                 position: 'top',
    //                 align: 'start',
    //                 usePointStyle: true,
    //                 pointStyle: 'circle',
    //                 labels: {
    //                     font: {
    //                         size: 14,
    //                         family: "Rajdhani-Medium"
    //                     },
    //                     boxWidth: 20,
    //                     padding: 15
    //                 }
    //             },
    //             tooltip: {
    //                 enabled: true,
    //                 backgroundColor: 'white',
    //                 titleColor: '#000',
    //                 bodyColor: '#000',
    //                 borderColor: '#bbb7b7',
    //                 borderWidth: 1,
    //                 cornerRadius: 4,
    //                 displayColors: true,
    //                 usePointStyle: true,
    //                 boxWidth: 10,
    //                 boxHeight: 10,
    //                 boxPadding: 5,
    //                 titleFont: {
    //                     family: 'Rajdhani-Medium',
    //                     size: 14
    //                 },
    //                 bodyFont: {
    //                     family: 'Rajdhani-Medium',
    //                     size: 14
    //                 },
    //                 bodySpacing: 10,
    //                 callbacks: {
    //                     label: function(tooltipItem) {
    //                         return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
    //                     }
    //                 }
    //             }
    //         },
    //         scales: {
    //             x: {
    //                 ticks: {
    //                     font: {
    //                         family: "Rajdhani-Medium",
    //                         size: 12
    //                     },
    //                     color: '#4A5568'
    //                 },
    //                 grid: {
    //                     display: false,
    //                     drawBorder: false
    //                 },
    //                 border: {
    //                     display: false
    //                 },
    //             },
    //             y: {
    //                 beginAtZero: true,
    //                 grid: {
    //                     color: '#d0d0d0',
    //                     borderDash: [8, 8],
    //                     drawBorder: false,
    //                     offset: true
    //                 },
    //                 ticks: {
    //                     stepSize: 30000,
    //                     font: {
    //                         family: 'Rajdhani-Medium',
    //                         size: 12
    //                     },
    //                     callback: function(value) {
    //                         return value / 1000 + 'k';
    //                     },
    //                     padding: 15
    //                 },
    //                 border: {
    //                     display: false
    //                 }
    //             }
    //         },
    //     },
    //     plugins: [crosshairLine]
    // });

    // Goal Analysis Charts
    // Goal Analysis Charts
    const goalRevenueDataSets = {
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: [15, 10, 12, 18, 16, 14, 16, 13, 11, 13, 15, 12],
            max: 25
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023', '2024', '2025'],
            data: [135, 158, 182, 165, 141, 180],
            max: 200
        },
        seasonal: {
            labels: ['Spring', 'Summer', 'Fall', 'Winter'],
            data: [52, 58, 35, 25],
            max: 60
        }
    };

    function initializeGoalCharts() {
        // Goal Revenue Chart
        const goalRevenueCtx = document.getElementById('goalRevenueChart').getContext('2d');
        window.goalRevenueChart = new Chart(goalRevenueCtx, {
            type: 'line',
            data: {
                labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
                datasets: [{
                    label: 'Historical',
                    data: [110000, 60000, 80000, 150000, 110000, 100000, 90000],
                    borderColor: '#223274',
                    backgroundColor: '#223274',
                    fill: false,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#223274',
                    pointHoverRadius: 8
                }, {
                    label: 'Predicted',
                    data: [130000, 140000, 150000, 140000, 130000, 150000, 140000],
                    borderColor: '#6CBD0E',
                    backgroundColor: '#6CBD0E',
                    fill: false,
                    borderWidth: 3,
                    borderDash: [8, 5],
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#6CBD0E',
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'start',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        labels: {
                            font: {
                                size: 14,
                                family: "Rajdhani-Medium"
                            },
                            boxWidth: 20,
                            padding: 15
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'white',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#bbb7b7',
                        borderWidth: 1,
                        cornerRadius: 4,
                        displayColors: true,
                        usePointStyle: true,
                        boxWidth: 10,
                        boxHeight: 10,
                        boxPadding: 5,
                        titleFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodyFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodySpacing: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: "Rajdhani-Medium",
                                size: 12
                            },
                            color: '#4A5568'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: 30000,
                            font: {
                                family: 'Rajdhani-Medium',
                                size: 12
                            },
                            callback: function(value) {
                                return value / 1000 + 'k';
                            },
                            padding: 15
                        },
                        border: {
                            display: false
                        }
                    }
                },
            },
            plugins: [crosshairLine]
        });

        // Goal Stats Chart
        const goalStatsCtx = document.getElementById('goalStatsChart').getContext('2d');
        const goalStatsChart = new Chart(goalStatsCtx, {
            type: 'bar',
            data: {
                labels: ['Metal Roofing', 'Plywood', 'Roofing', 'Wood Shakes', 'Wood Shakes', 'Wood Shakes', 'Green Roofing', 'Green Roofing', 'Green Roofing'],
                datasets: [{
                    label: 'Target Jobs',
                    data: [18, 22, 26, 8, 30, 10, 16, 30, 17],
                    backgroundColor: '#1e3a8a',
                    borderRadius: 2,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 40,
                        ticks: {
                            stepSize: 10
                        },
                        grid: {
                            color: '#f0f0f0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Goal Job Cost Chart
        const goalJobCostCtx = document.getElementById('goalJobCostChart').getContext('2d');
        const goalJobCostChart = new Chart(goalJobCostCtx, {
            type: 'line',
            data: {
                labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
                datasets: [{
                    label: 'Historical',
                    data: [110000, 60000, 80000, 150000, 110000, 100000, 90000],
                    borderColor: '#223274',
                    backgroundColor: '#223274',
                    fill: false,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#223274',
                    pointHoverRadius: 8
                }, {
                    label: 'Predicted',
                    data: [130000, 140000, 150000, 140000, 130000, 150000, 140000],
                    borderColor: '#6CBD0E',
                    backgroundColor: '#6CBD0E',
                    fill: false,
                    borderWidth: 3,
                    borderDash: [8, 5],
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#6CBD0E',
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'start',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        labels: {
                            font: {
                                size: 14,
                                family: "Rajdhani-Medium"
                            },
                            boxWidth: 20,
                            padding: 15
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'white',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#bbb7b7',
                        borderWidth: 1,
                        cornerRadius: 4,
                        displayColors: true,
                        usePointStyle: true,
                        boxWidth: 10,
                        boxHeight: 10,
                        boxPadding: 5,
                        titleFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodyFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodySpacing: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: "Rajdhani-Medium",
                                size: 12
                            },
                            color: '#4A5568'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: 30000,
                            font: {
                                family: 'Rajdhani-Medium',
                                size: 12
                            },
                            callback: function(value) {
                                return value / 1000 + 'k';
                            },
                            padding: 15
                        },
                        border: {
                            display: false
                        }
                    }
                },
            },
            plugins: [crosshairLine]
        });

        // Goal Job Margin Chart
        const goalJobMarginCtx = document.getElementById('goalJobMarginChart').getContext('2d');
        const goalJobMarginChart = new Chart(goalJobMarginCtx, {
            type: 'line',
            data: {
                labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
                datasets: [{
                    label: 'Historical',
                    data: [110000, 60000, 80000, 150000, 110000, 100000, 90000],
                    borderColor: '#223274',
                    backgroundColor: '#223274',
                    fill: false,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#223274',
                    pointHoverRadius: 8
                }, {
                    label: 'Predicted',
                    data: [130000, 140000, 150000, 140000, 130000, 150000, 140000],
                    borderColor: '#6CBD0E',
                    backgroundColor: '#6CBD0E',
                    fill: false,
                    borderWidth: 3,
                    borderDash: [8, 5],
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#6CBD0E',
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'start',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        labels: {
                            font: {
                                size: 14,
                                family: "Rajdhani-Medium"
                            },
                            boxWidth: 20,
                            padding: 15
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'white',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#bbb7b7',
                        borderWidth: 1,
                        cornerRadius: 4,
                        displayColors: true,
                        usePointStyle: true,
                        boxWidth: 10,
                        boxHeight: 10,
                        boxPadding: 5,
                        titleFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodyFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodySpacing: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: "Rajdhani-Medium",
                                size: 12
                            },
                            color: '#4A5568'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: 30000,
                            font: {
                                family: 'Rajdhani-Medium',
                                size: 12
                            },
                            callback: function(value) {
                                return value / 1000 + 'k';
                            },
                            padding: 15
                        },
                        border: {
                            display: false
                        }
                    }
                },
            },
            plugins: [crosshairLine]
        });

        // Goal Referral Growth Chart
        const goalReferralGrowthCtx = document.getElementById('goalReferralGrowthChart').getContext('2d');
        const goalReferralGrowthChart = new Chart(goalReferralGrowthCtx, {
            type: 'line',
            data: {
                labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
                datasets: [{
                    label: 'Historical',
                    data: [110000, 60000, 80000, 150000, 110000, 100000, 90000],
                    borderColor: '#223274',
                    backgroundColor: '#223274',
                    fill: false,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#223274',
                    pointHoverRadius: 8
                }, {
                    label: 'Predicted',
                    data: [130000, 140000, 150000, 140000, 130000, 150000, 140000],
                    borderColor: '#6CBD0E',
                    backgroundColor: '#6CBD0E',
                    fill: false,
                    borderWidth: 3,
                    borderDash: [8, 5],
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#6CBD0E',
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'start',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        labels: {
                            font: {
                                size: 14,
                                family: "Rajdhani-Medium"
                            },
                            boxWidth: 20,
                            padding: 15
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'white',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#bbb7b7',
                        borderWidth: 1,
                        cornerRadius: 4,
                        displayColors: true,
                        usePointStyle: true,
                        boxWidth: 10,
                        boxHeight: 10,
                        boxPadding: 5,
                        titleFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodyFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodySpacing: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: "Rajdhani-Medium",
                                size: 12
                            },
                            color: '#4A5568'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: 30000,
                            font: {
                                family: 'Rajdhani-Medium',
                                size: 12
                            },
                            callback: function(value) {
                                return value / 1000 + 'k';
                            },
                            padding: 15
                        },
                        border: {
                            display: false
                        }
                    }
                },
            },
            plugins: [crosshairLine]
        });
    }

    // Initialize goal charts when page loads
    setTimeout(initializeGoalCharts, 100);

    // Revenue Chart Tab Functionality
    function updateRevenueChart(period) {
        const data = revenueDataSets[period];
        revenueChart.data.labels = data.labels;
        revenueChart.data.datasets[0].data = data.generated;
        revenueChart.data.datasets[1].data = data.forecasted;
        revenueChart.options.scales.y.max = data.max;

        // Update step size based on period
        if (period === 'yearly') {
            revenueChart.options.scales.y.ticks.stepSize = 50;
        } else if (period === 'seasonal') {
            revenueChart.options.scales.y.ticks.stepSize = 10;
        } else {
            revenueChart.options.scales.y.ticks.stepSize = 10;
        }

        revenueChart.update();
    }

    function updateGoalRevenueChart(period) {
        const data = predictrevenueDataSets[period];
        window.goalRevenueChart.data.labels = data.labels;
        window.goalRevenueChart.data.datasets[0].data = data.data;
        window.goalRevenueChart.options.scales.y.max = data.max;

        // Update step size based on period
        if (period === 'yearly') {
            window.goalRevenueChart.options.scales.y.ticks.stepSize = 50;
        } else if (period === 'seasonal') {
            window.goalRevenueChart.options.scales.y.ticks.stepSize = 10;
        } else {
            window.goalRevenueChart.options.scales.y.ticks.stepSize = 5;
        }

        window.goalRevenueChart.update();
    }

    // Add click event listeners to revenue tabs (Sales Analysis)
    document.querySelectorAll('#sales-analysis .revenue-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            document.querySelectorAll('#sales-analysis .revenue-tab').forEach(t => t.classList.remove('active'));

            // Add active class to clicked tab
            this.classList.add('active');

            // Update chart based on tab text
            const period = this.textContent.toLowerCase();
            if (period === 'monthly') {
                updateRevenueChart('monthly');
            } else if (period === 'yearly') {
                updateRevenueChart('yearly');
            } else if (period === 'seasonal') {
                updateRevenueChart('seasonal');
            }
        });
    });

    // Add click event listeners to revenue tabs (Goal Analysis)
    document.querySelectorAll('#goal-analysis .revenue-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            document.querySelectorAll('#goal-analysis .revenue-tab').forEach(t => t.classList.remove('active'));

            // Add active class to clicked tab
            this.classList.add('active');

            // Update chart based on tab text
            const period = this.textContent.toLowerCase();
            if (period === 'monthly') {
                updateGoalRevenueChart('monthly');
            } else if (period === 'yearly') {
                updateGoalRevenueChart('yearly');
            } else if (period === 'seasonal') {
                updateGoalRevenueChart('seasonal');
            }
        });
    });

    document.getElementById('goal-analysis-form').addEventListener('submit', function(event) {
        event.preventDefault();
        generateGoalAnalysis();
    });

    function generateGoalAnalysis() {
        const goalValue = document.getElementById('enteryourGoal').value;

        // Validate if goal value is entered and is a valid number
        if (!goalValue || isNaN(goalValue) || goalValue <= 0) {
            alert('Please enter a valid goal value');
            return;
        }

        // Disable the button and show loading text
        const button = document.querySelector('.btn-generate');
        const originalText = button.textContent;
        button.textContent = 'Generating...';
        button.disabled = true;

        // Send data to backend using AJAX
        $.ajax({
            url: '<?php echo e(url("api/goal_report_analysis")); ?>', // Endpoint for your backend
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>', // CSRF token
                enteryourGoal: goalValue // Send the goal value
            },
            success: function(data) {
                // Reset button text and disable status after response
                button.textContent = originalText;
                button.disabled = false;
                if (data.success) {
                    $('#goal-analysis-result').html(data.html); // Assuming there's a div to display the result
                    const historicalData = data.projectedRevenue; // Example: [110000, 60000, ...]
                    const predictedData = data.monthlyRevenue; // Example: [130000, 140000, ...]
                    
                    // Update chart data
                    predictrevenueDataSets.monthly.forecasted = historicalData; // Update the Historical dataset
                    predictrevenueDataSets.monthly.generated = predictedData; // Update the Predicted dataset



                    const forecastedMax = Math.max(...predictrevenueDataSets.monthly.forecasted); // Max of forecasted values
                    const generatedMax = Math.max(...predictrevenueDataSets.monthly.generated); // Max of generated values

                    predictrevenueDataSets.monthly.max = Math.max(forecastedMax, generatedMax);
                    
                    // Update chart options or other settings if needed
                    predictRevChart(historicalData,predictedData); // Show success message
                    
                    predictedJobCosts = data.predictedJobCost.predicted.average_job_cost;
                    historicalJobCost = data.predictedJobCost.historical;
                    
                    // Initialize an array to store the final average historical job cost data
                    const historicalAverages = [];
                    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

                    // Loop through each year in the historical data and calculate the average for each month
                    months.forEach((month, monthIndex) => {
                    let totalCost = 0;
                    let yearCount = 0;

                    // Loop through each year in historical data
                    Object.values(historicalJobCost).forEach(yearData => {
                    const monthlyData = yearData.monthly_averages.average_job_cost.find(item => item.month === month);
                    if (monthlyData && monthlyData.average_cost > 0) {
                    totalCost += monthlyData.average_cost;
                    yearCount++;
                    }
                    });

                    // Calculate average for the month
                    const averageCost = yearCount > 0 ? totalCost / yearCount : 0;
                    historicalAverages.push(averageCost);
                    });
                    predictJobCost(predictedJobCosts.map(item => item.average_cost),historicalAverages);






                    predictedJobMargin = data.predictedJobMargin.predicted.average_job_margin;
                    historicalJobMargin = data.predictedJobMargin.historical;
                    
                    // Initialize an array to store the final average historical job cost data
                    const historicalMarginAverages = [];

                    // Loop through each year in the historical data and calculate the average for each month
                    months.forEach((month, monthIndex) => {
                        let totalCost = 0;
                        let yearCount = 0;

                        // Loop through each year in historical data
                        Object.values(historicalJobMargin).forEach(yearData => {
                        const monthlyMarginData = yearData.monthly_averages.average_job_margin.find(item => item.month === month);
                        if (monthlyMarginData && monthlyMarginData.average_margin > 0) {
                        totalCost += monthlyMarginData.average_margin;
                        yearCount++;
                        }
                        });

                        // Calculate average for the month
                        const averageMarginCost = yearCount > 0 ? totalCost / yearCount : 0;
                        historicalMarginAverages.push(averageMarginCost);
                    });
                    predictJobMargin(predictedJobMargin.map(item => item.average_margin),historicalMarginAverages);


                    let labels = [];
                    let estimatedRevenue = [];

                    // Loop through each month's data in the `predictedCategoriesStats` object
                    for (let month in data.predictedCategoriesStats) {
                        let monthData = data.predictedCategoriesStats[month];

                        // Loop through each category (e.g., "Roofing", "CHIMNEY SERVICES", etc.) in the month
                        for (let category in monthData) {
                            // If the category doesn't exist in the labels array, add it
                            if (!labels.includes(category)) {
                                labels.push(category);
                                // Initialize the revenue sum for this category
                                estimatedRevenue.push(0);
                            }
                            
                            // Find the index of the current category in the labels array
                            let categoryIndex = labels.indexOf(category);
                            
                            // Add the estimated revenue for this month/category to the total
                            estimatedRevenue[categoryIndex] += monthData[category].estimated_revenue;
                        }
                    }
                    predictStatsChart(labels,estimatedRevenue);







                    const predictGrowthData = data.topReferralGrowthSources.growth_data; // Changed variable name to predictGrowthData
                    const predictPeriodSelector = $(document).find('#predictPeriodSelector');
                    const predictPeriods = []; // Initialize empty array to hold periods for prediction

                    // Extract periods dynamically from the predictGrowthData
                    Object.values(predictGrowthData).forEach(referralSourceData => {
                        referralSourceData.forEach(item => {
                            if (!predictPeriods.includes(item.period)) {
                                predictPeriods.push(item.period); // Add unique periods to the array
                            }
                        });
                    });

                    // Populate the dropdown with periods
                    predictPeriods.forEach(period => {
                        const option = $('<option>', {
                            text: period,
                            value: period  // Set the period as the value
                        });
                        predictPeriodSelector.append(option);
                    });

                    // Initialize chart variable
                    let predictReferralGrowthChart = null; // Changed to predictReferralGrowthChart

                    // Function to render the chart based on selected period
                    function renderPredictChart(selectedPeriod) {
                        const predictLabels = Object.keys(predictGrowthData);  // Referral sources (e.g., 'Roofing Website', 'Google')
                        const predictData = predictLabels.map(source => {
                            const sourceData = predictGrowthData[source].find(item => item.period === selectedPeriod);
                            return sourceData ? parseFloat(sourceData.growth.replace('%', '')) : 0;  // Remove '%' and parse the growth value
                        });

                        // Destroy the existing chart if it exists
                        if (predictReferralGrowthChart) {
                            predictReferralGrowthChart.destroy();
                        }

                        // Chart rendering
                        const predictReferralGrowthCtx = document.getElementById('predictreferralGrowthChart').getContext('2d');
                        const gradient2 = predictReferralGrowthCtx.createLinearGradient(0, 0, 0, 300);
                        gradient2.addColorStop(0, '#74C911');
                        gradient2.addColorStop(1, '#5AA800');

                        predictReferralGrowthChart = new Chart(predictReferralGrowthCtx, {
                            type: 'line',
                            data: {
                                labels: predictLabels,
                                datasets: [{
                                    label: `Growth for ${selectedPeriod}`,
                                    data: predictData,
                                    borderColor: '#223274',
                                    backgroundColor: '#223274',
                                    fill: false,
                                    borderWidth: 3,
                                    tension: 0.4,
                                    pointRadius: 0,
                                    pointBackgroundColor: '#223274',
                                    pointHoverRadius: 8
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                interaction: {
                                    mode: 'index',
                                    intersect: false
                                },
                                plugins: {
                                    legend: {
                                        position: 'top',
                                        align: 'start',
                                        usePointStyle: true,
                                        pointStyle: 'circle',
                                        labels: {
                                            font: {
                                                size: 14,
                                                family: "Rajdhani-Medium"
                                            },
                                            boxWidth: 20,
                                            padding: 15
                                        }
                                    },
                                    tooltip: {
                                        enabled: true,
                                        backgroundColor: 'white',
                                        titleColor: '#000',
                                        bodyColor: '#000',
                                        borderColor: '#bbb7b7',
                                        borderWidth: 1,
                                        cornerRadius: 4,
                                        displayColors: true,
                                        usePointStyle: true,
                                        boxWidth: 10,
                                        boxHeight: 10,
                                        boxPadding: 5,
                                        titleFont: {
                                            family: 'Rajdhani-Medium',
                                            size: 14
                                        },
                                        bodyFont: {
                                            family: 'Rajdhani-Medium',
                                            size: 14
                                        },
                                        bodySpacing: 10,
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%';
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            font: {
                                                family: "Rajdhani-Medium",
                                                size: 12
                                            },
                                            color: '#4A5568'
                                        },
                                        grid: {
                                            display: false,
                                            drawBorder: false
                                        },
                                        border: {
                                            display: false
                                        },
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: '#d0d0d0',
                                            borderDash: [8, 8],
                                            drawBorder: false,
                                            offset: true
                                        },
                                        ticks: {
                                            stepSize: 30,
                                            font: {
                                                family: 'Rajdhani-Medium',
                                                size: 12
                                            },
                                            callback: function(value) {
                                                return value + '%';  // Add percentage symbol
                                            },
                                            padding: 15
                                        },
                                        border: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });
                    }

                    // Handle period selection change
                    $('#predictPeriodSelector').change(function() {
                        var selectedPeriod = $(this).val();
                        renderPredictChart(selectedPeriod);
                    });

                    // Initially render the chart with the first period
                    renderPredictChart(predictPeriods[0]);



                    
                    
                    // revenueChart.update(); // Show success message
                } else {
                    console.log('Error: ' + (data || 'Failed to generate goal analysis.'));
                }



                
                document.querySelectorAll('#goal-analysis-result .revenue-tab').forEach(tab => {
                    tab.addEventListener('click', function() {
                        // Remove active class from all tabs
                        document.querySelectorAll('#goal-analysis-result .revenue-tab').forEach(t => t.classList.remove('active'));

                        // Add active class to clicked tab
                        this.classList.add('active');

                        // Update chart based on tab text
                        const period = this.textContent.toLowerCase();
                        if (period === 'monthly') {
                            updatePredictRevenueChart('monthly');
                        } else if (period === 'yearly') {
                            updatePredictRevenueChart('yearly');
                        } else if (period === 'seasonal') {
                            updatePredictRevenueChart('seasonal');
                        }
                    });
                });

                 // Initialize arrays for storing updated seasonal data
                let seasonal_labels = ['Spring', 'Summer', 'Fall', 'Winter'];
                let seasonal_generated = [];
                let seasonal_forecasted = [];

                // Loop through each year in the predictedJobCost.historical data
                Object.keys(data.predictedJobCost.historical).forEach(year => {
                    const yearData = data.predictedJobCost.historical[year];

                    // Check if the seasonal_report data exists for this year
                    if (yearData.seasonal_report) {
                        const seasonal_peakSeasons = yearData.seasonal_report.peak_seasons || [];
                        const seasonal_lowSeasons = yearData.seasonal_report.low_seasons || [];

                        // Initialize seasonal data for the year
                        let seasonal_generatedForYear = [0, 0, 0, 0]; // Spring, Summer, Fall, Winter
                        let seasonal_forecastedForYear = [0, 0, 0, 0]; // Same for forecasted values

                        // Map seasons to their respective index (0 = Spring, 1 = Summer, 2 = Fall, 3 = Winter)
                        seasonal_peakSeasons.forEach(season => {
                            if (season.season.includes("Spring")) {
                                seasonal_generatedForYear[0] = season.job_completion;
                                seasonal_forecastedForYear[0] = season.job_completion; // Assuming forecasted is same as generated for simplicity
                            }
                            if (season.season.includes("Summer")) {
                                seasonal_generatedForYear[1] = season.job_completion;
                                seasonal_forecastedForYear[1] = season.job_completion;
                            }
                            if (season.season.includes("Fall")) {
                                seasonal_generatedForYear[2] = season.job_completion;
                                seasonal_forecastedForYear[2] = season.job_completion;
                            }
                            if (season.season.includes("Winter")) {
                                seasonal_generatedForYear[3] = season.job_completion;
                                seasonal_forecastedForYear[3] = season.job_completion;
                            }
                        });

                        // Similarly for low seasons (you can decide how to handle low season job completions)
                        seasonal_lowSeasons.forEach(season => {
                            if (season.season.includes("Spring")) {
                                seasonal_generatedForYear[0] += season.job_completion; // Add low season jobs to high season jobs
                                seasonal_forecastedForYear[0] += season.job_completion;
                            }
                            if (season.season.includes("Summer")) {
                                seasonal_generatedForYear[1] += season.job_completion;
                                seasonal_forecastedForYear[1] += season.job_completion;
                            }
                            if (season.season.includes("Fall")) {
                                seasonal_generatedForYear[2] += season.job_completion;
                                seasonal_forecastedForYear[2] += season.job_completion;
                            }
                            if (season.season.includes("Winter")) {
                                seasonal_generatedForYear[3] += season.job_completion;
                                seasonal_forecastedForYear[3] += season.job_completion;
                            }
                        });

                        // Update the seasonal arrays (generated and forecasted) for this year
                        seasonal_generated = seasonal_generated.concat(seasonal_generatedForYear);
                        seasonal_forecasted = seasonal_forecasted.concat(seasonal_forecastedForYear);
                    }
                });

                // Now update the seasonal dataset in predictrevenueDataSets
                predictrevenueDataSets.seasonal.labels = seasonal_labels;  // Update labels (Spring, Summer, Fall, Winter)
                predictrevenueDataSets.seasonal.generated = seasonal_generated;  // Update generated data
                predictrevenueDataSets.seasonal.forecasted = seasonal_forecasted;  // Update forecasted data

                // Optionally, you can log the updated dataset
                console.log(predictrevenueDataSets);






                 // Initialize arrays for storing updated yearly data
                let yearly_labels = [];
                let yearly_generated = [];
                let yearly_forecasted = [];

                // Loop through each year in the predictedJobMargin.historical data
                Object.keys(data.predictedJobCost.historical).forEach(year => {
                    const yearData = data.predictedJobCost.historical[year];

                    // Check if the monthly_averages data exists for this year
                    if (yearData.monthly_averages && yearData.monthly_averages.average_job_cost) {
                        const monthlyAverages = yearData.monthly_averages.average_job_cost;

                        // Calculate the sum of the average costs for the year
                        let totalGeneratedCost = 0;
                        let totalForecastedCost = 0;
                        let numMonths = monthlyAverages.length;

                        monthlyAverages.forEach(monthData => {
                            totalGeneratedCost += monthData.average_cost;
                            totalForecastedCost += monthData.average_cost; // Assuming forecasted is same as generated for simplicity
                        });

                        // Calculate the average generated and forecasted costs for the year
                        const generatedAvgCost = totalGeneratedCost / numMonths;
                        const forecastedAvgCost = totalForecastedCost / numMonths;

                        // Store the labels (years)
                        yearly_labels.push(year);

                        // Store the generated and forecasted costs
                        yearly_generated.push(generatedAvgCost);
                        yearly_forecasted.push(forecastedAvgCost);
                    }
                });

                // Now update the yearly dataset in predictrevenueDataSets
                predictrevenueDataSets.yearly.labels = yearly_labels;  // Update labels (years)
                predictrevenueDataSets.yearly.generated = yearly_generated;  // Update generated data
                  // Update forecasted data

                // Optionally, you can log the updated dataset
                console.log(predictrevenueDataSets);

               
            },
            error: function(xhr, status, error) {
                // Reset button state on error
                button.textContent = originalText;
                button.disabled = false;
                console.error('Error:', error);
                alert('An error occurred while generating the analysis.');
            }
        });
    }
    $('#predictPeriodSelector').change(function() {
        var selectedPeriod = $(this).val();
        renderPredictChart(selectedPeriod);
    });
    const predictrevenueDataSets = {
            monthly: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                generated: [10, 8, 12, 15, 18, 16, 20, 17, 14, 16, 12, 15],
                forecasted: [null, null, null, null, 18, 20, 22, 19, 16, 18, 15, 17],
                max: 25
            },
            yearly: {
                labels: ['2020', '2021', '2022', '2023', '2024', '2025'],
                generated: [120, 145, 168, 190, 153, null],
                forecasted: [null, null, null, null, null, null],
                max: 200
            },
            seasonal: {
                labels: ['Spring', 'Summer', 'Fall', 'Winter'],
                generated: [45, 55, 32, 21],
                forecasted: [48, 52, 28, 18],
                max: 60
            }
        };
       function updatePredictRevenueChart(period) {
        const data = predictrevenueDataSets[period];
        predictrevenueChart.data.labels = data.labels;
        predictrevenueChart.data.datasets[0].data = data.generated;
        predictrevenueChart.data.datasets[1].data = data.forecasted;
        predictrevenueChart.options.scales.y.max = data.max;

        // Update step size based on period
        if (period === 'yearly') {
            predictrevenueChart.options.scales.y.ticks.stepSize = 50;
        } else if (period === 'seasonal') {
            predictrevenueChart.options.scales.y.ticks.stepSize = 10;
        } else {
            predictrevenueChart.options.scales.y.ticks.stepSize = 10;
        }

        predictrevenueChart.update();
    }

    var predictrevenueChart = null;
    function predictRevChart(historicalData,predictedData){
    
        const predictedrevenueCtx = document.getElementById('predictedRevenueChart').getContext('2d');
        predictrevenueChart = new Chart(predictedrevenueCtx, {
            type: 'line',
            data: {
                labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
                datasets: [{
                    label: 'Historical',
                    data: historicalData,
                    borderColor: '#223274',
                    backgroundColor: '#223274',
                    fill: false,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#223274',
                    pointHoverRadius: 8
                }, {
                    label: 'Predicted',
                    data: predictedData,
                    borderColor: '#6CBD0E',
                    backgroundColor: '#6CBD0E',
                    fill: false,
                    borderWidth: 3,
                    borderDash: [8, 5],
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#6CBD0E',
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'start',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        labels: {
                            font: {
                                size: 14,
                                family: "Rajdhani-Medium"
                            },
                            boxWidth: 20,
                            padding: 15
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'white',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#bbb7b7',
                        borderWidth: 1,
                        cornerRadius: 4,
                        displayColors: true,
                        usePointStyle: true,
                        boxWidth: 10,
                        boxHeight: 10,
                        boxPadding: 5,
                        titleFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodyFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodySpacing: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: "Rajdhani-Medium",
                                size: 12
                            },
                            color: '#4A5568'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: Math.max(...historicalData).toFixed(0),
                            font: {
                                family: 'Rajdhani-Medium',
                                size: 12
                            },
                            callback: function(value) {
                                return value / 1000 + 'k';
                            },
                            padding: 15
                        },
                        border: {
                            display: false
                        }
                    }
                },
            },
            plugins: [crosshairLine]
        });

    }
    function predictJobCost(predictJobCost,historicalJobCost){
        const predictjobCostCtx = document.getElementById('PredictedJobCostChart').getContext('2d');
        const predictjobCostChart = new Chart(predictjobCostCtx, {
            type: 'line',
            data: {
                labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
                datasets: [{
                    label: 'Historical',
                    data: historicalJobCost,
                    borderColor: '#223274',
                    backgroundColor: '#223274',
                    fill: false,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#223274',
                    pointHoverRadius: 8
                }, {
                    label: 'Predicted',
                    data: predictJobCost,
                    borderColor: '#6CBD0E',
                    backgroundColor: '#6CBD0E',
                    fill: false,
                    borderWidth: 3,
                    borderDash: [8, 5],
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#6CBD0E',
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'start',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        labels: {
                            font: {
                                size: 14,
                                family: "Rajdhani-Medium"
                            },
                            boxWidth: 20,
                            padding: 15
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'white',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#bbb7b7',
                        borderWidth: 1,
                        cornerRadius: 4,
                        displayColors: true,
                        usePointStyle: true,
                        boxWidth: 10,
                        boxHeight: 10,
                        boxPadding: 5,
                        titleFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodyFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodySpacing: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: "Rajdhani-Medium",
                                size: 12
                            },
                            color: '#4A5568'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: Math.max(...historicalJobCost).toFixed(0),
                            font: {
                                family: 'Rajdhani-Medium',
                                size: 12
                            },
                            callback: function(value) {
                                return value / 1000 + 'k';
                            },
                            padding: 15
                        },
                        border: {
                            display: false
                        }
                    }
                },
            },
            plugins: [crosshairLine]
        });
    }
    function predictJobMargin(predictJobMargin,historicalMarginAverages){
        const predictjobMarginCtx = document.getElementById('predictedJobMarginChart').getContext('2d');
        const predictjobMarginChart = new Chart(predictjobMarginCtx, {
            type: 'line',
            data: {
                labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Solar Roofing', 'Wood Shakes'],
                datasets: [{
                    label: 'Historical',
                    data: historicalMarginAverages,
                    borderColor: '#223274',
                    backgroundColor: '#223274',
                    fill: false,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#223274',
                    pointHoverRadius: 8
                }, {
                    label: 'Predicted',
                    data: predictJobMargin,
                    borderColor: '#6CBD0E',
                    backgroundColor: '#6CBD0E',
                    fill: false,
                    borderWidth: 3,
                    borderDash: [8, 5],
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: '#6CBD0E',
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'start',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        labels: {
                            font: {
                                size: 14,
                                family: "Rajdhani-Medium"
                            },
                            boxWidth: 20,
                            padding: 15
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'white',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#bbb7b7',
                        borderWidth: 1,
                        cornerRadius: 4,
                        displayColors: true,
                        usePointStyle: true,
                        boxWidth: 10,
                        boxHeight: 10,
                        boxPadding: 5,
                        titleFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodyFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                        bodySpacing: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': $' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: "Rajdhani-Medium",
                                size: 12
                            },
                            color: '#4A5568'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: Math.max(...historicalMarginAverages).toFixed(0),
                            font: {
                                family: 'Rajdhani-Medium',
                                size: 12
                            },
                            callback: function(value) {
                                return value / 1000 + 'k';
                            },
                            padding: 15
                        },
                        border: {
                            display: false
                        }
                    }
                },
            },
            plugins: [crosshairLine]
        });
    }
    function predictStatsChart(labels,estimatedRevenue){

        const predictstatsCtx = document.getElementById('predictedStatsChart').getContext('2d');
        const predictgradient1 = predictstatsCtx.createLinearGradient(0, 0, 0, 400);
        predictgradient1.addColorStop(0, '#223274');
        predictgradient1.addColorStop(1, '#383E52');

        // Statistics Bar Chart
        const statsChart = new Chart(predictstatsCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Projected Revenue',
                    data: estimatedRevenue,
                    backgroundColor: predictgradient1,
                    borderWidth: 0,
                    borderRadius: {
                        topLeft: 8,
                        topRight: 8,
                        bottomLeft: 0,
                        bottomRight: 0
                    },
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Revenue: $' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 21000,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: Math.max(...estimatedRevenue).toFixed(0),
                            callback: function(value) {
                                return (value / 1000) + 'k';
                            },
                            padding: 15
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/aiTools/year_estimation.blade.php ENDPATH**/ ?>