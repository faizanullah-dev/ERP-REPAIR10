<?php

namespace App\Http\Controllers\PhotoAndDocumentAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\PhotoAndDocumentAttachment;
use Illuminate\Http\Request;

class PhotoAndDocumentAttachmentController extends Controller
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
        $model = str_slug('photoanddocumentattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $photoanddocumentattachment = PhotoAndDocumentAttachment::where('document_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $photoanddocumentattachment = PhotoAndDocumentAttachment::paginate($perPage);
            }

            return view('photoAndDocumentAttachment.photo-and-document-attachment.index', compact('photoanddocumentattachment'));
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
        $model = str_slug('photoanddocumentattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('photoAndDocumentAttachment.photo-and-document-attachment.create');
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
        $model = str_slug('photoanddocumentattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            PhotoAndDocumentAttachment::create($requestData);
            return redirect('photoAndDocumentAttachment/photo-and-document-attachment')->with('flash_message', 'PhotoAndDocumentAttachment added!');
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
        $model = str_slug('photoanddocumentattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $photoanddocumentattachment = PhotoAndDocumentAttachment::findOrFail($id);
            return view('photoAndDocumentAttachment.photo-and-document-attachment.show', compact('photoanddocumentattachment'));
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
        $model = str_slug('photoanddocumentattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $photoanddocumentattachment = PhotoAndDocumentAttachment::findOrFail($id);
            return view('photoAndDocumentAttachment.photo-and-document-attachment.edit', compact('photoanddocumentattachment'));
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
        $model = str_slug('photoanddocumentattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $photoanddocumentattachment = PhotoAndDocumentAttachment::findOrFail($id);
             $photoanddocumentattachment->update($requestData);

             return redirect('photoAndDocumentAttachment/photo-and-document-attachment')->with('flash_message', 'PhotoAndDocumentAttachment updated!');
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
        $model = str_slug('photoanddocumentattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            PhotoAndDocumentAttachment::destroy($id);

            return redirect('photoAndDocumentAttachment/photo-and-document-attachment')->with('flash_message', 'PhotoAndDocumentAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
