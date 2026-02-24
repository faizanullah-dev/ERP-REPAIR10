<?php

namespace App\Http\Controllers;

use App\Category;
use App\Lead;
use App\ReferralSource;
use App\User;
use App\YearEstimation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function yearlyReport(){
        $yearestimations = YearEstimation::with('months')->get();
        $responseData = [];
        foreach ($yearestimations as $yearestimation) {
            $expectedGross = isset($yearestimation->estimate_amount, $yearestimation->job_convertion_ratio) && $yearestimation->job_convertion_ratio != 0
                ? $yearestimation->estimate_amount * ($yearestimation->job_convertion_ratio / 100)
                : 0;
            $amount = is_numeric($yearestimation->estimate_amount) ? (float)$yearestimation->estimate_amount : 0;
            $value = is_numeric($yearestimation->estimate_value) && $yearestimation->estimate_value != 0 ? (float)$yearestimation->estimate_value : 0;
            $producedYearly = $value != 0 ? $amount / $value : 0;
            $producedWeekly = $producedYearly && $yearestimation->extra_push != 0 ? $producedYearly / $yearestimation->extra_push : 0;
            $finalProductionEarning = Lead::with('getChangeOrder')
                ->whereYear('lead_status_date', $yearestimation->year)
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->lead_status_date)->format('F');
                });
            $monthlyLeads = [
                "January" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "February" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "March" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "April" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "May" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "June" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "July" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "August" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "September" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "October" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "November" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
                "December" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            ];
            foreach ($finalProductionEarning as $month => $leads) {
                $monthlyLeads[$month] = [
                    'wonLead' => $leads->where('lead_status', 'won')->count(),
                    'actualLeadscount' => $leads->count(),
                    'total' => $leads->where('lead_status', 'won')->sum(function ($lead) {
                            return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
                        }) + $leads->where('lead_status', 'won')->flatMap(function ($lead) {
                            return $lead->getChangeOrder 
                                ? $lead->getChangeOrder->where('status', 'approved') 
                                : collect([]);
                        })->sum(function ($changeOrder) {
                            return is_numeric($changeOrder->total_amount) ? (float)$changeOrder->total_amount : 0;
                        }),
                    'leads' => $leads
                ];
            }
            $finalProductionEarn = 0;
            foreach ($monthlyLeads as $month => $data) {
                $approvedChangeOrdersTotal = 0;

                if (is_iterable($data['leads'])) {
                    foreach ($data['leads'] as $lead) {
                        if ($lead->lead_status == 'won' && $lead->getChangeOrder) {
                            $approvedChangeOrdersTotal += $lead->getChangeOrder->where('status', 'approved')->sum(function ($changeOrder) {
                                return is_numeric($changeOrder->total_amount) ? (float)$changeOrder->total_amount : 0;
                            });
                        }
                    }
                }

                $wonLeadsTotal = collect($data['leads'])->where('lead_status', 'won')->sum(function ($lead) {
                    return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
                }) + $approvedChangeOrdersTotal;

                $finalProductionEarn += $wonLeadsTotal;
            }
            $leadProductedYearly = $finalProductionEarn > 0 && $yearestimation->estimate_value != 0 ? $finalProductionEarn / $yearestimation->estimate_value : 1;
            $leadProductedWeekly = $leadProductedYearly > 0 && $yearestimation->extra_push != 0 ? $leadProductedYearly / $yearestimation->extra_push : 1;
            $ProductionExpectedGross = $finalProductionEarn > 0 && $yearestimation->job_convertion_ratio != 0 ? $finalProductionEarn * ($yearestimation->job_convertion_ratio / 100) : 1;
            // Store data for this specific year estimation
            $responseData[] = [
                'yearEstimation' => $yearestimation,
                'productionMonthlyLeads' => $monthlyLeads,
                'expectedGross' => $expectedGross,
                'producedYearly' => $producedYearly,
                'ProductionExpectedGross' => $ProductionExpectedGross,
                'producedWeekly' => $producedWeekly,
                'leadProductedWeekly' => $leadProductedWeekly,
                'leadProductedYearly' => $leadProductedYearly,
                'finalProductionEarn' => $finalProductionEarn,
                'finalProductionEarning' => $finalProductionEarning
            ];
        }
        return response()->json($responseData);
    }

    public function jobsByCategories(){
        $leadsByYear = Lead::with('category')
        ->whereNotNull('lead_date')
    ->get()
    ->groupBy([
        function ($lead) {
            try {
                return Carbon::parse($lead->lead_date)->format('Y');
            } catch (\Exception $e) {
                return 'unknown_year';
            }
        },
        function ($lead) {
            try {
                return Carbon::parse($lead->lead_date)->format('M');
            } catch (\Exception $e) {
                return 'unknown_month';
            }
        },
        function ($lead) {
            return $lead->category->name ?? 'uncategorized';
        }
    ])
    ->map(function ($year) {
        return $year->map(function ($month) {
            return $month->map(function ($leads) {
                return $leads->pluck('title');
            });
        });
    });

return response()->json($leadsByYear);
    }

    public function leadConversionByCategories(){
        $leadsByYear = Lead::with('category')
        ->whereNotNull('lead_date')
        ->where('lead_status', 'won')
    ->get()
    ->groupBy([
        function ($lead) {
            try {
                return Carbon::parse($lead->lead_date)->format('Y');
            } catch (\Exception $e) {
                return 'unknown_year';
            }
        },
        function ($lead) {
            try {
                return Carbon::parse($lead->lead_date)->format('M');
            } catch (\Exception $e) {
                return 'unknown_month';
            }
        },
        function ($lead) {
            return $lead->category->name ?? 'uncategorized';
        }
    ])
    ->map(function ($year) {
        return $year->map(function ($month) {
            return $month->map(function ($leads) {
                return $leads->pluck('title');
            });
        });
    });

return response()->json($leadsByYear);
    }

    // EARNING ANALYSIS INTELLIGENCE STARTS
    public function earningPerJob(){
        $leadsByYearMonth = Lead::with(['category', 'getChangeOrder'])
            // ->where('lead_status', 'won')
            ->whereNotNull('lead_date')
            ->get()
            ->groupBy([
                function ($lead) {
                    try {
                        return Carbon::createFromFormat('Y-m-d', $lead->lead_date)->format('Y');
                    } catch (\Exception $e) {
                        return 'unknown_year';
                    }
                },
                function ($lead) {
                    try {
                        return Carbon::createFromFormat('Y-m-d', $lead->lead_date)->format('M');
                    } catch (\Exception $e) {
                        return 'unknown_month';
                    }
                },
                function ($lead) {
                    return $lead->category->name ?? 'uncategorized';
                }
            ])
            ->sortKeysDesc()
            ->map(function ($year) {
                return $year->sortKeysDesc()->map(function ($month) {
                    return $month->map(function ($leads) {
                        return $leads->map(function ($lead) {
                            $changeOrdersTotal = $lead->getChangeOrder->sum(function ($changeOrder) {
                                return is_numeric($changeOrder->total_amount) ? (float)$changeOrder->total_amount : 0;
                            });
                            $leadPrice = is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
                            
                            return [
                                'title' => $lead->title,
                                'lead_status' => $lead->lead_status,
                                'lead_price' => $leadPrice,
                                'change_orders' => $changeOrdersTotal,
                                'total' => $leadPrice + $changeOrdersTotal
                            ];
                        });
                    });
                });
            });

        return response()->json($leadsByYearMonth);
    }

    public function earningPerJobWithForecast()
{
    // 1. Get your existing data
    $historicalData = $this->transformForPython($this->earningPerJob()->getData(true));
    
    // 2. Call Python API
    try {
        $response = Http::post('https://leadup-ai.devcustomprojects.com/earning/forecast',
    ['data' => $historicalData]  // Wrap in a 'data' key
);
        $allData = $historicalData;
        if ($response->successful()) {
            $forecastData = $response->json();
            
            return view('aiTools.job_type_earnings_analysis', compact('forecastData', 'allData'));
        }
        
        return response()->json([
            'error' => 'Forecast service error',
            'details' => $response->body()
        ], 500);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Forecast processing failed',
            'details' => $e->getMessage()
        ], 500);
    }
}

