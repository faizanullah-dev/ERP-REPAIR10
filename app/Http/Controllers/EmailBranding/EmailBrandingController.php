<?php

namespace App\Http\Controllers\EmailBranding;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\EmailBranding;
use Illuminate\Http\Request;

class EmailBrandingController extends Controller
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
        $model = str_slug('emailbranding','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $emailbranding = EmailBranding::where('description', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('designation', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('website', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('logo', 'LIKE', "%$keyword%")
                ->orWhere('logo_position', 'LIKE', "%$keyword%")
                ->orWhere('logo_alignment', 'LIKE', "%$keyword%")
                ->orWhere('logo_background', 'LIKE', "%$keyword%")
                ->orWhere('social_link_one', 'LIKE', "%$keyword%")
                ->orWhere('social_link_two', 'LIKE', "%$keyword%")
                ->orWhere('social_link_three', 'LIKE', "%$keyword%")
                ->orWhere('social_link_four', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $emailbranding = EmailBranding::paginate($perPage);
            }

            return view('emailBranding.email-branding.index', compact('emailbranding'));
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
        $model = str_slug('emailbranding','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('emailBranding.email-branding.create');
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
        $model = str_slug('emailbranding','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            EmailBranding::create($requestData);
            return redirect('emailBranding/email-branding')->with('flash_message', 'EmailBranding added!');
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
        $model = str_slug('emailbranding','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $emailbranding = EmailBranding::findOrFail($id);
            return view('emailBranding.email-branding.show', compact('emailbranding'));
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
        $model = str_slug('emailbranding','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $emailbranding = EmailBranding::findOrFail($id);
            return view('emailBranding.email-branding.edit', compact('emailbranding'));
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
        $model = str_slug('emailbranding','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $emailbranding = EmailBranding::findOrFail($id);
             $emailbranding->update($requestData);

             return redirect('emailBranding/email-branding')->with('flash_message', 'EmailBranding updated!');
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
        $model = str_slug('emailbranding','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            EmailBranding::destroy($id);

            return redirect('emailBranding/email-branding')->with('flash_message', 'EmailBranding deleted!');
        }
        return response(view('403'), 403);

    }

    public function storeEmailBranding(Request $request){
        $requestData = $request->all();
        $path = $this->storeImage('images', $request->logo);
        $email = EmailBranding::first();
        if($request->file('logo')) {
            $requestData['logo'] = $path;
        }
        else{
            $requestData['logo'] = $email->logo;
        }
        EmailBranding::updateOrCreate([
            'id' => $email ? $email->id : null,
        ],
                $requestData
        );

        return redirect()->back()->with('flash_message', 'Email Branding Updated!');
    }
}
