<?php

namespace App\Http\Controllers\ChangeOrderAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ChangeOrderAttachment;
use Illuminate\Http\Request;

class ChangeOrderAttachmentController extends Controller
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
        $model = str_slug('changeorderattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $changeorderattachment = ChangeOrderAttachment::where('change_order_id', 'LIKE', "%$keyword%")
                ->orWhere('activity_name', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('rate', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('tax', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $changeorderattachment = ChangeOrderAttachment::paginate($perPage);
            }

            return view('changeOrderAttachment.change-order-attachment.index', compact('changeorderattachment'));
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
        $model = str_slug('changeorderattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('changeOrderAttachment.change-order-attachment.create');
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
        $model = str_slug('changeorderattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ChangeOrderAttachment::create($requestData);
            return redirect('changeOrderAttachment/change-order-attachment')->with('flash_message', 'ChangeOrderAttachment added!');
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
        $model = str_slug('changeorderattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $changeorderattachment = ChangeOrderAttachment::findOrFail($id);
            return view('changeOrderAttachment.change-order-attachment.show', compact('changeorderattachment'));
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
        $model = str_slug('changeorderattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $changeorderattachment = ChangeOrderAttachment::findOrFail($id);
            return view('changeOrderAttachment.change-order-attachment.edit', compact('changeorderattachment'));
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
        $model = str_slug('changeorderattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $changeorderattachment = ChangeOrderAttachment::findOrFail($id);
             $changeorderattachment->update($requestData);

             return redirect('changeOrderAttachment/change-order-attachment')->with('flash_message', 'ChangeOrderAttachment updated!');
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
        $model = str_slug('changeorderattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ChangeOrderAttachment::destroy($id);

            return redirect('changeOrderAttachment/change-order-attachment')->with('flash_message', 'ChangeOrderAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
