@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <section class="marketing_optimization_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="performance_overview_chart">
                        <div class="white-box">
                            <h4>Performance Overview</h4>
                            <div class="performance_canvas">
                                <canvas id="performanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="white-box">
                        <div class="marketing_recommendation">
                            <h4>Marketing Spend Recommendations</h4>
                            <div class="recommendation_listing">
                                @foreach($analyticsData['recommendations'] as $recommendation)
                                <div class="recommendation_listing_cards">
                                    <h6>Recommendation {{$loop->iteration}}</h6>
                                    <p>{{$recommendation}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="white-box">
                        <div class="conversion_rates_chart">
                            <h4>Conversion Rates per Marketing Channel</h4>
                            <div class="conversion_doghnut_chart">
                                <canvas id="myDonutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="marketing_roi_chart">
                            <h4>Marketing Spend vs. ROI per Platform</h4>
                            <div class="marketing_double_bar_chart">
                                <canvas id="doubleBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="white-box">
                        <h4>Marketing Channel Ranking</h4>
                        <div class="table-responsive">
                            <table class="table table-borderless scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class">
                                <thead>
                                <tr>
                                    <th>Platform</th>
                                    <th>CPS ($)</th>
                                    <th>Conversion Rate (%)</th>
                                    <th>Leads Generated</th>
                                    <th>Customer lifetime value ($)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($analyticsData['rankings'] as $ranking)    
                                <tr>
                                    <td>{{$ranking['referral_name']}}</td>
                                    <td>${{ number_format($ranking['cps'] ?? 0, 2) }}</td>
                                    <td>{{$ranking['conversion_rate']}}%</td>
                                    <td>{{$ranking['leads_generated']}}</td>
                                    <td>${{ number_format($ranking['customer_lifetime_value'] ?? 0, 2) }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        // Wait for the DOM to load before running the script
        window.onload = function() {
            var ctx = document.getElementById('performanceChart').getContext('2d');
            var rankings = @json($analyticsData['rankings']);

            // Create the bar chart
            var performanceChart = new Chart(ctx, {
                type: 'bar', // Type of chart
                data: {
                    labels: rankings.map(item => item.referral_name), // Labels for the bars
                    datasets: [{
                        label: 'Leads Generated', // Label for the chart
                        data: rankings.map(item => item.leads_generated), // Data for the bars
                        backgroundColor: '#223274', // Bar color
                        borderColor: '#223274', // Bar border color
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true, // Start the y-axis from zero
                            grid: {
                                color: '#D3D3D3', // Light gray color for grid lines
                                borderDash: [3, 2], // Dashed grid lines
                                borderColor: 'transparent' // Remove the axis border
                            },
                            ticks: {
                                stepSize: 50, // Custom step size
                                callback: function(value) {
                                    return value; // Add 'k' suffix to values
                                }
                            }
                        },
                        x: {
                            grid: {
                                drawOnChartArea: false // Remove gridlines for the x-axis
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#ffffff',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#ccc',
                        titleFont: {
                            family: 'Rajdhani-Medium',
                            size: 14
                        },
                    },
                    plugins: {
                        legend: {
                            display: false // Remove the legend
                        }
                    },
                    elements: {
                        bar: {
                            borderRadius: 4 // Ensure border radius for bars
                        }
                    }
                }
            });

        //     Pie chart
            var ctx = document.getElementById('myDonutChart').getContext('2d');
            var rankings = @json($analyticsData['rankings']);

            var myDonutChart = new Chart(ctx, {
                type: 'doughnut', // Changed to doughnut chart
                data: {
                    labels: rankings.map(item => item.referral_name),
                    datasets: [{
                        data: rankings.map(item => item.conversion_rate),
                        backgroundColor: ['#ff9999', '#66b3ff', '#99ff99', '#ffcc99', '#c2c2f0'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 20,
                                font: {
                                    size: 12,
                                    family: "Rajdhani-Medium"
                                },
                                boxWidth: 20,
                                boxHeight: 12,
                            }
                        },
                        tooltip: {
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
                            color: '#fff', // Text color inside the pie chart
                            font: {
                                weight: 'bold',
                                size: 14
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Include the data labels plugin
            });

        //     Double bar chart
            var ctx = document.getElementById('doubleBarChart').getContext('2d');
            var rankings = @json($analyticsData['rankings']);

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: rankings.map(item => item.referral_name), // Platform labels
                    datasets: [{
                        label: 'Marketing Spend', // First dataset label
                        data: rankings.map(item => item.total_ad_spend), // Data for Marketing Spend
                        backgroundColor: '#20358F', // Blue color for Marketing Spend
                        borderColor: '#20358F',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                        {
                            label: 'Revenue Generated', // Second dataset label
                            data: rankings.map(item => item.total_revenue), // Data for Revenue Generated
                            backgroundColor: '#93C35C', // Green color for Revenue Generated
                            borderColor: '#93C35C',
                            borderWidth: 1
                        }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top', // Position the legend at the top
                            align: 'start', // Align the legend to the left (start)
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
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'white', // Set the tooltip background to white
                            titleColor: '#000', // Tooltip title color
                            bodyColor: '#000', // Tooltip body text color
                            borderColor: '#ccc', // Tooltip border color
                            borderWidth: 1, // Set border width
                            cornerRadius: 4, // Set the border radius for rounded tooltips
                            displayColors: true, // Hide the color box next to the label in tooltip
                            callbacks: {
                                label: function(tooltipItem) {
                                    // Return the value inside the tooltip
                                    return tooltipItem.dataset.label + ': $' + tooltipItem.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Start the y-axis from zero
                            ticks: {
                                stepSize: 30000, // Define steps in the y-axis for better readability
                            }
                        }
                    }
                }
            });

        }
    </script>
@endpush
