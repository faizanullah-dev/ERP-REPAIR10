<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Advertisement;
use App\MonthlyAdvertisement;
use App\ReferralSource;
use App\YearEstimateMonth;
use App\YearEstimation;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
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
        $model = str_slug('advertisement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $advertisement = Advertisement::where('year', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $years = YearEstimation::get();
                $advertisement = Advertisement::paginate($perPage);
            }

            return view('advertisement.advertisement.index', compact('advertisement', 'years'));
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
        $model = str_slug('advertisement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $yearEstimations = YearEstimation::get();
            $referral_sources = ReferralSource::where('status',1)->get();
            return view('advertisement.advertisement.create', compact('referral_sources', 'yearEstimations'));
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
    public function store(Request $request) {
//      return $request->all();
        extract($request->all());
        $model = str_slug('advertisement', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $requestData = $request->all();
        $existingAdvertisement = Advertisement::where('year', $year)->where('month', $month)->first();

            if ($existingAdvertisement) {
                $existingAdvertisement->monthly_budget += $monthly_budget;
                $existingAdvertisement->save();
                $advertisement = $existingAdvertisement;
            } else {
                $advertisement = Advertisement::create([
                    'year' => $year,
                    'month' => $month,
                    'monthly_budget' => $monthly_budget,
                ]);
            }
        if (!empty($referral_source['id'])) {
                foreach ($referral_source['id'] as $index => $id) {
                    $existingMonthlyAdvertisement = MonthlyAdvertisement::where('advertisement_id', $advertisement->id)
                        ->where('referral_source_id', $id)
                        ->first();

                    if ($existingMonthlyAdvertisement) {
                        $existingMonthlyAdvertisement->price += $referral_source['price'][$index];
                        $existingMonthlyAdvertisement->save();
                    } else {
                        MonthlyAdvertisement::create([
                            'advertisement_id' => $advertisement->id,
                            'referral_source_id' => $id,
                            'price' => $referral_source['price'][$index],
                        ]);
                    }
                }
            }
             return redirect('advertisement/advertisement')->with('flash_message', 'Advertisement added!');
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
        $model = str_slug('advertisement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $advertisement = Advertisement::with('monthlyAdvertisement')->findOrFail($id);
            return view('advertisement.advertisement.show', compact('advertisement'));
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
        $model = str_slug('advertisement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $advertisement = Advertisement::with('monthlyAdvertisement')->findOrFail($id);
            $yearEstimations = YearEstimation::get();
            $referral_sources = ReferralSource::where('status',1)->get();
            return view('advertisement.advertisement.edit', compact('advertisement', 'yearEstimations', 'referral_sources'));
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

        $model = str_slug('advertisement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            $advertisement = Advertisement::findOrFail($id);
            $advertisement->update([
                'year' => $requestData['year'],
                'month' => $requestData['month'],
                'monthly_budget' => $requestData['monthly_budget'],
            ]);
//      if(!empty($requestData['referral_source']['id'])){

            MonthlyAdvertisement::where('advertisement_id', $id)->delete();
            if (isset($requestData['referral_source']['id']) && isset($requestData['referral_source']['price'])) {
                foreach ($requestData['referral_source']['id'] as $index => $sourceId) {
                    if (isset($requestData['referral_source']['price'][$index])) {
                        $price = $requestData['referral_source']['price'][$index];
                        MonthlyAdvertisement::create([
                            'advertisement_id'   => $advertisement->id,
                            'referral_source_id' => $sourceId,
                            'price' => $price, // Ensure this is outside the array
                        ]);//ends create
                    }//ends if
                }//ends foreach loop.
            }//ends if

//      }//ends if

            return redirect('advertisement/advertisement')->with('flash_message', 'Advertisement updated!');
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
        $model = str_slug('advertisement','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Advertisement::destroy($id);
            MonthlyAdvertisement::where('advertisement_id', $id)->delete();

            return redirect('advertisement/advertisement')->with('flash_message', 'Advertisement deleted!');
        }
        return response(view('403'), 403);

    }

    public function deleteReferralSource(Request $request){
        extract($request->all());
            $referral = MonthlyAdvertisement::where('id', $referral_id)->delete();
        if($referral){
            return response()->json(['status'=>true,'message'=>'Monthly Advertisement Deleted Successfully']);
        }
    }
}