protected function transformForPython($laravelData)
{
    $pythonData = [];
    
    foreach ($laravelData as $year => $months) {
        foreach ($months as $month => $categories) {
            foreach ($categories as $category => $entries) {
                $pythonData[$year][$month][$category] = array_map(function ($entry) {
                    return [
                        'total' => $entry['total'] ?? 0,
                        'lead_status' => $entry['lead_status'] ?? 0,
                    ];
                }, $entries);
            }
        }
    }
    
    return $pythonData;
}

// EARNING ANALYSIS INTELLIGENCE ENDS


// MARKETING OPTIMIZATION INTELLIGENCE STARTS
    public function marketingOptimization(){
        $customerLeads = User::select('id', 'name', 'email', 'referral_source_id')
    ->with([
        'customerLeads:id,title,lead_price,lead_status,customer_id', 
        'customerLeads.getChangeOrder:id,lead_id,total_amount',
        'referralSource:id,name',
        'referralSource.monthlyAdvertisement'
    ])
    ->whereHas('roles', function($q) {
        $q->where('name', 'customer');
    })
    ->get();

return response()->json($customerLeads);
    }


    public function marketingAnalysis()
{
    $historicalData = $this->marketingOptimization()->getData();
    
    // 2. Call Python API
    try {
        $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ])->post('https://leadup-ai.devcustomprojects.com/marketing/analytics', [
        'data' => $historicalData
    ]);

        
        if ($response->successful()) {
            $analyticsData = $response->json();
            
            return view('aiTools.marketing-spend-optimization', compact('analyticsData'));
        }
        
        return response()->json([
            'error' => 'Analysis service error',
            'details' => $response->body()
        ], 500);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Analysis processing failed',
            'details' => $e->getMessage()
        ], 500);
    }
}
// MARKETING OPTIMIZATION INTELLIGENCE ENDS


