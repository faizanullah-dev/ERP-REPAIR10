<?php

namespace App\Http\Controllers\FolderManagement;

use App\FolderManagementAttachment;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FolderManagement;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FolderManagementController extends Controller
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
        $model = str_slug('foldermanagement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $foldermanagement = FolderManagement::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $foldermanagement = FolderManagement::paginate($perPage);
            }

            return view('folderManagement.folder-management.index', compact('foldermanagement'));
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
        $model = str_slug('foldermanagement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('folderManagement.folder-management.create');
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
        $model = str_slug('foldermanagement', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            // Validate inputs BEFORE using extract()
            $request->validate([
                'title' => 'required|string|max:255',
                'type' => 'required|string',
                'file' => 'required|mimes:pdf,doc,docx,jpg,png|max:2048' // Allow only valid file types and size
            ]);
            extract($request->all());
            try {
                $folderManagement = FolderManagement::create([
                    'lead_id' => $lead_id,
                    'title' => $title,
                    'type' => $type,
                ]);
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('permits', $fileName, 'website');
                    FolderManagementAttachment::create([
                        'folder_management_id' => $folderManagement->id,
                        'name' => $fileName,
                    ]);
                }
                Notification::create([
                    'lead_id' => $lead_id,
                    'model' => 'Permits Created',
                    'title' => 'Permits created against the lead <b>' . $folderManagement->getLead->title . '</b> name <b>' . $title . '</b> by',
                    'icon' => 'fa fa-file',
                    'time' => $folderManagement->created_at,
                    'user_id' => auth()->user()->id,
                ]);
                return back()->with('flash_message', 'Permits uploaded successfully!');
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'An error occurred: ' . $e->getMessage()
                ], 500);
            }
        }
        return response()->view('403', [], 403);
    }
    public function storeWarranty(Request $request)
    {
        $model = str_slug('foldermanagement', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $request->validate([
                'title' => 'required|string|max:255',
                'type' => 'required|string',
                'file' => 'required|mimes:pdf,doc,docx,jpg,png|max:2048' // Allow only valid file types and size
            ]);
            extract($request->all());
            try {
                $folderManagement = FolderManagement::create([
                    'lead_id' => $lead_id,
                    'title' => $title,
                    'type' => $type,
                ]);
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('warranty', $fileName, 'website');
                    FolderManagementAttachment::create([
                        'folder_management_id' => $folderManagement->id,
                        'name' => $fileName,
                    ]);
                }
                Notification::create([
                    'lead_id' => $lead_id,
                    'model' => 'Warranties Created',
                    'title' => 'Warranties created against the lead <b>' . $folderManagement->getLead->title . '</b> name <b>' . $title . '</b> by',
                    'icon' => 'fa fa-file',
                    'time' => $folderManagement->created_at,
                    'user_id' => auth()->user()->id,
                ]);
                return back()->with('flash_message', 'Warranties uploaded successfully!');
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'An error occurred: ' . $e->getMessage()
                ], 500);
            }
        }
        return response()->view('403', [], 403);
    }

    public function storeProposal(Request $request)
    {
        $model = str_slug('foldermanagement', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $request->validate([
                'title' => 'required|string|max:255',
                'type' => 'required|string',
                'file' => 'required|mimes:pdf,doc,docx,jpg,png|max:2048' // Allow only valid file types and size
            ]);
            extract($request->all());
            try {
                $folderManagement = FolderManagement::create([
                    'lead_id' => $lead_id,
                    'title' => $title,
                    'type' => $type,
                ]);
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('lead_inner_proposal', $fileName, 'website');
                    FolderManagementAttachment::create([
                        'folder_management_id' => $folderManagement->id,
                        'name' => $fileName,
                    ]);
                }
                Notification::create([
                    'lead_id' => $lead_id,
                    'model' => 'Proposal Created',
                    'title' => 'Proposal created against the lead <b>' . $folderManagement->getLead->title . '</b> name <b>' . $title . '</b> by',
                    'icon' => 'fa fa-file',
                    'time' => $folderManagement->created_at,
                    'user_id' => auth()->user()->id,
                ]);
                return back()->with('flash_message', 'Proposal uploaded successfully!');
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'An error occurred: ' . $e->getMessage()
                ], 500);
            }
        }
        return response()->view('403', [], 403);
    }

    public function createFolder(Request $request){
        extract($request->all());
        $parentFolder = $request->input('parent_folder', '');
        $folderName = $request->input('title');
        $parentFolder = 'leadsDocuments';
        $folderPath = "$parentFolder/{$request->title}";
        Storage::disk('website')->makeDirectory($folderPath);
        $folderManagement = FolderManagement::create([
            'lead_id' => $request->input('lead_id'),
            'title' => $folderName,
        ]);
        $lead = $lead_id;
        if($folderManagement != null){
        Notification::create([
            'lead_id' => $lead_id,
            'model' => 'Document folder Create',
            'title' => 'Folder Created for the document name <b>' . $folderName . '</b> in lead <b>' . $folderManagement->getLead->title . '</b> by',
            'icon' => 'fa fa-file',
            'time' => $folderManagement->created_at,
            'user_id' => auth()->user()->id,
        ]);
        }
        return response()->json([
            'folder_path' => $folderPath,
            'folder_id' => $folderManagement->id,
            'folder_name' => $folderManagement->title,
        ]);
    }
    public function uploadFolder(Request $request){
        extract($request->all());
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $folder = $request->input('folder', 'documents');
            $folderId = $request->input('folder_id');
            $folderManagement = FolderManagement::find($folderId);
            if (!$folderManagement) {
                return response()->json(['message' => 'Folder not found'], 404);
            }
            $dynamicFolderPath = 'leadsDocuments/' . $folderManagement->title;
            if (!Storage::disk('website')->exists($dynamicFolderPath)) {
                Storage::disk('website')->makeDirectory($dynamicFolderPath);
            }
            $fileName = $file->getClientOriginalName();
            $file->storeAs($dynamicFolderPath, $fileName, 'website');
            $files = FolderManagementAttachment::create([
                'folder_management_id' => $folderManagement->id,
                'name' => $fileName,
            ]);
            if($files != null){
                Notification::create([
                    'lead_id' => $lead_id,
                    'model' => 'Document files Create',
                    'title' => 'Files added for the document <b>' . $folderManagement->title . '</b> in lead <b>' . $folderManagement->getLead->title . '</b> by',
                    'icon' => 'fa fa-file',
                    'time' => $folderManagement->created_at,
                    'user_id' => auth()->user()->id,
                ]);
            }
            return response()->json([
                'id' => $files->id,
                'file_name' => $fileName,
                'folder_path' => $dynamicFolderPath,

            ]);
        }
        return response()->json(['message' => 'No file uploaded'], 400);
    }

    public function contents(Request $request, $lead_id= null) {
        $folderId = $request->input('folder_id', null);
        $currentFolderPath = 'leadsDocuments/';
        if ($folderId) {
            $currentFolder = FolderManagement::where('lead_id', $lead_id)->find($folderId);
            if (!$currentFolder) {
                return response()->json(['message' => 'Folder not found'], 404);
            }
            $folders = FolderManagement::where('lead_id', $currentFolder->lead_id)->get();
            $files = FolderManagementAttachment::where('folder_management_id', $folderId)->get();
            $currentFolderPath .= $currentFolder->title;
        } else {
            $folders = FolderManagement::where('lead_id', $lead_id)->get();
            $files = collect();
        }
        $folderList = [];
        foreach ($folders as $folder) {
            $folderList[] = [
                'id' => $folder->id,
                'title' => $folder->title,
                'path' => 'leadsDocuments/' . $folder->title
            ];
        }
        $fileList = [];
        foreach ($files as $file) {
            $fileList[] = [
                'title' => $file->name,
            ];
        }

        return response()->json([
            'folders' => $folderList,
            'files' => $fileList,
            'currentFolder' => $currentFolderPath
        ]);
    }
