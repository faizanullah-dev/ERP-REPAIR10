<?php

namespace App\Http\Controllers\CostOfGoodSold;

use App\CogsMaterial;
use App\CostOfGoodSoldSheet;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\CostOfGoodSold;
use App\Notification;
use App\YearEstimation;
use Illuminate\Http\Request;

class CostOfGoodSoldController extends Controller
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
        $model = str_slug('costofgoodsold','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $costofgoodsold = CostOfGoodSold::where('cogs_material_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('unit_qty', 'LIKE', "%$keyword%")
                ->orWhere('qty_price', 'LIKE', "%$keyword%")
                ->orWhere('job_per_hr', 'LIKE', "%$keyword%")
                ->orWhere('total_cost', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $costofgoodsold = CostOfGoodSold::paginate($perPage);
            }
            return view('costOfGoodSold.cost-of-good-sold.index', compact('costofgoodsold'));
        }
        return response(view('403'), 403);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('costofgoodsold','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $cogs_materials = CogsMaterial::where('status',true)->get();
            $yearEstimation = YearEstimation::whereStatus('1')->first();
            return view('costOfGoodSold.cost-of-good-sold.create',compact('cogs_materials', 'yearEstimation'));
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request){
        $model = str_slug('costofgoodsold','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
           extract($request->all());
            if (isset($cogs_material_id) && !empty($cogs_material_id)) {
                $costOfGoodSold = CostOfGoodSold::create([
                    'lead_id' => $lead_id ?? null,
                    'cogs_date' => $cogs_date ?? null,
                ]);
              foreach ($cogs_material_id as $key => $value){
                  CostOfGoodSoldSheet::create([
                      'cost_of_good_sold_id' => $costOfGoodSold->id,
                      'cogs_material_id' => $value,
                      'name'        => $name[$key] ?? null,
                      'description' => $description[$key] ?? null,
                      'unit_qty'    => $unit_qty[$key] ?? null,
                      'qty_price'   => $qty_price[$key] ?? null,
                      'job_per_hr'  => $job_per_hr[$key] ?? null,
                      'total_cost'  => $total_cost[$key] ?? null,
                      'lead_id'     => $lead_id ?? null,
                      'job_per_hr_is_checked' => $show_job_per_hrr[$key] ?? 0,
                  ]);
              }//ends if
            }//ENDS IF
            Notification::create([
                'lead_id' => $lead_id,
                'model' => 'Cost of good sold Create',
                'title' => 'Cost of good sold created for the lead <b>' . @$costOfGoodSold->lead->title . '</b>'. ' by',
                'time' => $costOfGoodSold->created_at,
                'icon'    => 'fa-regular fa-square-plus',
                'user_id' => auth()->user()->id,
            ]);
            return back()->with('flash_message', 'CostOfGoodSold added!');
        }//ends if
        return response(view('403'), 403);
    }//ends store

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('costofgoodsold','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $costofgoodsold = CostOfGoodSold::findOrFail($id);
            return view('costOfGoodSold.cost-of-good-sold.show', compact('costofgoodsold'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('costofgoodsold','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $costofgoodsold = CostOfGoodSold::findOrFail($id);
            $cogs_materials = CogsMaterial::where('status',true)->get();
            return view('costOfGoodSold.cost-of-good-sold.edit', compact('costofgoodsold','cogs_materials'));
        }
        return response(view('403'), 403);
    }//ends edit

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('costofgoodsold','-');
            if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
                extract($request->all());
                $costOfGoodSold = CostOfGoodSold::findOrFail($id);
                $costOfGoodSold->update(['cogs_date' => $cogs_date]);
                CostOfGoodSoldSheet::where('cost_of_good_sold_id', $costOfGoodSold->id)->delete();
                if (isset($cogs_material_id) && !empty($cogs_material_id)){
                    foreach ($cogs_material_id as $key => $value) {
                        CostOfGoodSoldSheet::create([
                            'cost_of_good_sold_id' => $costOfGoodSold->id,
                            'cogs_material_id' => $value,
                            'name'        => $name[$key] ?? null,
                            'description' => $description[$key] ?? null,
                            'unit_qty'    => $unit_qty[$key] ?? null,
                            'qty_price'   => $qty_price[$key] ?? null,
                            'job_per_hr'  => $job_per_hr[$key] ?? null,
                            'total_cost'  => $total_cost[$key] ?? null,
                            'lead_id'     => $lead_id ?? null,
                            'job_per_hr_is_checked' => $show_job_per_hr[$key] ?? 0,
                        ]);//ends create
                    }//ends if
                }//ends if.
                Notification::create([
                    'lead_id' => $costOfGoodSold->lead_id,
                    'model' => 'Cost of good sold Update',
                    'title' => 'Cost of good sold updated for the lead <b>' . @$costOfGoodSold->lead->title . '</b>'. ' by',
                    'time' => $costOfGoodSold->created_at,
                    'icon'    => 'fa-regular fa-square-plus',
                    'user_id' => auth()->user()->id,
                ]);
                return back()->with('flash_message', 'successfully updated!');
        }//ends if.
        return response(view('403'), 403);
    }//ends update
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('costofgoodsold','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CostOfGoodSold::destroy($id);

            return redirect('costOfGoodSold/cost-of-good-sold')->with('flash_message', 'CostOfGoodSold deleted!');
        }
        return response(view('403'), 403);

    }
}