// YEARLY ANALYSIS REPORT STARTS

    public function yearlyReportAnalysis(){
        set_time_limit(300);

        $leads = Lead::with(['getChangeOrder' => function($query) {
                $query->select('lead_id', 'total_amount'); // only select needed columns
            }])
            ->where('lead_status', 'won')
            ->get();

            $totalPrice = $leads->sum(function($lead) {
            $leadPrice = is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
            $changeOrderTotal = $lead->getChangeOrder->sum(function($changeOrder) {
                return is_numeric($changeOrder->total_amount) ? (float)$changeOrder->total_amount : 0;
            });
            
            return $leadPrice + $changeOrderTotal;
        });
        $monthlyTotals = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0
        ];

        foreach ($leads as $lead) {
            // Determine month of lead
            $monthKey = Carbon::parse($lead->lead_date)->format('M'); // e.g. "Jan", "Feb"

            $leadPrice = is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
            $changeOrderTotal = $lead->getChangeOrder->sum(function($changeOrder) {
                return is_numeric($changeOrder->total_amount) ? (float)$changeOrder->total_amount : 0;
            });

            $monthlyTotals[$monthKey] += $leadPrice + $changeOrderTotal;
            $monthlyData = array_values($monthlyTotals);
        }
        $yearlyTotals = [
            2020 => 0,
            2021 => 0,
            2022 => 0,
            2023 => 0,
            2024 => 0,
            2025 => 0
        ];

        foreach ($leads as $lead) {
            // Determine the year of the lead
            $year = Carbon::parse($lead->lead_date)->year;

            // Ensure we only process leads from 2020 to 2025
            if ($year >= 2020 && $year <= 2025) {
                $leadPrice = is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;

                // Sum the total amount from getChangeOrder
                $changeOrderTotal = $lead->getChangeOrder->sum(function($changeOrder) {
                    return is_numeric($changeOrder->total_amount) ? (float)$changeOrder->total_amount : 0;
                });

                // Add the lead price and change order total to the corresponding year
                $yearlyTotals[$year] += $leadPrice + $changeOrderTotal;
            }
        }
        $historicalYearlyData = array_values($yearlyTotals);
        try {
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/predictions/historical');
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_HEADER, true);
             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
             curl_setopt($ch, CURLOPT_TIMEOUT, 300);

             $response = curl_exec($ch);

             if (curl_errno($ch)) {
                 throw new Exception('CURL Error: ' . curl_error($ch));
             }

             $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
             $headers = substr($response, 0, $header_size);
             $file_content = substr($response, $header_size);

             curl_close($ch);

            $decoded_response = json_decode($file_content, true);

            return response()->json(['response_data' => $decoded_response, 'historical_total' => $totalPrice,'historicalData'=>$monthlyData,'historicalYearlyData'=>$historicalYearlyData]);

        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }
    
    public function seasonalPrediction($predictions = null){
        $response = $predictions??json_decode($this->yearlyReportAnalysis()->getContent(), true);
        $decoded_response = $response;
        $data = $decoded_response['response_data']['predictions'];
        $post_data = [
            'predictions' => $data,
            'analysis' => [
                'additionalProp1' => $decoded_response['response_data']['analysis']
            ]
        ];

        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/seasonal-analysis');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'accept: application/json',
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Fixed typo here
            curl_setopt($ch, CURLOPT_HEADER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception('CURL Error: ' . curl_error($ch));
            }

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headers = substr($response, 0, $header_size);
            $file_content = substr($response, $header_size);

            curl_close($ch);

            $decoded_response = json_decode($file_content, true);


            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/historical/seasonal');
            curl_setopt($ch2, CURLOPT_HTTPHEADER, [
                'accept: application/json',
                'Content-Type: application/json'
            ]);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);  // Fixed typo here
            curl_setopt($ch2, CURLOPT_HEADER, true);

            $response2 = curl_exec($ch2);

            if (curl_errno($ch2)) {
                throw new Exception('CURL Error: ' . curl_error($ch2));
            }

            $header_size2 = curl_getinfo($ch2, CURLINFO_HEADER_SIZE);
            $headers2 = substr($response2, 0, $header_size2);
            $file_content2 = substr($response2, $header_size2);

            curl_close($ch2);

            $decoded_response2 = json_decode($file_content2, true);




            return response()->json(['seasonalPrediction' => $decoded_response,'historicalData'=>$decoded_response2]);

    }

    public function categoryPrediction($predictions = null){
        $response = $predictions??json_decode($this->yearlyReportAnalysis()->getContent(), true);
        $decoded_response = $response;
        $data = $decoded_response['response_data']['predictions'];
        $post_data = [
            'predictions' => $data,
            'analysis' => [
                'additionalProp1' => $decoded_response['response_data']['analysis']
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/forecasted-statistics');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Fixed typo here
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('CURL Error: ' . curl_error($ch));
        }

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $header_size);
        $file_content = substr($response, $header_size);

        curl_close($ch);

        $decoded_response = json_decode($file_content, true);

        return response()->json($decoded_response);

    }

    public function jobCostPrediction($predictions = null){
        $response = $predictions??json_decode($this->yearlyReportAnalysis()->getContent(), true);
        $decoded_response = $response;
        $data = $decoded_response['response_data']['predictions'];
        $post_data = [
            'predictions' => $data,
            'analysis' => [
                'additionalProp1' => $decoded_response['response_data']['analysis']
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/job-cost');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Fixed typo here
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('CURL Error: ' . curl_error($ch));
        }

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $header_size);
        $file_content = substr($response, $header_size);

        curl_close($ch);

        $decoded_response = json_decode($file_content, true);

         $ch2 = curl_init();
         curl_setopt($ch2, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/historical/yearly-analytics');
         curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch2, CURLOPT_HEADER, true);
         curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
         curl_setopt($ch2, CURLOPT_TIMEOUT, 300);

         $response2 = curl_exec($ch2);

         if (curl_errno($ch2)) {
             throw new Exception('CURL Error: ' . curl_error($ch2));
         }

         $header_size2 = curl_getinfo($ch2, CURLINFO_HEADER_SIZE);
         $headers = substr($response2, 0, $header_size2);
         $file_content2 = substr($response2, $header_size2);

         curl_close($ch2);
        $historical_response = json_decode($file_content2, true);

        return response()->json(['predicted'=>$decoded_response, 'historical' => $historical_response['yearly_data']]);

    }

    public function jobMarginPrediction(){
        $response = $this->yearlyReportAnalysis();
        $decoded_response = json_decode($response->getContent(), true);
        $data = $decoded_response['response_data']['predictions'];
        $post_data = [
            'predictions' => $data,
            'analysis' => [
                'additionalProp1' => $decoded_response['response_data']['analysis']
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/job-margin');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Fixed typo here
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('CURL Error: ' . curl_error($ch));
        }

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $header_size);
        $file_content = substr($response, $header_size);

        curl_close($ch);

        $decoded_response = json_decode($file_content, true);

         $ch2 = curl_init();
         curl_setopt($ch2, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/historical/yearly-analytics');
         curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch2, CURLOPT_HEADER, true);
         curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
         curl_setopt($ch2, CURLOPT_TIMEOUT, 300);

         $response2 = curl_exec($ch2);

         if (curl_errno($ch2)) {
             throw new Exception('CURL Error: ' . curl_error($ch2));
         }

         $header_size2 = curl_getinfo($ch2, CURLINFO_HEADER_SIZE);
         $headers = substr($response2, 0, $header_size2);
         $file_content2 = substr($response2, $header_size2);

         curl_close($ch2);
        $historical_response = json_decode($file_content2, true);

        return response()->json(['predicted'=>$decoded_response, 'historical' => $historical_response['yearly_data']]);

    }

