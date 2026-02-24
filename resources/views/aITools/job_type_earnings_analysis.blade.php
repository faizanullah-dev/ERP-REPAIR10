@extends('layouts.master')

@push('css')
<style>
    .job_type_earnings_sec .card {
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        padding: 25px;
        border: none;
    }

    .job_type_earnings_sec .bar_chart_container {
        border: 1px solid #DEDEDE;
        border-radius: 8px;
        padding: 15px;
    }

    .job_type_earnings_sec .seasonal-table {
        font-size: 12px;
    }

    .job_type_earnings_sec .seasonal-table th,
    .job_type_earnings_sec .seasonal-table td {
        text-align: center;
        padding: 8px;
    }

    .job_type_earnings_sec .demand-high {
        background-color: #ffcccb;
    }

    .job_type_earnings_sec .demand-medium {
        background-color: #fff2cc;
    }

    .job_type_earnings_sec .demand-low {
        background-color: #d4edda;
    }

    .job_type_earnings_sec .box-title {
        font-size: 22px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .job_type_earnings_sec .box-title span {
        font-size: 16px;
        color: #6c757d;
        font-weight: 400;
    }

    .job_type_earnings_sec .chart-container {
        position: relative;
    }

    .job_type_earnings_sec .heatmap-container {
        overflow-x: auto;
        margin-bottom: 20px;
    }

    .job_type_earnings_sec .heatmap {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .job_type_earnings_sec .heatmap th,
    .job_type_earnings_sec .heatmap td {
        text-align: center;
        padding: 12px 8px;
        border: 1px solid #fff;
        position: relative;
        border-radius: 0px;

    }

    .job_type_earnings_sec .heatmap th {
        font-weight: 400;
        color: #4A4A4A;

    }

    .job_type_earnings_sec .heatmap .row-header {
        text-align: left;
        font-weight: 500;
        background-color: #fff;
        color: #4A4A4A;
        min-width: 80px;

    }

    .job_type_earnings_sec .heatmap-cell {
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .job_type_earnings_sec .heatmap-cell:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .job_type_earnings_sec .legend {
        display: flex;
        gap: 20px;
        align-items: center;
        margin-top: 15px;
        margin-bottom: 20px;
    }

    .job_type_earnings_sec .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #495057;
    }

    .job_type_earnings_sec .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 50%;
    }

    .job_type_earnings_sec .special-cell {
        background-color: #dc3525;
        color: white;
        font-weight: bold;
        font-size: 14px;
    }


    .job_type_earnings_sec .tooltip {
        position: absolute;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 11px;
        pointer-events: none;
        z-index: 1000;
        white-space: nowrap;
    }

    .job_type_earnings_sec .table {
        margin-bottom: 0;
    }

    .job_type_earnings_sec .table th {
        background-color: #F4FAEC;
        color: #1A1A1A;
        border: none;
    }

    .job_type_earnings_sec {
        padding: 0px 10px;
    }
</style>
@endpush

@section('content')
<section class="job_type_earnings_sec">
    <div class="container-fluid">
        <div class="row">
            <!-- Projected Revenue Chart -->
            <div class="col-md-12">
                <div class="card">
                    <h3 class="box-title">Projected Revenue by Job Type</h3>
                    <div class="chart-container bar_chart_container" style="height: 600px;">
                        <canvas id="projectedRevenueChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Average Earnings Chart -->
            <div class="col-md-12">
                <div class="card">
                    <h3 class="box-title">Average Earnings per Job Type <span>(Historical Data)</span></h3>
                    <div class="chart-container bar_chart_container" style="height: 600px;">
                        <canvas id="averageEarningsChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Most Profitable Job Type Chart -->
            <div class="col-md-12">
                <div class="card">
                    <h3 class="box-title">Most Profitable Job Type</h3>
                    <div class="chart-container" >
                        <canvas id="profitableJobChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Seasonal Demand Table -->
            <div class="col-md-12">
                <div class="card">
                    <h3 class="box-title">Seasonal Demand <span>(Based on Won Leads)</span></h3>
                    <div class="bar_chart_container">
                        <div class="legend">
                            <div class="legend-item">
                                <div class="legend-color demand-high"></div>
                                <span>High</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color demand-medium"></div>
                                <span>Medium</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color demand-low"></div>
                                <span>Low</span>
                            </div>
                        </div>
                        <div class="heatmap-container">
                            <table class="heatmap" id="seasonalHeatmap"></table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Lead Conversion Rates Chart -->
            <div class="col-md-12">
                <div class="card">
                    <h3 class="box-title">Lead Conversion Rates</h3>
                    <div class="chart-container bar_chart_container" style="height: 600px;">
                        <canvas id="conversionRatesChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Job Type Prioritization Table -->
            <div class="col-md-12">
                <div class="card">
                    <h3 class="box-title">Job Type Prioritization Recommendations</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Job Type</th>
                                    <th>Peak Season</th>
                                    <th>Low Season</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $filteredRecommendations = array_filter($forecastData['recommendations'], function($item) {
                                    return !isset($item['warning']);
                                });
                                
                                uasort($filteredRecommendations, function($a, $b) {
                                    return ($b['total_leads'] ?? 0) <=> ($a['total_leads'] ?? 0);
                                });
                            @endphp

                            @foreach($filteredRecommendations as $category => $recommendation)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $category }}</td>
                                    <td>{{ $recommendation['peak_season'] ?? 'N/A' }}</td>
                                    <td>{{ $recommendation['low_season'] ?? 'N/A' }}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Register the datalabels plugin
        Chart.register(ChartDataLabels);

        // Chart.js default configuration
        Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
        Chart.defaults.font.size = 12;
        Chart.defaults.color = '#6c757d';

        // Projected Revenue by Job Type Chart
        const projectedRevenueCtx = document.getElementById('projectedRevenueChart').getContext('2d');
        const forecasts = @json($forecastData['forecasts']);

        const categoryTotals = {};

            Object.values(forecasts).forEach(yearData => {
            Object.values(yearData).forEach(monthData => {
            Object.entries(monthData).forEach(([category, data]) => {
                if (!categoryTotals[category]) {
                    categoryTotals[category] = 0;
                }
                // Add the predicted total for this category in this month
                categoryTotals[category] += data[0].predicted_total;
            });
        });
    });

    // Extract labels and data for the chart
    const labelss = Object.keys(categoryTotals);
    const data = Object.values(categoryTotals);


        const gradient1 = projectedRevenueCtx.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, '#223274');
        gradient1.addColorStop(1, '#383E52');
        new Chart(projectedRevenueCtx, {
            type: 'bar',
            data: {
                labels: labelss,
                datasets: [{
                    label: 'Projected Revenue',
                    data: data,
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
                                return 'Revenue: $' + context.parsed.y.toLocaleString();
                            }
                        }
                    },
                    datalabels: {
                        display: false
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
                            stepSize: 30000,
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
                    maxRotation: 25, // Rotate labels to prevent overlap
                    minRotation: 25,
                    padding: 5
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

        // Average Earnings per Job Type Chart
        const averageEarningsCtx = document.getElementById('averageEarningsChart').getContext('2d');
        const historicalData = @json($allData);
        const categoryStats = {};

        Object.values(historicalData).forEach(yearData => {
    Object.values(yearData).forEach(monthData => {
        Object.entries(monthData).forEach(([category, entries]) => {
            if (!categoryStats[category]) {
                categoryStats[category] = { total: 0, count: 0 };
            }
            
            // Calculate total for this category in this month
            const monthlyTotal = entries.reduce((sum, entry) => sum + (entry.total || 0), 0);
            
            // Only count months with actual revenue (total > 0)
            if (monthlyTotal > 0) {
                categoryStats[category].total += monthlyTotal;
                categoryStats[category].count += 1;
            }
        });
    });
});

// Calculate averages for each category
const categoryAverages = {};
Object.entries(categoryStats).forEach(([category, stats]) => {
    categoryAverages[category] = stats.count > 0 ? stats.total / stats.count : 0;
});

// Sort categories by average earnings (descending)
const sortedCategories = Object.entries(categoryAverages)
    .sort(([, avgA], [, avgB]) => avgB - avgA)
    .reduce((obj, [key, value]) => {
        obj[key] = value;
        return obj;
    }, {});

// Extract labels and data for the chart
const labelsOld = Object.keys(sortedCategories);
const dataOld = Object.values(sortedCategories);


        const gradient2 = averageEarningsCtx.createLinearGradient(0, 0, 0, 300);
        gradient2.addColorStop(0, '#74C911');
        gradient2.addColorStop(1, '#5AA800');
        new Chart(averageEarningsCtx, {
            type: 'bar',
            data: {
                labels: labelsOld,
                datasets: [{
                    label: 'Average Earnings',
                    data: dataOld,
                    backgroundColor: gradient2,
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
                                return 'Earnings: $' + context.parsed.y.toLocaleString();
                            }
                        }
                    },
                    datalabels: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 180000,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: 30000,
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
                    maxRotation: 25, // Rotate labels to prevent overlap
                    minRotation: 25,
                    padding: 5
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

        // Most Profitable Job Type Chart (Doughnut)
        const profitableJobCtx = document.getElementById('profitableJobChart').getContext('2d');
        var profitablePercentages = @json($forecastData['profitable_percentages']);
        var labels = Object.keys(profitablePercentages);
        var percentages = labels.map(category => profitablePercentages[category].conversion_rate);
        new Chart(profitableJobCtx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: percentages,
                    backgroundColor: [
                        '#FF9999', // Clay Tiles - Soft coral pink
                        '#87CEEB', // Insulation - Light blue
                        '#FFD700', // Slate Roofing - Golden yellow
                        '#90EE90', // Gutters - Light green
                        '#9370DB' // Solar Roofing - Medium slate blue
                    ],
                    borderWidth: 0,
                    cutout: '50%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        align: 'center',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: {
                                size: 14,
                                weight: '400'
                            },
                            color: '#4A4A4A',
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map((label, i) => {
                                        const dataset = data.datasets[0];
                                        const value = dataset.data[i];
                                        return {
                                            text: `${label}: ${value}%`,
                                            fillStyle: dataset.backgroundColor[i],
                                            strokeStyle: dataset.backgroundColor[i],
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
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    },
                    datalabels: {
                        display: false,
                        // formatter: (value, context) => {
                        //     return value + '%';
                        // },
                        // color: '#1A1A1A',
                        // font: {
                        //     weight: 'bold',
                        //     size: 14
                        // }
                    }
                },
                layout: {
                    padding: {
                        right: 20
                    }
                }
            }
        });

        // Lead Conversion Rates Chart
        const conversionRatesCtx = document.getElementById('conversionRatesChart').getContext('2d');
        var forecast = @json($forecastData['conversion_rates']);
        var conversionLabels = Object.keys(forecast);
        console.log('conversionLabels', conversionLabels);
        var conversionRates = conversionLabels.map(category => forecast[category].conversion_rate);
        console.log('conversionRates', conversionRates);

        const gradient3 = conversionRatesCtx.createLinearGradient(0, 0, 0, 300);
        gradient3.addColorStop(0, '#223274');
        gradient3.addColorStop(1, '#383E52');
        new Chart(conversionRatesCtx, {
            type: 'bar',
            data: {
                labels: conversionLabels,
                datasets: [{
                    label: 'Conversion Rate',
                    data: conversionRates,
                    backgroundColor: gradient3,
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
                                return 'Conversion Rate: ' + context.parsed.y + '%';
                            }
                        }
                    },
                    datalabels: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: '#d0d0d0',
                            borderDash: [8, 8],
                            drawBorder: false,
                            offset: true
                        },
                        ticks: {
                            stepSize: 15,
                            callback: function(value) {
                                return value + '%';
                            },
                            padding: 5
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                ticks: {
                    maxRotation: 25, // Rotate labels to prevent overlap
                    minRotation: 25,
                    padding: 5
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

        // Simplified seasonal demand data
        // Get recommendations data
var recommendations = @json($forecastData['recommendations']);

// Filter out categories with warnings and only keep those with monthly_lead_breakdown
var validCategories = Object.entries(recommendations)
    .filter(([category, data]) => data.monthly_lead_breakdown && !data.warning)
    .reduce((obj, [key, value]) => {
        obj[key] = value;
        return obj;
    }, {});

// Prepare data for heatmap
const seasonalData = {
    jobs: Object.keys(validCategories),
    months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    values: []
};

// Fill values array with lead counts for each category
seasonalData.jobs.forEach(category => {
    const monthlyData = validCategories[category].monthly_lead_breakdown;
    const row = [];
    
    seasonalData.months.forEach(month => {
        // Use the lead count if available, otherwise 0
        row.push(monthlyData[month] || 0);
    });
    
    seasonalData.values.push(row);
});

// Determine demand levels based on percentiles of the data
function calculateDemandLevels(values) {
    // Flatten all values to calculate percentiles
    const allValues = values.flat().filter(val => val > 0);
    
    if (allValues.length === 0) {
        return {
            0: { level: 'none', text: 'No Data' }
        };
    }
    
    // Sort values to calculate percentiles
    const sortedValues = [...allValues].sort((a, b) => a - b);
    const lowThreshold = sortedValues[Math.floor(sortedValues.length * 0.33)];
    const mediumThreshold = sortedValues[Math.floor(sortedValues.length * 0.66)];
    const highThreshold = sortedValues[Math.floor(sortedValues.length * 0.9)];
    
    return {
        0: { level: 'none', text: 'No Data' },
        [lowThreshold]: { level: 'low', text: 'Low' },
        [mediumThreshold]: { level: 'medium', text: 'Medium' },
        [highThreshold]: { level: 'high', text: 'High' }
    };
}

const demandLevels = calculateDemandLevels(seasonalData.values);

// Function to get demand level for a value
function getDemandLevel(value) {
    if (value === 0) return demandLevels[0];
    
    const levels = Object.keys(demandLevels)
        .filter(key => key > 0)
        .map(Number)
        .sort((a, b) => a - b);
    
    for (const level of levels) {
        if (value <= level) {
            return demandLevels[level];
        }
    }
    
    return demandLevels[levels[levels.length - 1]];
}

function createSeasonalHeatmap() {
    const table = document.getElementById('seasonalHeatmap');
    table.innerHTML = ''; // Clear existing content

    // Create header row
    const headerRow = document.createElement('tr');
    headerRow.innerHTML = '<th class="row-header">Category</th>';
    seasonalData.months.forEach(month => {
        headerRow.innerHTML += `<th>${month}</th>`;
    });
    table.appendChild(headerRow);

    // Create data rows
    seasonalData.jobs.forEach((job, jobIndex) => {
        const row = document.createElement('tr');
        row.innerHTML = `<td class="row-header">${job}</td>`;

        seasonalData.values[jobIndex].forEach((value, monthIndex) => {
            const cell = document.createElement('td');
            const demand = getDemandLevel(value);

            cell.className = `heatmap-cell demand-${demand.level}`;
            cell.textContent = value > 0 ? value : '';
            cell.setAttribute('data-job', job);
            cell.setAttribute('data-month', seasonalData.months[monthIndex]);
            cell.setAttribute('data-value', value);

            // Add hover tooltip
            cell.addEventListener('mouseenter', function(e) {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.innerHTML = `
                    <strong>${job}</strong><br>
                    ${seasonalData.months[monthIndex]}: ${demand.text} Demand<br>
                    Leads: ${value}
                `;

                document.body.appendChild(tooltip);

                const rect = cell.getBoundingClientRect();
                tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
                tooltip.style.top = (rect.top - tooltip.offsetHeight - 10) + 'px';

                cell.tooltip = tooltip;
            });

            cell.addEventListener('mouseleave', function() {
                if (cell.tooltip) {
                    document.body.removeChild(cell.tooltip);
                    cell.tooltip = null;
                }
            });

            row.appendChild(cell);
        });

        table.appendChild(row);
    });
}

// Add CSS for the demand levels
const style = document.createElement('style');
style.textContent = `
    .heatmap-cell {
        text-align: center;
        padding: 8px;
        border-radius: 4px;
        font-weight: bold;
        min-width: 40px;
    }
    .demand-none { background-color: #f0f0f0; color: #4A4A4A; }
    .demand-low { background-color: #ffebee; color: #4A4A4A; }
    .demand-medium { background-color: #fff3e0; color: #4A4A4A; }
    .demand-high { background-color: #e8f5e8; color: #4A4A4A; }
    .tooltip {
        position: fixed;
        background: rgba(0,0,0,0.9);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 12px;
        z-index: 1000;
        pointer-events: none;
    }
`;
document.head.appendChild(style);

// Initialize heatmap
createSeasonalHeatmap();
setTimeout(animateHeatmap, 100);
    });
</script>
@endpush