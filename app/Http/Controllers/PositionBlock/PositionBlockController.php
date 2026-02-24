<?php

namespace App\Http\Controllers\PositionBlock;

use App\CalculatorBaseValue;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\PositionBlock;
use App\StaffFinance;
use Illuminate\Http\Request;

class PositionBlockController extends Controller
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
        $model = str_slug('positionblock','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $positionblock = PositionBlock::where('name', 'LIKE', "%$keyword%")
                ->orWhere('insurance_rate', 'LIKE', "%$keyword%")
                ->orWhere('pay_rate_weekly', 'LIKE', "%$keyword%")
                ->orWhere('total_yearly_pay', 'LIKE', "%$keyword%")
                ->orWhere('cost_of_insurance', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $positionblock = PositionBlock::paginate($perPage);
            }

            return view('positionBlock.position-block.index', compact('positionblock'));
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
        $model = str_slug('positionblock','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('positionBlock.position-block.create');
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
    public function store(Request $request)
    {
        $model = str_slug('positionblock','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            PositionBlock::create($requestData);
            return redirect()->back()->with('flash_message', 'PositionBlock added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('positionblock','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $positionblock = PositionBlock::findOrFail($id);
            return view('positionBlock.position-block.show', compact('positionblock'));
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
        $model = str_slug('positionblock','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $positionblock = PositionBlock::findOrFail($id);
            return view('positionBlock.position-block.edit', compact('positionblock'));
        }
        return response(view('403'), 403);
    }

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
        $model = str_slug('positionblock','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $positionblock = PositionBlock::findOrFail($id);
             $positionblock->update($requestData);

             return redirect('positionBlock/position-block')->with('flash_message', 'PositionBlock updated!');
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
        $model = str_slug('positionblock','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            PositionBlock::destroy($id);

            return redirect('positionBlock/position-block')->with('flash_message', 'PositionBlock deleted!');
        }
        return response(view('403'), 403);

    }

    public function updatePositions(Request $request)
    {
        $positions = $request->input('positions');

        foreach ($positions as $id => $data) {
            $position = PositionBlock::find($id);
            if ($position) {
                if($data['state_federal_payment'] != null) {
                    $state_federal_amount = $data['total_yearly_pay'] / floatval($data['state_federal_payment']);
                }
                else{
                    $state_federal_amount = '0';
                }
                $position->insurance_rate = $data['insurance_rate'];
                $position->pay_rate_weekly = $data['pay_rate_weekly'];
                $position->pay_rate_type = $data['pay_rate_type'];
                $position->total_yearly_pay = $data['total_yearly_pay'];
                $position->van = $data['van'];
                $position->aut_insurance = $data['aut_insurance'];
                $position->state_federal_payment = $data['state_federal_payment'];
                $position->state_federal_amount = number_format($state_federal_amount, 2);
                $position->cost_of_insurance = $data['cost_of_insurance'];
                $position->save();
            }
        }

        return redirect()->back()->with('flash_message', 'Benefits Block updated successfully!');
    }

    public function updateSalaryBlock(Request $request)
    {
        $salaryBlock = [
            'hourly' => [
                'pay' => $request->input('hourly_pay'),
                'hours_per_week' => $request->input('hourly_hours'),
                'total_weeks' => $request->input('hourly_weeks'),
                'total_yearly_pay' => $request->input('hourly_total_yearly'),
            ],
            'salary' => [
                'pay' => $request->input('salary_pay'),
                'days_per_week' => $request->input('salary_days'),
                'total_weeks' => $request->input('salary_weeks'),
                'total_yearly_pay' => $request->input('salary_total_yearly'),
            ],
            'commission' => [
                'rate' => $request->input('commission_rate'),
                'sales_target' => $request->input('commission_target'),
                'total_yearly_pay' => $request->input('commission_total_yearly'),
            ],
            'base_commission' => [
                'pay' => $request->input('base_commission_pay'),
                'weekly' => $request->input('base_commission_weekly'),
                'total_weeks' => $request->input('base_commission_weeks'),
                'total_salary' => $request->input('base_commission_salary_total'),
                'rate' => $request->input('base_commission_rate'),
                'sales_target' => $request->input('base_commission_target'),
                'total_commission' => $request->input('base_commission_commission_total'),
                'total_yearly_pay' => $request->input('base_commission_total_yearly'),
            ],
        ];

        CalculatorBaseValue::updateOrCreate(
            ['id' => 1],
            ['salary_block' => json_encode($salaryBlock)]
        );

        return redirect()->back()->with('flash_message', 'Salary block updated successfully.');
    }

//    public function getPositionRecord(Request $request){
//        $position = PositionBlock::where('id', $request->position)->first();
//        return (string) view('staff.staff.ajax.get_position', compact('position'));
//    }
    public function getPositionRecord(Request $request)
    {
        $staffFinance = StaffFinance::where('staff_id', $request->id)->first();
        if ($staffFinance && isset($staffFinance->position_record)) {
            $positionRecord = json_decode($staffFinance->position_record, true);
            if (isset($positionRecord[$request->position])) {
                $position = $positionRecord[$request->position];
            } else {
        $position = PositionBlock::where('id', $request->position)->first();
            }
        } else {
            $position = PositionBlock::where('id', $request->position)->first();
        }
        return view('staff.staff.ajax.get_position', compact('position'));
    }


//    public function getCompensationRecord(Request $request){
//        $type = $request->compensation;
//        $data = CalculatorBaseValue::first();
//        $compensation = json_decode($data->salary_block, true);
//        return (string) view('staff.staff.ajax.get_compensation', [
//            'type' => $type,
//            $type => $compensation[$type] ?? []
//        ]);
//    }
    public function getCompensationRecord(Request $request){
        $type = $request->compensation;
        $staffFinance = StaffFinance::where('staff_id', $request->id)->first();
        if ($staffFinance && $staffFinance->compensation_record) {
            $compensationData = json_decode($staffFinance->compensation_record, true);
            return (string) view('staff.staff.ajax.get_compensation', [
                'type' => $type,
                $type => $compensationData[$type] ?? []
            ]);
        }
        $data = CalculatorBaseValue::first();
        $compensation = json_decode($data->salary_block, true);
        return (string) view('staff.staff.ajax.get_compensation', [
            'type' => $type,
            $type => $compensation[$type] ?? []
        ]);
    }
}
