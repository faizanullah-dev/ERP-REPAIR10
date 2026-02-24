
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="marketing_optimization_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="estimated_cost_chart">
                        <div class="white-box">
                            <h4>Monthly Revenue vs. Target <span>(This Year)</span></h4>
                            <div class="estimated_canvas">
                                <div id="loading-state-goal" class="loading-state">
                                    <p>Loading data...</p>
                                </div>
                                <canvas id="monthlyRevenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="estimated_cost_chart">
                        <div class="white-box">
                            <h4>Marketing Spend Efficiency <span>(Historical Data)</span></h4>
                            <div class="estimated_canvas">
                                <div id="loading-state-spend" class="loading-state">
                                    <p>Loading data...</p>
                                </div>
                                <canvas id="marketingEfficiencyChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="conversion_rates_chart">
                            <h4>Leads at Risk vs Successful Conversions <span>(Historical Data)</span></h4>
                            <div class="conversion_doghnut_chart">
                                <div id="loading-state-leads" class="loading-state">
                                    <p>Loading data...</p>
                                </div>
                                <canvas id="myDonutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="expense_compansion_chart">
                            <div class="custom_toggle_charts">
                                <h4>Top-Performing Job Types <span>(Historical Data)</span></h4>
                                <div class="toggle_btns">
                                    <button class="chart-toggle" data-period="monthly">Monthly</button>
                                    <button class="chart-toggle" data-period="yearly">Yearly</button>
                                    <button class="chart-toggle" data-period="seasonal">Seasonal</button>
                                </div>
                            </div>
                            <div class="expense_line_chart">
                                <div id="loading-state-performer" class="loading-state">
                                    <p>Loading data...</p>
                                </div>
                                <canvas id="topPerformingChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="critical_alert">
                            <h4>Critical Alerts</h4>
                            <div class="critical_listing">
                                <div id="loading-state-critical" class="loading-state">
                                    <p>Loading data...</p>
                                </div>
                                <ul id="critical-alerts-list"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="marketing_recommendation">
                            <h4>Best and Worst Marketing Channels <span>(Historical Data)</span></h4>
                            <div class="recommendation_listing cost_saving_recommendation">
                                <div id="loading-state-market" class="loading-state">
                                    <p>Loading data...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="expense_compansion_chart">
                            <h4>Customer Satisfaction Trends <span data->(This Year)</span>
                                <button class="tooltip-btn" title="This shows on the basis of change orders amount made against leads">?</button>
                            </h4>
                            <div class="expense_line_chart">
                                <div id="loading-state-customer" class="loading-state">
                                    <p>Loading data...</p>
                                </div>
                                <canvas id="customerSatisfactionChart"></canvas>
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
    <script>
        // Wait for the DOM to load before running the script
        window.onload = function() {

            // Show loading state initially
            $('#loading-state-goal').show();
            $('#loading-state-spend').show();
            $('#loading-state-leads').show();
            $('#loading-state-performer').show();
            $('#loading-state-customer').show();

            // Initialize chart with empty data
            var ctx1 = document.getElementById("monthlyRevenueChart").getContext('2d');
            var monthlyRevenueChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], // Month labels
                    datasets: [
                        {
                            label: 'Revenue',
                            data: Array(12).fill(0), // Initial data for revenue, will be replaced
                            backgroundColor: '#74C911',
                            borderColor: '#74C911',
                            borderWidth: 1,
                            barThickness: 30,
                            borderRadius: 4
                        },
                        {
                            label: 'Target',
                            data: Array(12).fill(0), // Initial data for target, will be replaced
                            backgroundColor: '#223274',
                            borderColor: '#223274',
                            borderWidth: 1,
                            barThickness: 30,
                            borderRadius: 4
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'left',
                            labels: {
                                font: {
                                    size: 14,
                                    family: "Rajdhani-Medium"
                                },
                                boxWidth: 20,
                                boxHeight: 12,
                                usePointStyle: true,
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#D3D3D3',
                                borderDash: [4, 3],
                                borderColor: 'transparent'
                            },
                            ticks: {
                                stepSize: 30000,
                                min: 0,
                                callback: function(value) {
                                    return value;
                                }
                            }
                        },
                        x: {
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#ffffff',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#ccc',
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
                    },
                }
            });

            $.ajax({
                url: '<?php echo e(url("api/revenue_target")); ?>',
                type: 'GET',
                success: function(response) {
                    $('#loading-state-goal').hide();

                    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    var targetData = [];
                    var revenueData = [];

                    response.forEach(function(item) {
                        var monthIndex = months.indexOf(item.month);

                        if (monthIndex !== -1) {
                            targetData[monthIndex] = item.target;
                            revenueData[monthIndex] = item.revenue;
                        }
                    });

                    monthlyRevenueChart.data.datasets[0].data = revenueData;  // Revenue data
                    monthlyRevenueChart.data.datasets[1].data = targetData;   // Target data

                    monthlyRevenueChart.update();
                },
                error: function() {
                    alert("Error loading referral performance data.");
                }
            });

            // marketing efficiency chart
            var ctx2 = document.getElementById("marketingEfficiencyChart").getContext('2d');
            var marketingEfficiencyChart = new Chart(ctx2, {
                type: 'bar', // Bar chart
                data: {
                    labels: [], // This will be filled with referral sources dynamically
                    datasets: [
                        {
                            label: 'Marketing Spend',
                            data: [], // Empty initial data, will be updated with actual data
                            backgroundColor: '#93C35C',
                            borderColor: '#93C35C',
                            borderWidth: 1,
                            barThickness: 40,
                            borderRadius: 4
                        },
                        {
                            label: 'Revenue Generated',
                            data: [], // Empty initial data, will be updated with actual data
                            backgroundColor: '#20358F',
                            borderColor: '#20358F',
                            borderWidth: 1,
                            barThickness: 40,
                            borderRadius: 4
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'left',
                            labels: {
                                font: {
                                    size: 14,
                                    family: "Rajdhani-Medium"
                                },
                                boxWidth: 20,
                                boxHeight: 12,
                                usePointStyle: true,
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#D3D3D3',
                                borderDash: [4, 3],
                                borderColor: 'transparent'
                            },
                            ticks: {
                                stepSize: 500,
                                min: 0,
                                callback: function(value) {
                                    return value;
                                }
                            }
                        },
                        x: {
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#ffffff',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#ccc',
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
                    },
                }
            });

            // AJAX Request to fetch marketing efficiency data
            $.ajax({
                url: '<?php echo e(url("api/referral_comparison")); ?>',  // Replace with your endpoint URL
                type: 'GET',
                success: function(response) {
                    // Hide loading state when data is fetched
                    $('#loading-state-spend').hide();

                    // Prepare data for chart
                    var referralSources = [];
                    var marketingSpendData = [];
                    var revenueGeneratedData = [];

                    // Loop through the response and populate the chart data
                    response.forEach(function(item) {
                        // Push referral source name to labels array
                        referralSources.push(item.referral_source);

                        // Push the total investment (Marketing Spend) and total revenue
                        marketingSpendData.push(item.total_investment);
                        revenueGeneratedData.push(item.total_revenue);
                    });

                    // Update the chart's datasets
                    marketingEfficiencyChart.data.labels = referralSources; // Update labels (referral sources)
                    marketingEfficiencyChart.data.datasets[0].data = marketingSpendData; // Marketing Spend data
                    marketingEfficiencyChart.data.datasets[1].data = revenueGeneratedData; // Revenue Generated data

                    // Update the chart to reflect new data
                    marketingEfficiencyChart.update();
                },
                error: function() {
                    // Handle any errors (e.g., network failure)
                    alert("Error loading marketing efficiency data.");
                }
            });


            //     Pie chart
            var ctx3 = document.getElementById('myDonutChart').getContext('2d');
            var myDonutChart = new Chart(ctx3, {
                type: 'doughnut', // Doughnut chart
                data: {
                    labels: ['Successful Conversions', 'Leads at Risk'],
                    datasets: [{
                        data: [0, 0], // Initially set data to [0, 0]
                        backgroundColor: ['#99ff99', '#ff9999'],
                        borderWidth: 0,
                        cutout: '50%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 20,
                                font: {
                                    size: 14,
                                    family: "Rajdhani-Medium"
                                },
                                boxWidth: 20,
                                boxHeight: 12,
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        return data.labels.map((label, i) => {
                                            const value = data.datasets[0].data[i];
                                            return {
                                                text: label + ': ' + value + '%',
                                                fillStyle: data.datasets[0].backgroundColor[i],
                                                strokeStyle: data.datasets[0].backgroundColor[i],
                                                lineWidth: 0,
                                                pointStyle: 'circle',
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                    return [];
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: '#ffffff', // White tooltip background
                            titleColor: '#000', // Tooltip title color
                            bodyColor: '#000', // Tooltip body text color
                            borderColor: '#ccc', // Tooltip border color
                            borderWidth: 1, // Set border width
                            cornerRadius: 4, // Set the border radius for rounded tooltips
                            displayColors: true, // Show the color box next to the label
                            usePointStyle: true, // Use circle pointer instead of square
                            boxWidth: 10,
                            boxHeight: 10,
                            boxPadding: 5, // Space between pointer and text
                            titleFont: {
                                family: 'Rajdhani-Medium',
                                size: 14
                            },
                            bodyFont: {
                                family: 'Rajdhani-Medium',
                                size: 14
                            },
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                                }
                            }
                        },
                        datalabels: {
                            display: true, // Show values inside the chart
                            formatter: (value, context) => {
                                return value + '%'; // Display percentage inside the chart
                            },
                            color: '#000', // Changed to black text color
                            font: {
                                weight: 'bold',
                                size: 14,
                                family: 'Rajdhani-Medium'
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Include the data labels plugin
            });

            // AJAX Request to fetch the referral performance data
            $.ajax({
                url: '<?php echo e(url("api/lead_status_comparison")); ?>',  // Replace with your endpoint URL
                type: 'GET',
                success: function(response) {
                    // Hide loading state when data is fetched
                    $('#loading-state-leads').hide();

                    // Extract successful conversions and leads at risk data
                    var successfulConversionsCount = response.successful_conversions.count;
                    var leadsAtRiskCount = response.leads_at_risk.count;

                    // Calculate total leads
                    var totalLeads = successfulConversionsCount + leadsAtRiskCount;

                    // Calculate percentages
                    var successfulConversionsPercentage = (successfulConversionsCount / totalLeads) * 100;
                    var leadsAtRiskPercentage = (leadsAtRiskCount / totalLeads) * 100;

                    // Update the chart with the new data
                    myDonutChart.data.datasets[0].data = [successfulConversionsPercentage.toFixed(2), leadsAtRiskPercentage.toFixed(2)];
                    myDonutChart.update();
                },
                error: function() {
                    // Handle any errors (e.g., network failure)
                    alert("Error loading marketing efficiency data.");
                }
            });

            //     Customer Satisfaction Trends Chart
            var ctx4 = document.getElementById('customerSatisfactionChart').getContext('2d');

// Custom plugin to draw vertical hover line (crosshair)
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

            var expenseChart1 = new Chart(ctx4, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Customer Satisfaction:',
                        data: [],
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
                            display: false
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
                                    return tooltipItem.dataset.label + ': ' + tooltipItem.raw.toLocaleString();
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
                                stepSize: 20,  // Set step size to 20
                                font: {
                                    family: 'Rajdhani-Medium',
                                    size: 12
                                },
                                callback: function(value) {
                                    return value; // Optional: Add a suffix if required
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

// AJAX Request to fetch customer satisfaction data
            $.ajax({
                url: '<?php echo e("api/satisfaction_amount"); ?>',  // Replace with the actual API endpoint
                type: 'GET',
                success: function(response) {
                    // Hide the loading state once the data is fetched
                    $('#loading-state-customer').hide();

                    // Process the data and update the chart
                    var satisfactionData = [
                        response.January,
                        response.February,
                        response.March,
                        response.April,
                        response.May,
                        response.June,
                        response.July,
                        response.August,
                        response.September,
                        response.October,
                        response.November,
                        response.December
                    ];

                    // Update the chart data
                    expenseChart1.data.datasets[0].data = satisfactionData;
                    expenseChart1.update(); // Update the chart with new data
                },
                error: function() {
                    // Handle errors
                    alert("Error loading customer satisfaction data.");
                }
            });


            // Top-Performing Job Chart

            var ctx5 = document.getElementById('topPerformingChart').getContext('2d');
            var expenseChart = new Chart(ctx5, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Top-Performing Job Type:',
                        data: [],
                        borderColor: '#6CBD0E',
                        backgroundColor: '#6CBD0E',
                        fill: false,
                        borderWidth: 3,
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
                            display: false
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
                            callbacks: {
                                label: function(tooltipItem) {
                                    const category = tooltipItem.dataset.category[tooltipItem.dataIndex]; // Get the category for the specific data point
                                    return category + ': $' + tooltipItem.raw.toLocaleString(); // Show category name and total revenue
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
                                color: '#6CBD0E'
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
                                stepSize: 10000,
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
                }
            });

            $.ajax({
                url: '<?php echo e(url("api/top_performers")); ?>',
                type: 'GET',
                success: function(response) {
                    $('#loading-state-performer').hide();

                    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    var revenueData = [];
                    var categories = [];

                    function handleMonthlyStats() {
                        var monthlyRevenue = Array(12).fill(0);
                        var categoryNames = Array(12).fill('');

                        response.monthly_stats.forEach(function(item) {
                            var monthIndex = months.indexOf(item.month);
                            if (monthIndex !== -1) {
                                monthlyRevenue[monthIndex] = item.total_revenue;
                                categoryNames[monthIndex] = item.category;
                            }
                        });

                        expenseChart.data.labels = months;
                        expenseChart.data.datasets[0].data = monthlyRevenue;
                        expenseChart.data.datasets[0].category = categoryNames;

                        expenseChart.update();
                    }

                    function handleYearlyStats() {
                        var yearlyData = [];
                        var yearlyLabels = Object.keys(response.yearly_stats);
                        var categoryNames = [];

                        yearlyLabels.forEach(function(year) {
                            yearlyData.push(response.yearly_stats[year].total_revenue);
                            categoryNames.push(response.yearly_stats[year].category);
                        });

                        expenseChart.data.labels = yearlyLabels;
                        expenseChart.data.datasets[0].data = yearlyData;
                        expenseChart.data.datasets[0].category = categoryNames;

                        expenseChart.update();
                    }

                    function handleSeasonalStats() {
                        var seasons = ['Spring', 'Summer', 'Fall', 'Winter'];
                        var seasonalData = [];
                        var seasonalLabels = seasons;
                        var categoryNames = [];

                        seasonalLabels.forEach(function(season) {
                            seasonalData.push(response.seasonal_stats[season].total_revenue);
                            categoryNames.push(response.seasonal_stats[season].category);
                        });

                        expenseChart.data.labels = seasonalLabels;
                        expenseChart.data.datasets[0].data = seasonalData;
                        expenseChart.data.datasets[0].category = categoryNames;

                        expenseChart.update();
                    }

                    handleMonthlyStats();

                    const toggleButtons = document.querySelectorAll('.chart-toggle');
                    toggleButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const period = this.getAttribute('data-period');

                            if (period === 'monthly') {
                                handleMonthlyStats();
                            } else if (period === 'yearly') {
                                handleYearlyStats();
                            } else if (period === 'seasonal') {
                                handleSeasonalStats();
                            }
                        });
                    });
                },
                error: function() {
                    alert("Error loading marketing efficiency data.");
                }
            });


        }
    </script>

    <script>
        $(document).ready(function() {
            $('#loading-state-market').show();

            $.ajax({
                url: '<?php echo e(url("api/referral_performance")); ?>',
                type: 'GET',
                success: function(response) {
                    $('#loading-state-market').hide();

                    $('.recommendation_listing').empty();

                    response.forEach(function(item) {
                        var card = `
                    <div class="recommendation_listing_cards">
                        <h6>${item.referral_source}</h6>
                        <p>Leads Generated: <span>${item.lead_count}</span></p>
                    </div>
                `;

                        $('.recommendation_listing').append(card);
                    });
                },
                error: function() {
                    alert("Error loading referral performance data.");
                }
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '<?php echo e(url("http://127.0.0.1:5000/analyze")); ?>',
                method: 'GET',
                success: function(response) {
                    $('#loading-state-critical').hide();
                    var alerts = response.alerts;
                    var $alertsList = $('#critical-alerts-list');

                    $alertsList.empty();

                    alerts.forEach(function(alert) {
                        $alertsList.append('<li>' + alert + '</li>'); // Assuming each alert has a 'message' field
                    });
                },
                error: function(xhr, status, error) {
                    $('#critical-alerts-list').html('<li>Failed to load alerts. Please try again.</li>');
                }
            });
        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/aiTools/dashboard-insights.blade.php ENDPATH**/ ?>