// YEARLY ANALYSIS REPORT ENDS


// GOAL ANALYSIS REPORT STARTS
public function goalReportAnalysis(Request $request)
    {
        set_time_limit(300);

        try {
            $goalValue = $request->input('enteryourGoal');

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/predictions/custom');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 400);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'accept: application/json',
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['goal' => (float)$goalValue]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Fixed typo here
            curl_setopt($ch, CURLOPT_HEADER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception('CURL Error: ' . curl_error($ch));
            }

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headers = substr($response, 0, $header_size);
            $file_content = substr($response, $header_size);

            curl_close($ch);

            $decoded_response = json_decode($file_content, true);

        $monthlyRevenue = [];
        $months = ["January","February","March","April","May","June","July","August","September","October","November","December",];

        $historicalData = [];
        $projectedRevenue = [];
        $historicalData = $this->yearlyReportAnalysis()->getData()->historicalData;
        $projectedRevenue = $historicalData;
        foreach($decoded_response['predictions'] as $key => $value){
            $value = (array) $value;
            $value = json_encode($value);
            $value = json_decode($value, true);
            if(in_array($value['Month'], $months)){
                $monthlyRevenue[] = $value['Projected Revenue'];
            }else{
                $revenue_generated = $value['Projected Revenue'];
            }
        }
        //Seasonal Analysis
        $seasonalAnalysis = null;
        $seasonalParam ['response_data']['predictions'] = $decoded_response['predictions'];
        $seasonalParam ['response_data']['analysis'] = $decoded_response['analysis'];
        $seasonalAnalysis = $this->seasonalPrediction($seasonalParam)->getData(true);

        $peakSeasons = [];
        $lowSeasons = [];
        if(isset($seasonalAnalysis['seasonalPrediction']['peak_seasons']) && isset($seasonalAnalysis['low_seasons'])){
                foreach ($seasonalAnalysis['peak_seasons'] as $key => $value) {
                    $peakSeasons[] = [
                        'season' => $value['season'],
                        'job_completion' => $value['job_completion']
                    ];
                }

                // Loop through 'low_seasons' and store the data in the $lowSeasons array
                foreach ($seasonalAnalysis['seasonalPrediction']['low_seasons'] as $key => $value) {
                    $lowSeasons[] = [
                        'season' => $value['season'],
                        'job_completion' => $value['job_completion']
                    ];
                }
        }
        //Seasonal Analysis Ends

        //predicted category stats
            $predictedCategoriesStats = null;
            $transformedData = [];
            $categoyParam['response_data']['predictions'] = $decoded_response['predictions'];
            $categoyParam['response_data']['analysis'] = $decoded_response['analysis'];
            $transformedData = $this->categoryPrediction($categoyParam)->getData(true)['forecasted_statistics'];

            foreach ($transformedData as $prediction) {
                $month = $prediction['month'];

                $predictedCategoriesStats[$month] = [];

                // Loop through the category breakdown
                foreach ($prediction['category_breakdown'] as $category) {
                    $estimatedRevenue = $category['jobs'] * 1000; // Replace this with actual revenue calculation logic

                    $predictedCategoriesStats[$month][$category['category']] = [
                        'jobs' => $category['jobs'],
                        'estimated_revenue' => $estimatedRevenue,
                        'reasoning' => $category['reasoning']
                    ];
                }
            }
        //predicted category stats ends

        //predicted job cost
            $predictedJobCost = null;
            $jobCostParam['response_data']['predictions'] = $decoded_response['predictions'];
            $jobCostParam['response_data']['analysis'] = $decoded_response['analysis'];
            $predictedJobCost = $this->jobCostPrediction($jobCostParam)->getData(true);
        //predicted job cost ends

        //predicted job margin
            $predictedJobMargin = null;
            $jobMarginParam['response_data']['predictions'] = $decoded_response['predictions'];
            $jobMarginParam['response_data']['analysis'] = $decoded_response['analysis'];
            $predictedJobMargin = $this->jobMarginPrediction($jobMarginParam)->getData(true);




        //predicted job margin ends

        //predicted referal analysis total leads starts
            if (isset($decoded_response['analysis']->referral_analysis) &&
                isset($decoded_response['analysis']->referral_analysis->top_sources)) {
                $topReferralSources = $decoded_response['analysis']->referral_analysis->top_sources;

            } else {
                $topReferralSources = [];
            }
        //predicted referal analysis total leads ends

        //predicted referal analysis source growth starts
            $topReferralGrowthSources =[];
            if (isset($decoded_response['analysis']->referral_analysis) &&
                isset($decoded_response['analysis']->referral_analysis->growth_data)) {
                $topReferralGrowthSources['growth_data'] = $decoded_response['analysis']->referral_analysis->growth_data;
                foreach($topReferralGrowthSources['growth_data'] as $key => $value){
                    $topReferralGrowthSources['periods'][] = $value[0]->period;
                }
            } else {
                $topReferralGrowthSources['growth_data'] = [];
                $topReferralGrowthSources['periods'] = null;
            }
        //predicted referal analysis source growth ends
            $city_performance = [];

            // if (isset($decoded_response['analysis']['city_performance'])) {
            //     $city_performance = (array)($decoded_response['analysis']['city_performance']);
            // }
            return response(['success' => true,'html'=>(string) view('aiTools.ajax.ai_goal_analysis', compact('monthlyRevenue', 'peakSeasons', 'lowSeasons', 'predictedCategoriesStats', 'predictedJobCost', 'predictedJobMargin', 'topReferralSources', 'topReferralGrowthSources','city_performance')),'monthlyRevenue'=>$monthlyRevenue, 'predictedCategoriesStats'=>$predictedCategoriesStats, 'predictedJobCost'=>$predictedJobCost, 'predictedJobMargin'=>$predictedJobMargin, 'topReferralSources'=>$topReferralSources, 'topReferralGrowthSources'=>$topReferralGrowthSources,'projectedRevenue'=>$projectedRevenue,'peakSeasons'=>$peakSeasons, 'lowSeasons'=>$lowSeasons]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
// GOAL ANALYSIS REPORT ENDS

    public function chat(Request $request)
    {
        $message = $request->input('message');
        $session_id = $request->input('session_id');

        try {
            // Sending the POST request to the Flask API using Http facade
            $response = Http::post('http://127.0.0.1:5000/send-chat', [
                'message' => $message,
                'session_id' => $session_id
            ]);

            // Decode the JSON response from Flask
            $responseData = $response->json();

            // Return the response to the frontend
            return response()->json([
                'success' => true,
                'response' => $responseData['response']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'response' => [
                    'type' => 'error',
                    'content' => 'Error: ' . $e->getMessage()
                ]
            ]);
        }
    }

    public function getRevenueTarget(){
        $currentYear = Carbon::now()->year;

        $yearEstimation = YearEstimation::where('year', $currentYear)->latest()->first();

        $monthlyTargets = $yearEstimation ? $yearEstimation->months : collect();

        $monthlyRevenue = [
            'January' => 0,
            'February' => 0,
            'March' => 0,
            'April' => 0,
            'May' => 0,
            'June' => 0,
            'July' => 0,
            'August' => 0,
            'September' => 0,
            'October' => 0,
            'November' => 0,
            'December' => 0,
        ];

        $leads = Lead::whereYear('lead_date', $currentYear)->get();

        foreach ($leads as $lead) {
            $leadDate = Carbon::parse($lead->lead_date);
            $monthName = $leadDate->format('F');

            $leadPrice = is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
            $leadPrice += $lead->getChangeOrder->sum('total_amount');

            $monthlyRevenue[$monthName] += $leadPrice;
        }

        $revenueVtarget = [];

        foreach ($monthlyTargets as $targetMonth) {
            $monthName = $targetMonth->name;
            $targetAmount = $targetMonth->amount;
            $revenue = $monthlyRevenue[$monthName];

            $revenueVtarget[] = [
                'month' => $monthName,
                'target' => $targetAmount,
                'revenue' => $revenue,
            ];
        }

        return response()->json($revenueVtarget);
    }

    public function getReferralSourceComparison()
    {
        $referralSources = ReferralSource::get();

        $comparisonData = [];

        foreach ($referralSources as $referralSource) {
            $totalInvestment = $referralSource->monthlyAdvertisement->sum('price');

            $totalRevenue = 0;

            foreach ($referralSource->users as $user) {
                foreach ($user->customerLeads as $lead) {
                    $leadRevenue = is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
                    $leadRevenue += $lead->getChangeOrder->sum('total_amount');
                    $totalRevenue += $leadRevenue;
                }
            }

            $comparisonData[] = [
                'referral_source' => $referralSource->name,
                'total_investment' => $totalInvestment,
                'total_revenue' => $totalRevenue,
            ];
        }

        return response()->json($comparisonData);
    }

    public function getLeadStatusComparison()
    {
        $successfulConversionsCount = 0;
        $leadsAtRiskCount = 0;

        $leads = Lead::get();

        foreach ($leads as $lead) {
            if ($lead->lead_status == 'won') {
                $successfulConversionsCount++;
            } else {
                $leadsAtRiskCount++;
            }
        }

        $comparisonData = [
            'successful_conversions' => [
                'label' => 'Successful Conversions',
                'count' => $successfulConversionsCount,
            ],
            'leads_at_risk' => [
                'label' => 'Leads at Risk',
                'count' => $leadsAtRiskCount,
            ],
        ];

        return response()->json($comparisonData);
    }

    public function getTopPerformingJobTypes()
    {
        $currentYear = Carbon::now()->year;

        $monthlyStats = $this->getTopMonthlyStats();

        $yearlyStats = $this->getTopYearlyStats($currentYear);

        $seasonalStats = $this->getTopSeasonalStats();

        return response()->json([
            'monthly_stats' => $monthlyStats,
            'yearly_stats' => $yearlyStats,
            'seasonal_stats' => $seasonalStats,
        ]);
    }

    private function getTopMonthlyStats()
    {
        $monthlyStats = [
            'January' => [],
            'February' => [],
            'March' => [],
            'April' => [],
            'May' => [],
            'June' => [],
            'July' => [],
            'August' => [],
            'September' => [],
            'October' => [],
            'November' => [],
            'December' => [],
        ];

        $categoryStats = DB::table('leads as l')
            ->join('categories as c', 'l.category_id', '=', 'c.id')
            ->leftJoin('change_orders as co', 'co.lead_id', '=', 'l.id')
            ->select(
                'c.name as category',
                DB::raw('MONTH(l.lead_date) as month'),
                DB::raw('SUM(CASE WHEN l.lead_price IS NOT NULL THEN l.lead_price ELSE 0 END) + IFNULL(SUM(co.total_amount), 0) as total_revenue')
            )
            ->whereNotNull('l.lead_date')
            ->groupBy('c.name', DB::raw('MONTH(l.lead_date)'))
            ->get();

        foreach ($categoryStats as $stat) {
            $monthName = Carbon::createFromFormat('m', $stat->month)->format('F');
            if (!isset($monthlyStats[$monthName][$stat->category])) {
                $monthlyStats[$monthName][$stat->category] = 0;
            }
            $monthlyStats[$monthName][$stat->category] += $stat->total_revenue;
        }

        $topMonthlyStats = [];

        foreach ($monthlyStats as $month => $categories) {
            arsort($categories);
            $topCategory = key($categories);
            $topRevenue = reset($categories);

            $topMonthlyStats[] = [
                'month' => $month,
                'category' => $topCategory,
                'total_revenue' => $topRevenue,
            ];
        }

        return $topMonthlyStats;
    }


    private function getTopYearlyStats($currentYear)
    {
        $categoryStats = DB::table('leads as l')
            ->join('categories as c', 'l.category_id', '=', 'c.id')
            ->leftJoin('change_orders as co', 'co.lead_id', '=', 'l.id')
            ->select(DB::raw('YEAR(l.lead_date) as year, c.name as category, SUM(CASE WHEN l.lead_price IS NOT NULL THEN l.lead_price ELSE 0 END) + IFNULL(SUM(co.total_amount), 0) as total_revenue'))
            ->whereBetween(DB::raw('YEAR(l.lead_date)'), [$currentYear - 3, $currentYear])
            ->groupBy(DB::raw('YEAR(l.lead_date), c.name'))
            ->orderBy(DB::raw('YEAR(l.lead_date)'), 'desc')
            ->orderByDesc(DB::raw('total_revenue'))
            ->get();

        $yearlyStats = [];

        foreach ($categoryStats as $stat) {
            if (!isset($yearlyStats[$stat->year])) {
                $yearlyStats[$stat->year] = [
                    'category' => $stat->category,
                    'total_revenue' => $stat->total_revenue,
                ];
            } else {
                if ($stat->total_revenue > $yearlyStats[$stat->year]['total_revenue']) {
                    $yearlyStats[$stat->year] = [
                        'category' => $stat->category,
                        'total_revenue' => $stat->total_revenue,
                    ];
                }
            }
        }

        return $yearlyStats;
    }




    private function getTopSeasonalStats()
    {
        $seasons = [
            'Winter' => [12, 1, 2],
            'Spring' => [3, 4, 5],
            'Summer' => [6, 7, 8],
            'Fall' => [9, 10, 11],
        ];

        $seasonalStats = [];

        foreach ($seasons as $season => $months) {
            $categoryRevenueData = DB::table('leads as l')
                ->join('categories as c', 'l.category_id', '=', 'c.id')
                ->leftJoin('change_orders as co', 'co.lead_id', '=', 'l.id')
                ->select(DB::raw('c.name as category, SUM(CASE WHEN l.lead_price IS NOT NULL THEN l.lead_price ELSE 0 END) + IFNULL(SUM(co.total_amount), 0) as total_revenue'))
                ->whereIn(DB::raw('MONTH(l.lead_date)'), $months)
                ->groupBy('c.name')
                ->orderByDesc(DB::raw('total_revenue'))
                ->get();

            if ($categoryRevenueData->isNotEmpty()) {
                $seasonalStats[$season] = [
                    'category' => $categoryRevenueData[0]->category,
                    'total_revenue' => $categoryRevenueData[0]->total_revenue,
                ];
            } else {
                $seasonalStats[$season] = null;
            }
        }

        return $seasonalStats;
    }


    public function referralPerformance()
    {
        $referralSources = ReferralSource::get();

        $performanceData = [];

        foreach ($referralSources as $referralSource) {
            $users = User::where('referral_source_id', $referralSource->id)->get();

            $leadCount = 0;

            foreach ($users as $user) {
                $leadCount += $user->customerLeads()->count();
            }

            $performanceData[] = [
                'referral_source' => $referralSource->name,
                'lead_count' => $leadCount,
            ];
        }
        usort($performanceData, function ($a, $b) {
            return $b['lead_count'] <=> $a['lead_count'];
        });

        return response()->json($performanceData);
    }

    public function customerChangeOrders()
    {
        $currentYear = Carbon::now()->year;

         $changeOrdersStats = Lead::with(['getChangeOrder' => function ($query) {
            $query->select('lead_id', 'total_amount');
        }])
            ->whereYear(DB::raw('STR_TO_DATE(lead_date, "%Y-%m-%d")'), $currentYear) // Filter leads for current year
            ->get();

        $monthlyChangeOrders = [
            'January' => 0,
            'February' => 0,
            'March' => 0,
            'April' => 0,
            'May' => 0,
            'June' => 0,
            'July' => 0,
            'August' => 0,
            'September' => 0,
            'October' => 0,
            'November' => 0,
            'December' => 0,
        ];

        foreach ($changeOrdersStats as $lead) {
            $leadMonth = Carbon::parse($lead->lead_date)->format('F');
            $totalChangeOrderAmount = $lead->getChangeOrder->sum('total_amount');

            $monthlyChangeOrders[$leadMonth] += $totalChangeOrderAmount;
        }

        return $monthlyChangeOrders;
    }

    public function alertData(){
        $revenueTarget = $this->getRevenueTarget()->getData();
        $referralSourceComparison = $this->getReferralSourceComparison()->getData();
        $leadStatusComparison = $this->getLeadStatusComparison()->getData();
        $referralPerformance = $this->referralPerformance()->getData();
        $jobType = $this->getTopPerformingJobTypes()->getData();

        return response()->json([
            'revenueTarget'=>$revenueTarget,
            'referralSourceComparison'=>$referralSourceComparison,
            'leadStatusComparison'=>$leadStatusComparison,
            'referralPerformance'=>$referralPerformance,
            'jobType'=>$jobType
        ]);
    }


}
