<?php

namespace App\Http\Controllers\FolderManagementAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FolderManagementAttachment;
use Illuminate\Http\Request;

class FolderManagementAttachmentController extends Controller
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
        $model = str_slug('foldermanagementattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $foldermanagementattachment = FolderManagementAttachment::where('folder_management_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $foldermanagementattachment = FolderManagementAttachment::paginate($perPage);
            }

            return view('folderManagementAttachment.folder-management-attachment.index', compact('foldermanagementattachment'));
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
        $model = str_slug('foldermanagementattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('folderManagementAttachment.folder-management-attachment.create');
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
        $model = str_slug('foldermanagementattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            FolderManagementAttachment::create($requestData);
            return redirect('folderManagementAttachment/folder-management-attachment')->with('flash_message', 'FolderManagementAttachment added!');
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
        $model = str_slug('foldermanagementattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $foldermanagementattachment = FolderManagementAttachment::findOrFail($id);
            return view('folderManagementAttachment.folder-management-attachment.show', compact('foldermanagementattachment'));
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
        $model = str_slug('foldermanagementattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $foldermanagementattachment = FolderManagementAttachment::findOrFail($id);
            return view('folderManagementAttachment.folder-management-attachment.edit', compact('foldermanagementattachment'));
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
        $model = str_slug('foldermanagementattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $foldermanagementattachment = FolderManagementAttachment::findOrFail($id);
             $foldermanagementattachment->update($requestData);

             return redirect('folderManagementAttachment/folder-management-attachment')->with('flash_message', 'FolderManagementAttachment updated!');
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
        $model = str_slug('foldermanagementattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FolderManagementAttachment::destroy($id);

            return redirect('folderManagementAttachment/folder-management-attachment')->with('flash_message', 'FolderManagementAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
