<?php

namespace App\Http\Controllers\MaterialListing;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Material;
use App\MaterialListing;
use App\Product;
use Illuminate\Http\Request;

class MaterialListingController extends Controller
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
        $model = str_slug('materiallisting','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $materiallisting = MaterialListing::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('material_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $materiallisting = MaterialListing::paginate($perPage);
            }

            return view('materialListing.material-listing.index', compact('materiallisting'));
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
        $model = str_slug('materiallisting','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('materialListing.material-listing.create');
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
        $model = str_slug('materiallisting','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            if($request->material_id == 'other'){
                $material = Product::create([
                    'product_category_id' => $request->product_category_id,
                    'sub_category' => $request->material_name,
                    'price' => $request->material_price,
//                    'status' => "1",
                ]);

                MaterialListing::create([
                    'lead_id' => $request->lead_id,
                    'material_id' => $material->id,
                    'quantity' => $request->quantity,
                    'status' => $request->status,
                ]);
            }else {
                MaterialListing::updateOrCreate(
                    [
                        'lead_id' => $request->lead_id,
                        'material_id' => $request->material_id,
                        'status' => $request->status,
                    ],
                    [
                        'quantity' => $request->quantity,
                        'delivery_date' => $request->material_delivery_date,
                    ]
                );
            }
            return redirect()->back()->with('flash_message', 'MaterialListing added!');
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
        $model = str_slug('materiallisting','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $materiallisting = MaterialListing::findOrFail($id);
            return view('materialListing.material-listing.show', compact('materiallisting'));
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
        $model = str_slug('materiallisting','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $materiallisting = MaterialListing::findOrFail($id);
            return view('materialListing.material-listing.edit', compact('materiallisting'));
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
        $model = str_slug('materiallisting','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $materiallisting = MaterialListing::findOrFail($id);
             $materiallisting->update($requestData);

             return redirect('materialListing/material-listing')->with('flash_message', 'MaterialListing updated!');
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
    public function destroy($id){
        $model = str_slug('materiallisting','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            MaterialListing::destroy($id);
            return redirect('materialListing/material-listing')->with('flash_message', 'MaterialListing deleted!');
        }
        return response(view('403'), 403);
    }
    public function deleteMaterialList(Request $request){
        $deleted = MaterialListing::where('lead_id', $request->lead_id)
            ->where('material_id', $request->material_id)
            ->delete();
        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete.']);
        }
    }

    public function updateMaterialList(Request $request){
        extract($request->all());
            $materialListing = MaterialListing::where('lead_id', $request->lead_id) ->where('material_id', $request->material_id) ->where('status', $request->status) ->first();
            if ($materialListing!=null) {
                if ($request->status == 'delivered') {
                    $materialListing->quantity = $request->value;
                    $materialListing->delivery_date = now()->format('Y-m-d');
                } elseif ($request->status == 'added') {
                    $materialListing->quantity = $request->value;
                    $materialListing->delivery_date = now()->format('Y-m-d');
                } elseif ($request->status == 'leftover') {
                    $materialListing->quantity = $request->value;
                }
                $materialListing->save();
                return response()->json(['success' => true,'status'=>'updated']);
            }else{
                $materialListing = MaterialListing::create(['lead_id'=>$request->lead_id,'material_id'=>$request->material_id,'status'=>$request->status,'quantity'=>$value,'delivery_date'=>now()->format('Y-m-d')]);
                return response()->json(['success' => true,'status'=>'created']);
            }
            return response()->json(['success' => false, 'message' => 'Material not found.','status'=>'error']);

    }

}
