<?php

namespace App\Http\Controllers\Holiday;

use App\HolidayDate;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Holiday;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
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
        $model = str_slug('holiday','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $holiday = Holiday::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $holiday = Holiday::paginate($perPage);
                $holidayExists = Holiday::where('user_id', auth()->id())->exists();
            }//ends of if else

            return view('holiday.holiday.index', compact('holiday','holidayExists'));
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
        $model = str_slug('holiday','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('holiday.holiday.create');
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
        $model = str_slug('holiday','-');
        if (auth()->user()->permissions()->where('name','=','add-'.$model)->first() !== null) {
            $requestData = $request->all();
            $userId = Auth::id();
            $name = $requestData['name'];
            $status = $requestData['status'];
            $holiday = Holiday::updateOrCreate(
                ['user_id' => $userId],
                ['name' => $name, 'status' => $status]
            );
            if (isset($requestData['date'])) {
                $datesString = is_array($requestData['date']) ? $requestData['date'][0] : $requestData['date'];
                $datesArray = array_map('trim', explode(',', $datesString));
                HolidayDate::where('holiday_id', $holiday->id)->delete();
                foreach ($datesArray as $date) {
                    $formattedDate = date('Y-m-d', strtotime($date));
                    HolidayDate::create([
                        'holiday_id' => $holiday->id,
                        'date' => $formattedDate,
                    ]);
                }
            }
            return redirect('holiday/holiday')->with('flash_message', 'Holiday added/updated successfully!');
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
        $model = str_slug('holiday','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $holiday = Holiday::with('getHoliday')->findOrFail($id);
            return view('holiday.holiday.show', compact('holiday'));
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
        $model = str_slug('holiday','-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() !== null) {
            $holiday = Holiday::with('getHoliday')->findOrFail($id);
            $selectedDates = $holiday->getHoliday->pluck('date')->filter()->map(function ($date) {
                return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
            })->toArray();
            return view('holiday.holiday.edit', compact('holiday', 'selectedDates'));
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
//        return $request->all();
        $model = str_slug('holiday','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            $userId = Auth::id();
            $holiday = Holiday::updateOrCreate(
                ['user_id' => $userId],
                [
                    'name' => $requestData['name'],
                    'status' => $requestData['status'],
                ]
            );
            if (isset($requestData['date'])) {
                $datesString = is_array($requestData['date']) ? $requestData['date'][0] : $requestData['date'];
                $datesArray = array_map('trim', explode(',', $datesString));

                HolidayDate::where('holiday_id', $holiday->id)->delete();
                foreach ($datesArray as $date) {
                    $trimmedDate = trim($date);
                    if ($trimmedDate !== '') {
                        $formattedDate = date('Y-m-d', strtotime($trimmedDate));
                    } else {
                        $formattedDate = null;
                    }
                    HolidayDate::create([
                        'holiday_id' => $holiday->id,
                        'date' => $formattedDate,
                    ]);
                }
            }

            return redirect('holiday/holiday')->with('flash_message', 'Holiday updated!');
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
    public function destroy($id) {
        $model = str_slug('holiday','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Holiday::destroy($id);

            return redirect('holiday/holiday')->with('flash_message', 'Holiday deleted!');
        }
        return response(view('403'), 403);
    }

    public function viewHolidayModal(Request $request, $id = null){
        extract($request->all());
        $holiday = Holiday::findOrFail($id);
        return view('holiday.holiday.view_holiday_modal', compact('holiday'));
    }
}
