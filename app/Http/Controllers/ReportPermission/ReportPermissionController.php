<?php

namespace App\Http\Controllers\ReportPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ReportPermission;
use Illuminate\Http\Request;

class ReportPermissionController extends Controller
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
        $model = str_slug('reportpermission','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $reportpermission = ReportPermission::where('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $reportpermission = ReportPermission::paginate($perPage);
            }

            return view('reportPermission.report-permission.index', compact('reportpermission'));
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
        $model = str_slug('reportpermission','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('reportPermission.report-permission.create');
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
        $model = str_slug('reportpermission','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ReportPermission::create($requestData);
            return redirect('reportPermission/report-permission')->with('flash_message', 'ReportPermission added!');
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
        $model = str_slug('reportpermission','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $reportpermission = ReportPermission::findOrFail($id);
            return view('reportPermission.report-permission.show', compact('reportpermission'));
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
        $model = str_slug('reportpermission','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $reportpermission = ReportPermission::findOrFail($id);
            return view('reportPermission.report-permission.edit', compact('reportpermission'));
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
        $model = str_slug('reportpermission','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $reportpermission = ReportPermission::findOrFail($id);
             $reportpermission->update($requestData);

             return redirect('reportPermission/report-permission')->with('flash_message', 'ReportPermission updated!');
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
        $model = str_slug('reportpermission','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ReportPermission::destroy($id);

            return redirect('reportPermission/report-permission')->with('flash_message', 'ReportPermission deleted!');
        }
        return response(view('403'), 403);

    }
}
