<?php

namespace App\Http\Controllers\CompanyContact;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Category;
use App\CompanyContact;
use Illuminate\Http\Request;

class CompanyContactController extends Controller
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
        $model = str_slug('companycontact','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $companycontact = CompanyContact::where('category_id', 'LIKE', "%$keyword%")
                ->orWhere('company', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('insurance_start', 'LIKE', "%$keyword%")
                ->orWhere('insurance_expire', 'LIKE', "%$keyword%")
                ->orWhere('total_paid', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $companycontact = CompanyContact::paginate($perPage);
            }
            return view('companyContact.company-contact.index', compact('companycontact'));
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
        $model = str_slug('companycontact','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $categories = Category::where('status','1')->get();
            return view('companyContact.company-contact.create',compact('categories'));
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
        $model = str_slug('companycontact','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            CompanyContact::create($requestData);
            return redirect('companyContact/company-contact')->with('flash_message', 'CompanyContact added!');
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
        $model = str_slug('companycontact','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $companycontact = CompanyContact::findOrFail($id);
            return view('companyContact.company-contact.show', compact('companycontact'));
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
        $model = str_slug('companycontact','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $companycontact = CompanyContact::findOrFail($id);
            $categories = Category::where('status','1')->get();
            return view('companyContact.company-contact.edit', compact('companycontact','categories'));
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
        $model = str_slug('companycontact','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
             $requestData = $request->all();
             $companycontact = CompanyContact::findOrFail($id);
             $companycontact->update($requestData);
             return redirect('companyContact/company-contact')->with('flash_message', 'CompanyContact updated!');
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
        $model = str_slug('companycontact','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CompanyContact::destroy($id);

            return redirect('companyContact/company-contact')->with('flash_message', 'CompanyContact deleted!');
        }
        return response(view('403'), 403);

    }
}
