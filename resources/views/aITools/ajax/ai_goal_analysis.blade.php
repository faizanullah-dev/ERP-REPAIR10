<div class="col-md-8">
    <div class="card">
        <h3 class="box-title">Predicted Revenue</h3>
        <div class="revenue-tabs">
            <div class="revenue-tab active">Monthly</div>
            <div class="revenue-tab">Yearly</div>
            <div class="revenue-tab">Seasonal</div>
        </div>
        <div class="chart-container chart-frame">
            <canvas id="predictedRevenueChart" ></canvas>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card">
        <h3 class="box-title">Peak Season For Construction</h3>
        <div class="peak-seasons">
            @forelse($peakSeasons as $key => $value)
                <div class="peak-season-item">
                    <div class="season-info">
                        <div class="season-name">{{$value->season}}</div>
                        <div class="season-type">Job Completion: {{$value->job_completion}} Jobs</div>
                    </div>
                    <div class="season-indicator season-high"></div>
                </div>
            @empty
            @endforelse
         
            <div class="peak-season-item">
                <div class="season-info">
                    <div class="season-name">Low Season For Construction</div>
                </div>
            </div>
            @forelse($lowSeasons as $key => $value)
                <div class="peak-season-item">
                    <div class="season-info">
                        <div class="season-name">{{$value->season}}</div>
                        <div class="season-type">Job Completion: {{$value->job_completion}} Jobs</div>
                    </div>
                    <div class="season-indicator season-high"></div>
                </div>
            @empty
            @endforelse
            
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <h3 class="box-title">Predicted Statistics</h3>
        <p style="color: #666; margin-bottom: 0;">Number of estimated revenue jobs completed per category</p>
        <div class="stats-chart-container">
            <canvas id="predictedStatsChart"></canvas>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <h3 class="box-title">Predicted Average Job Cost</h3>
        <div class="small-chart-container" style="position: relative;">
            <canvas id="PredictedJobCostChart"></canvas>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <h3 class="box-title">Predicted Average Job Margin</h3>
        <div class="small-chart-container">
            <canvas id="predictedJobMarginChart"></canvas>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <h3 class="box-title">Referral Sources</h3>
        <div class="row">
            <div class="col-md-6">
                <h6 style="margin-bottom: 15px;">Top Referral Sources</h6>
                <div class="referral-sources-list">
                    <div class="referral-source-item">
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
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h6 style="margin-bottom: 15px;">Referral Sources Growth</h6>
                <div style="margin-bottom: 10px;">
                    <select class="form-control" id="predictPeriodSelector" style="font-size: 12px; padding: 5px;">
                        
                    </select>
                </div>
                <div class="referral-chart-container">
                    <canvas id="predictreferralGrowthChart"></canvas>
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
                <div class="city-item">
                    <span class="city-rank">1</span>
                    <span class="city-name">Windham</span>
                    <div class="city-stats">
                        <span>94</span>
                        <span>11.1%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">2</span>
                    <span class="city-name">Columbia</span>
                    <div class="city-stats">
                        <span>53</span>
                        <span>6.2%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">3</span>
                    <span class="city-name">Colchester</span>
                    <div class="city-stats">
                        <span>48</span>
                        <span>5.7%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">4</span>
                    <span class="city-name">Mansfield</span>
                    <div class="city-stats">
                        <span>45</span>
                        <span>5.3%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">5</span>
                    <span class="city-name">Lebanon</span>
                    <div class="city-stats">
                        <span>42</span>
                        <span>5.0%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">6</span>
                    <span class="city-name">Manchester</span>
                    <div class="city-stats">
                        <span>42</span>
                        <span>5.0%</span>
                    </div>
                </div>
            </div>

            <div class="city-category moderate">
                <h6>Moderate Performance</h6>
                <div class="city-item">
                    <span class="city-rank">1</span>
                    <span class="city-name">Windham</span>
                    <div class="city-stats">
                        <span>94</span>
                        <span>11.1%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">2</span>
                    <span class="city-name">Columbia</span>
                    <div class="city-stats">
                        <span>53</span>
                        <span>6.2%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">3</span>
                    <span class="city-name">Colchester</span>
                    <div class="city-stats">
                        <span>48</span>
                        <span>5.7%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">4</span>
                    <span class="city-name">Mansfield</span>
                    <div class="city-stats">
                        <span>45</span>
                        <span>5.3%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">5</span>
                    <span class="city-name">Lebanon</span>
                    <div class="city-stats">
                        <span>42</span>
                        <span>5.0%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">6</span>
                    <span class="city-name">Manchester</span>
                    <div class="city-stats">
                        <span>42</span>
                        <span>5.0%</span>
                    </div>
                </div>
            </div>

            <div class="city-category not-recommended">
                <h6>Not Recommended for Investment</h6>
                <div class="city-item">
                    <span class="city-rank">1</span>
                    <span class="city-name">Windham</span>
                    <div class="city-stats">
                        <span>94</span>
                        <span>11.1%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">2</span>
                    <span class="city-name">Columbia</span>
                    <div class="city-stats">
                        <span>53</span>
                        <span>6.2%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">3</span>
                    <span class="city-name">Colchester</span>
                    <div class="city-stats">
                        <span>48</span>
                        <span>5.7%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">4</span>
                    <span class="city-name">Mansfield</span>
                    <div class="city-stats">
                        <span>45</span>
                        <span>5.3%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">5</span>
                    <span class="city-name">Lebanon</span>
                    <div class="city-stats">
                        <span>42</span>
                        <span>5.0%</span>
                    </div>
                </div>
                <div class="city-item">
                    <span class="city-rank">6</span>
                    <span class="city-name">Manchester</span>
                    <div class="city-stats">
                        <span>42</span>
                        <span>5.0%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
