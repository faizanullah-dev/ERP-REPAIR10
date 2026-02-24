<?php

namespace App\Http\Controllers\YearEstimation;

use App\FinanceSheet;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\YearEstimation;
use Illuminate\Http\Request;
use App\YearEstimateMonth;
use Illuminate\Routing\Route;

class YearEstimationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('yearestimation','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 2500;

            if (!empty($keyword)) {
                $yearestimation = YearEstimation::groupBy('year')->where('year', 'LIKE', "%$keyword%")
                ->orWhere('estimate_amount', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")->orderBy('id','DESC')
                ->paginate($perPage);
            } else {
                $yearestimation = YearEstimation::groupBy('year')->orderBy('id','DESC')->paginate($perPage);
                $financeSheet = FinanceSheet::get();
            }//end if.

            return view('yearEstimation.year-estimation.index', compact('yearestimation', 'financeSheet'));
        }//ends if.
        return response(view('403'), 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('yearestimation','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $years = YearEstimation::pluck('year')->toArray();
            return view('yearEstimation.year-estimation.create',compact('years'));
        }//end if
        return response(view('403'), 403);

    }//end

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $model = str_slug('yearestimation','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            // return $month;
            $unique_id = rand(111111,999999);
            $yearEstimation = YearEstimation::create(['year'=>$year,'type'=>$type,'estimate_value'=>$estimate_value,'estimate_amount'=>str_replace('$','',str_replace(',','', $estimate_amount)),'amount_per_job'=>str_replace('$','',str_replace(',','', $amount_per_job)),'job_convertion_ratio'=>$job_convertion_ratio,'extra_push'=>$extra_push,'status'=>0]);
            foreach ($month as $key => $item) {
                extract($item);
                YearEstimateMonth::create(['year_estimation_id'=>$yearEstimation->id,'name'=>$name,'percentage'=>$percentage,'amount'=>str_replace('$','',str_replace(',', '', $amount)),'month_required_leads'=>$month_required_leads,'month_needed_leads'=>$month_needed_leads,'extra_leads'=>$extra_leads,'extra_amount'=>str_replace('$','',str_replace(',', '', $extra_amount)),'unique_id'=>$unique_id]);
            }
            return redirect('yearEstimation/year-estimation')->with('flash_message', 'YearEstimation added!');
        }//end if.
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id){
        $model = str_slug('yearestimation','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $years = YearEstimation::pluck('year')->toArray();
            $yearestimation = YearEstimation::with('months')->findOrFail($id);
//          $yearestimationRealProduction = YearEstimation::with('months')->where('type','Real Production')->where('year',$yearestimation->year)->first();
            $yearestimationRealProduction = Lead::where('lead_status','won')->whereYear('created_at',$yearestimation->year)->sum('lead_price');
            return view('yearEstimation.year-estimation.show', compact('yearestimation','yearestimationRealProduction','years'));
        }//ends if.
        return response(view('403'), 403);
    }

    public function edit($id){
        $model = str_slug('yearestimation','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $yearestimation = YearEstimation::findOrFail($id);
            $years = YearEstimation::pluck('year')->toArray();
            return view('yearEstimation.year-estimation.edit', compact('yearestimation','years'));
        }//end if.
        return response(view('403'), 403);
    }

    public function update(Request $request, $id)
    {
        $model = str_slug('yearestimation','-');
            if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
                $this->validate($request, [
                'year' => 'required',
                'estimate_amount' => 'required'
            ]);
                extract($request->all());
                $unique_id = rand(111111,999999);
                $yearEstimation = YearEstimation::findOrFail($id);
                    YearEstimation::with('months')->whereid($id)->update([
                    'year'                  =>$year,
                    'type'                  =>$type,
                    'estimate_amount'       =>str_replace('$','',str_replace(',','', $estimate_amount)),
                    'amount_per_job'        =>str_replace('$','',str_replace(',','', $amount_per_job)),
                    'job_convertion_ratio'  =>$job_convertion_ratio,
                    'estimate_value'        =>$estimate_value,
                    'extra_push'            =>$extra_push,
                    'status'                =>$yearEstimation->status
                ]);//ends update.
                if (!empty($month)){
                    YearEstimateMonth::where('year_estimation_id',$yearEstimation->id)->delete();
                    foreach ($month as $key => $item) {
                        extract($item);
                        YearEstimateMonth::where('year_estimation_id', $yearEstimation->id)->where('name', $name)->updateOrCreate([
                            'year_estimation_id'=>$yearEstimation->id,
                            'name'=>$name,
                            'percentage'=>$percentage,
                            'amount'=>str_replace('$','',str_replace(',', '', $amount)),
                            'month_required_leads'=>$month_required_leads,
                            'month_needed_leads'=>$month_needed_leads,
                            'extra_leads'=>$extra_leads,
                            'extra_amount'=>str_replace('$','',str_replace(',', '', $extra_amount)),
                            'unique_id'=>$unique_id
                        ]);
                    }//ends foreach.
                }//ends if.
                return redirect('yearEstimation/year-estimation')->with('flash_message', 'YearEstimation updated!');
            }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('yearestimation','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            YearEstimation::destroy($id);
            YearEstimateMonth::whereIn('year_estimation_id',[$id])->delete();
            return redirect('yearEstimation/year-estimation')->with('flash_message', 'YearEstimation deleted!');
        }
        return response(view('403'), 403);

    }

    public function historicalAnalysis(){
        set_time_limit(300);
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/predict/historical');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);

            $response = curl_exec($ch);

            return $response;

            if (curl_errno($ch)) {
                throw new Exception('CURL Error: ' . curl_error($ch));
            }

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headers = substr($response, 0, $header_size);
            $file_content = substr($response, $header_size);

            curl_close($ch);

            // Set mandatory download headers
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="sales_prediction_package.zip"');
            header('Content-Length: ' . strlen($file_content));
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Pragma: no-cache');
            header('Expires: 0');

            // Clear any previous output
            if (ob_get_level()) ob_end_clean();

            echo $file_content;
            exit;

        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }

    public function goalAnalysis(Request $request)
    {
        set_time_limit(300);
        try {
            $goalValue = $request->input('goal');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://leadup.devcustomprojects.online/api/predict/custom');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'accept: application/json',
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['goal' => (float)$goalValue]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Fixed typo here
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception('CURL Error: ' . curl_error($ch));
            }

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headers = substr($response, 0, $header_size);
            $file_content = substr($response, $header_size);

            curl_close($ch);

            // Forward important headers
            foreach (explode("\n", $headers) as $header) {
                if (preg_match('/^(Content-Type|Content-Disposition)/i', $header)) {
                    header(trim($header));
                }
            }

            // Output the file content
            echo $file_content;
            exit;

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
