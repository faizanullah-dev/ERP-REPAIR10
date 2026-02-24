<?php

namespace App\Http\Controllers\CogsMaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\CogsMaterial;
use Illuminate\Http\Request;

class CogsMaterialController extends Controller
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
        $model = str_slug('cogsmaterial','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $cogsmaterial = CogsMaterial::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $cogsmaterial = CogsMaterial::paginate($perPage);
            }

            return view('cogsMaterial.cogs-material.index', compact('cogsmaterial'));
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
        $model = str_slug('cogsmaterial','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('cogsMaterial.cogs-material.create');
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
        $model = str_slug('cogsmaterial','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            $requestData['status'] = true;
            CogsMaterial::create($requestData);
            return redirect('cogsMaterial/cogs-material')->with('flash_message', 'CogsMaterial added!');
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
        $model = str_slug('cogsmaterial','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $cogsmaterial = CogsMaterial::findOrFail($id);
            return view('cogsMaterial.cogs-material.show', compact('cogsmaterial'));
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
        $model = str_slug('cogsmaterial','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $cogsmaterial = CogsMaterial::findOrFail($id);
            return view('cogsMaterial.cogs-material.edit', compact('cogsmaterial'));
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
        $model = str_slug('cogsmaterial','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $cogsmaterial = CogsMaterial::findOrFail($id);
             $cogsmaterial->update($requestData);

             return redirect('cogsMaterial/cogs-material')->with('flash_message', 'CogsMaterial updated!');
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
        $model = str_slug('cogsmaterial','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CogsMaterial::destroy($id);

            return redirect('cogsMaterial/cogs-material')->with('flash_message', 'CogsMaterial deleted!');
        }
        return response(view('403'), 403);

    }

    public function statusChangeCogsMaterial($id = null, $status = null)
    {
        if (CogsMaterial::where('id', $id)->update(['status' => $status])){
            return back()->with('flash_message', 'Status Updated!');
        }else{
            return response(view('403'), 403);
        }//ends else if.
    }//ends function statusChangeCogsMaterial

    public function editCogsMaterialModal(Request $request, $id = null){
        extract($request->all());
        $cogsmaterial = CogsMaterial::findOrFail($id);
        return (string)view('cogsMaterial.cogs-material.edit_cogs_material_modal', compact('cogsmaterial'));
    }

    public function viewCogsModal(Request $request){
        extract($request->all());
        $cogsmaterial = CogsMaterial::findOrFail($id);
        return (string) view('cogsMaterial.cogs-material.ajax.view_cogs_modal', compact('cogsmaterial'));
    }
}