// FileController.php
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id){
        $model = str_slug('foldermanagement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $foldermanagement = FolderManagement::findOrFail($id);
            return view('folderManagement.folder-management.show', compact('foldermanagement'));
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
        $model = str_slug('foldermanagement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $foldermanagement = FolderManagement::findOrFail($id);
            return view('folderManagement.folder-management.edit', compact('foldermanagement'));
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
        $model = str_slug('foldermanagement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $foldermanagement = FolderManagement::findOrFail($id);
             $foldermanagement->update($requestData);

             return redirect('folderManagement/folder-management')->with('flash_message', 'FolderManagement updated!');
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
        $model = str_slug('foldermanagement','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FolderManagement::destroy($id);

            return redirect('folderManagement/folder-management')->with('flash_message', 'FolderManagement deleted!');
        }
        return response(view('403'), 403);

    }

    public function deletePermit(Request $request){
        extract($request->all());
        $permit = FolderManagement::find($permit_id);
        if (!$permit) {
            return response()->json(['status' => false, 'message' => 'Permit not found']);
        }
        if ($permit->delete()) {
            Notification::create([
                'lead_id' => $permit->lead_id,
                'model' => 'Permit Deleted',
                'title' => 'Permit <b>' . $permit->title . '</b> has been deleted for the lead <b>' . $permit->getLead->title . '</b> by',
                'icon'    => 'fa-solid fa-trash',
                'time'    => now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Permit Deleted Successfully']);
        }
    }
    public function deleteWarranty(Request $request){
        extract($request->all());
        $warranty = FolderManagement::find($warranty_id);
        if (!$warranty) {
            return response()->json(['status' => false, 'message' => 'Warranty not found']);
        }
        if ($warranty->delete()) {
            Notification::create([
                'lead_id' => $warranty->lead_id,
                'model' => 'Warranty Deleted',
                'title' => 'Warranty <b>' . $warranty->title . '</b> has been deleted for the lead <b>' . $warranty->getLead->title . '</b> by',
                'icon'    => 'fa-solid fa-trash',
                'time'    => now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Warranty Deleted Successfully']);
        }
    }
    public function deleteProposal(Request $request){
        extract($request->all());
        $proposal = FolderManagement::find($proposal_id);
        if (!$proposal) {
            return response()->json(['status' => false, 'message' => 'Proposal not found']);
        }
        if ($proposal->delete()) {
            Notification::create([
                'lead_id' => $proposal->lead_id,
                'model' => 'Proposal Deleted',
                'title' => 'Proposal <b>' . $proposal->title . '</b> has been deleted for the lead <b>' . $proposal->getLead->title . '</b> by',
                'icon'    => 'fa-solid fa-trash',
                'time'    => now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Proposal Deleted Successfully']);
        }
    }
}
