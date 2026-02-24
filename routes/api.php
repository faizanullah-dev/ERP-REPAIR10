<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\TenantController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('yearly_report', [ApiController::class, 'yearlyReport']);
Route::get('lead-analysis', [WebsiteController::class, 'leadAnalysis']);
Route::get('jobs-by-categories', [ApiController::class, 'jobsByCategories']);
Route::get('lead-conversion-by-categories', [ApiController::class, 'leadConversionByCategories']);
Route::get('earning-per-job', [ApiController::class, 'earningPerJob']);
Route::get('earning-with-forecast', [ApiController::class, 'earningPerJobWithForecast']);
Route::get('marketing-optimization', [ApiController::class, 'marketingOptimization']);
Route::get('marketing-analysis-api', [ApiController::class, 'marketingAnalysis']);

//Yearly Report Analysis Response
Route::get('yearly_report_analysis', [ApiController::class, 'yearlyReportAnalysis']);

//Goal Report Analysis Response
Route::post('goal_report_analysis', [ApiController::class, 'goalReportAnalysis']);

Route::get('revenue_target', [ApiController::class, 'getRevenueTarget']);
Route::get('referral_comparison', [ApiController::class, 'getReferralSourceComparison']);
Route::get('lead_status_comparison', [ApiController::class, 'getLeadStatusComparison']);
Route::get('referral_performance', [ApiController::class, 'referralPerformance']);
Route::get('top_performers', [ApiController::class, 'getTopPerformingJobTypes']);
Route::get('satisfaction_amount', [ApiController::class, 'customerChangeOrders']);
Route::get('alert_data', [ApiController::class, 'alertData']);

// Tenant Management Routes (Central/Owner Only)
Route::prefix('tenants')->group(function () {
    Route::get('/', [TenantController::class, 'index']);
    Route::post('/', [TenantController::class, 'store']);
    Route::get('/{id}', [TenantController::class, 'show']);
    Route::put('/{id}', [TenantController::class, 'update']);
});
