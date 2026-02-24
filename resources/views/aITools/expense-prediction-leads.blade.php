@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="marketing_optimization_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="estimated_cost_chart">
                        <div class="white-box">
                            <h4>Estimated Cost per Lead <span>(Upcoming 12 Months)</span></h4>
                            <div class="estimated_canvas">
                                <canvas id="costChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="white-box">
                        <div class="budget_utilization">
                            <h4>Budget Utilization & Overrun Progress</h4>
                            <div class="progress-container">
                                <div class="progress-item">
                                    <div class="progress-label">Slate Roofing</div>
                                    <div class="progress" role="progressbar" aria-label="Slate Roofing Costs" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-success" style="width: 50%"></div>
                                        <div class="progress-bar progress-info" style="width: 40%"></div>
                                        <div class="progress-bar progress-dark" style="width: 10%"></div>
                                    </div>
                                    <div class="cost-info">
                                        <p>Actual Cost: <span>$12,000</span></p>
                                        <p>Cost Exceeds At:<span> $10,000</span></p>
                                    </div>
                                </div>
                                <div class="progress-item">
                                    <div class="progress-label">Insulation</div>
                                    <div class="progress" role="progressbar" aria-label="Insulation Costs" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-success" style="width: 40%"></div>
                                        <div class="progress-bar progress-info" style="width: 50%"></div>
                                        <div class="progress-bar progress-dark" style="width: 10%"></div>
                                    </div>
                                    <div class="cost-info">
                                        <p>Actual Cost: <span>$12,000</span></p>
                                        <p>Cost Exceeds At:<span> $10,000</span></p>
                                    </div>
                                </div>
                                <div class="progress-item">
                                    <div class="progress-label">Gutters</div>
                                    <div class="progress" role="progressbar" aria-label="Insulation Costs" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-success" style="width: 60%"></div>
                                        <div class="progress-bar progress-info" style="width: 30%"></div>
                                        <div class="progress-bar progress-dark" style="width: 10%"></div>
                                    </div>
                                    <div class="cost-info">
                                        <p>Actual Cost: <span>$12,000</span></p>
                                        <p>Cost Exceeds At:<span> $10,000</span></p>
                                    </div>
                                </div>
                                <div class="progress-item">
                                    <div class="progress-label">Clay Tiles</div>
                                    <div class="progress" role="progressbar" aria-label="Insulation Costs" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-success" style="width: 30%"></div>
                                        <div class="progress-bar progress-info" style="width: 90%"></div>
                                        <div class="progress-bar progress-dark" style="width: 10%"></div>
                                    </div>
                                    <div class="cost-info">
                                        <p>Actual Cost: <span>$12,000</span></p>
                                        <p>Cost Exceeds At:<span> $10,000</span></p>
                                    </div>
                                </div>
                                <div class="progress-item">
                                    <div class="progress-label">Solar Roofing</div>
                                    <div class="progress" role="progressbar" aria-label="Insulation Costs" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-success" style="width: 55%"></div>
                                        <div class="progress-bar progress-info" style="width: 35%"></div>
                                        <div class="progress-bar progress-dark" style="width: 10%"></div>
                                    </div>
                                    <div class="cost-info">
                                        <p>Actual Cost: <span>$12,000</span></p>
                                        <p>Cost Exceeds At:<span> $10,000</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="white-box">
                        <div class="conversion_rates_chart">
                            <h4>Cost Breakdown for Lead Type</h4>
                            <div class="select_cost_breakdown">
                                <select class="form-control select2" id="" name="" >
                                    <option selected disabled>Lead Type</option>
                                    <option>Lead Type 1</option>
                                    <option>Lead Type 2</option>
                                </select>
                            </div>
                            <div class="conversion_doghnut_chart">
                                <canvas id="myDonutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="expense_compansion_chart">
                            <h4>Expense Comparison</h4>
                            <div class="expense_line_chart">
                                <canvas id="expenseChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="marketing_recommendation">
                            <h4>Cost-Saving Recommendations</h4>
                            <div class="recommendation_listing cost_saving_recommendation">
                                <div class="recommendation_listing_cards">
                                    <h6>Roofing</h6>
                                    <p>Consider sourcing materials from a different supplier to save 5%.</p>
                                </div>
                                <div class="recommendation_listing_cards">
                                    <h6>Siding</h6>
                                    <p>Reduce labor hours by optimizing task scheduling.</p>
                                </div>
                                <div class="recommendation_listing_cards">
                                    <h6>Chimney</h6>
                                    <p>Negotiate with subcontractors to reduce overhead expenses.</p>
                                </div>
                                <div class="recommendation_listing_cards">
                                    <h6>Siding</h6>
                                    <p>Reduce labor hours by optimizing task scheduling.</p>
                                </div>
                                <div class="recommendation_listing_cards">
                                    <h6>Roofing</h6>
                                    <p>Consider sourcing materials from a different supplier to save 5%.</p>
                                </div>
                                <div class="recommendation_listing_cards">
                                    <h6>Chimney</h6>
                                    <p>Negotiate with subcontractors to reduce overhead expenses.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
    <script>
        // Wait for the DOM to load before running the script
        window.onload = function() {
            var ctx = document.getElementById('costChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Slate Roofing', 'Insulation', 'Gutters', 'Clay Tiles', 'Clay Tiles', 'Clay Tiles', 'Solar Roofing', 'Solar Roofing', 'Wood Shakes'],
                    datasets: [
                        {
                            label: 'Overhead Costs',
                            data: [62000, 61000, 59000, 62000, 63000, 61000, 62000, 63000, 61000],
                            backgroundColor: '#1A1A1A', // Black
                            borderColor: '#1A1A1A',
                            borderWidth: 0,
                            borderRadius: 8
                        },
                        {
                            label: 'Labor Costs',
                            data: [62000, 64000, 60000, 62000, 66000, 58000, 62000, 66000, 58000],
                            backgroundColor: '#20358F', // Blue
                            borderColor: '#20358F',
                            borderWidth: 0,
                            borderRadius: 8
                        },
                        {
                            label: 'Material Costs',
                            data: [62000, 60000, 58000, 62000, 64000, 60000, 62000, 64000, 60000],
                            backgroundColor: '#93C35C', // Green
                            borderColor: '#93C35C',
                            borderWidth: 0,
                            borderRadius: 8
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
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'Rajdhani-Medium',
                                    size: 12
                                }
                            }
                        },
                        y: {
                            stacked: true,
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
                                    return (value / 1000) + 'k';
                                },

                                padding: 15
                            },
                            border: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'white',
                            titleColor: '#000',
                            bodyColor: '#000',
                            borderColor: '#bbb7b7',
                            borderWidth: 1,
                            cornerRadius: 8,
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
                                label: function(context) {
                                    return context.dataset.label + ': $' + context.parsed.y.toLocaleString();
                                },
                            }
                        },
                        legend: {
                            position: 'top',
                            align: 'start',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    size: 14,
                                    family: "Rajdhani-Medium"
                                },
                                boxWidth: 10,
                                boxHeight: 10,
                            },
                        }
                    },
                }
            });

            //     Pie chart
            var ctx = document.getElementById('myDonutChart').getContext('2d');
            const data = [40, 40, 20];
            const total = 10000; // Assuming total cost is $10,000
            var myDonutChart = new Chart(ctx, {
                type: 'doughnut', // Changed to doughnut chart
                data: {
                    labels: ['Material Cost', 'Labor Cost', 'Overhead'],
                    datasets: [{
                        data: data,
                        backgroundColor: ['#ff9999', '#66b3ff', '#99ff99'],
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
                                            const decimalValue = (total * value / 100).toLocaleString();
                                            return {
                                                text: label + ':' + '                    ' + '$' + decimalValue + '        ' + value + '%',
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

            //     Expense Line Chart
            var ctx = document.getElementById('expenseChart').getContext('2d');

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

            var expenseChart = new Chart(ctx, {
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
    </script>

@endpush
