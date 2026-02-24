<?php

namespace App\Http\Controllers\PhotoAndDocument;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\Notification;
use App\PhotoAndDocument;
use App\PhotoAndDocumentAttachment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PhotoAndDocumentController extends Controller
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
        $model = str_slug('photoanddocument','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;
            if (!empty($keyword)) {
                $photoanddocument = PhotoAndDocument::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                if (auth()->user()->hasRole('staff')) {
                    $photoanddocument = PhotoAndDocument::orderBy('id', 'DESC')
                        ->whereHas('getLead', function ($query) {
                            $query->where('representative_id', auth()->user()->id);
                        })
                        ->paginate($perPage);
                }else{
                    $photoanddocument = PhotoAndDocument::orderBy('id','DESC')->paginate($perPage);
                }
            }
            return view('photoAndDocument.photo-and-document.index', compact('photoanddocument'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        extract($request->all());
        $model = str_slug('photoanddocument','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            if (!empty($lead_id)) {
                $leadExist = Lead::findorfail($lead_id);
               return  view('photoAndDocument.photo-and-document.create',compact('leadExist', 'leads'));
            }
            return view('photoAndDocument.photo-and-document.create', compact('leads'));
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
        extract($request->all());
        $model = str_slug('photoanddocument','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first() != null ){
            $leadData = Lead::findOrFail($lead_id);
            $photoAndDocument = PhotoAndDocument::create([
                'lead_id' => $lead_id,
                'company_camp_id' => $leadData->company_camp_id ?? '',
                'created_by' => auth()->id() ?? '',
            ]);
            if (isset($photoAndDocument) && !empty($photoAndDocument)) {
//                Notification::create([
//                    'lead_id' => $photoAndDocument->lead_id,
//                    'model'   => 'Photo And Document Create',
//                    'title'   => 'New Photo and Document',
//                    'time'    => $photoAndDocument->created_at,
//                ]);
                Notification::create([
                    'lead_id' =>  $photoAndDocument->lead_id,
                    'model'   => 'Attachments Added',
                    'title'   => 'Attachments added for the lead <b>' . $photoAndDocument->getlead->title . '</b> by ',
                    'icon'    => 'fa-solid fa-file-image',
                    'time'    => $photoAndDocument->created_at,
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.
            if ($request->photo_and_documents_attachment != '') {
                $primaryExists = PhotoAndDocumentAttachment::where('lead_id', $lead_id)->where('doc_primary', 1)->exists();
                foreach (explode(',', $request->photo_and_documents_attachment) as $key => $value) {
                    $docPrimary = $primaryExists ? 0 : ($key == 0 ? 1 : 0);
                    $photos = PhotoAndDocumentAttachment::create([
                        'document_id' => $photoAndDocument->id,
                        'name'        => $value,
                        'file_name'   => basename($value),
                        'doc_primary' => $docPrimary,
                        'company_camp_id' => $photoAndDocument->company_camp_id ?? '',
                        'lead_id'     => $lead_id ?? 0,
                    ]);
                    $client = new \GuzzleHttp\Client();
                    $timestamp = Carbon::now()->format('YmdHis');
                    $photoUrl = asset('website') . '/' . $photos->name;
                    $fileExtension = strtolower(pathinfo($photos->name, PATHINFO_EXTENSION));
                    $documentExtensions = ['pdf', 'doc', 'docx', 'txt', 'xls', 'xlsx', 'ppt', 'pptx', 'odt', 'ods', 'odp'];
                    $base64Pdf = base64_encode(file_get_contents($photoUrl));
                    if (in_array($fileExtension, $documentExtensions)) {
                        $body = json_encode([
                            'document' => [
                                'name' => basename($photoUrl),
                                'attachment' => $base64Pdf
                            ]
                        ]);
                        $response = $client->request('POST', env('STORE_LEAD_COMPANY_CAMP') . '/' . $photoAndDocument->company_camp_id . '/documents', [
                            'body' => $body,
                            'headers' => [
                                'accept' => 'application/json',
                                'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
                                'content-type' => 'application/json',
                            ],
                        ]);
                        Notification::create([
                            'lead_id' => $lead_id,
                            'model'   => 'Attachments Added',
                            'title'   => 'Attachments added for the lead<b>' . $lead_id->getlead->title . '</b> by .',
                            'icon'    => 'fa-solid fa-file-image',
                            'time'    => $photoAndDocument->created_at,
                            'user_id' => auth()->user()->id,
                        ]);
                    } else {
                        $body = json_encode([
                            'photo' => [
                                'uri' => $photoUrl,
                                'captured_at' => $timestamp
                            ]
                        ]);
                        $response = $client->request('POST', env('STORE_LEAD_COMPANY_CAMP') . '/' . $photoAndDocument->company_camp_id . '/photos', [
                            'body' => $body,
                            'headers' => [
                                'accept' => 'application/json',
                                'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
                                'content-type' => 'application/json',
                            ],
                        ]);
                    }//end else if
                    $responseBody = json_decode($response->getBody(), true);
                    $photos->update(['company_camp_file_id' => $responseBody['id']]);
                } //end foreach.
            }//end if
            if($request->view_lead != ''){
                return back()->with('flash_message', 'PhotoAndDocument added!');
            }else{
                return redirect('photoAndDocument/photo-and-document')->with('flash_message', 'PhotoAndDocument added!');
            }
        }
        return response(view('403'), 403);
    }


//    public function store(Request $request)
//    {
//        extract($request->all());
//        $model = str_slug('photoanddocument','-');
//        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first() != null ){
//            $leadData = Lead::findOrFail($lead_id);
//            $photoAndDocument = PhotoAndDocument::create([
//                'lead_id' => $lead_id,
//                'campany_camp_id' => $leadData->company_camp_id ??'',
//                'created_by' => auth()->id() ??'',
//            ]);
//            if (isset($photoAndDocument) && !empty($photoAndDocument)) {
//                Notification::create([
//                    'lead_id' => $photoAndDocument->lead_id,
//                    'model'   => 'Photo And Document Create',
//                    'title'   => $photoAndDocument->name,
//                    'time'    => $photoAndDocument->created_at,
//                ]);
//            }//ends if.
//            if ($request->photo_and_documents_attachment != '') {
//                $primaryExists = PhotoAndDocumentAttachment::where('lead_id', $lead_id)->where('doc_primary', 1)->exists();
//                foreach (explode(',', $request->photo_and_documents_attachment) as $key => $value) {
//                    $docPrimary = $primaryExists ? 0 : ($key == 0 ? 1 : 0);
//                    $photos =   PhotoAndDocumentAttachment::create([
//                        'document_id' => $photoAndDocument->id,
//                        'name'        => $value,
//                        'doc_primary' => $docPrimary,
//                        'lead_id'     => $lead_id ?? 0,
//                    ]);
//                    $client = new \GuzzleHttp\Client();
//                    $timestamp = Carbon::now()->format('YmdHis');
//                    $photoUrl = asset('website') . '/' . $photos->name;
//
//                   if (document){
//                       $body = json_encode([
//                           'document' => [
//                               'name' => 'unaiz.txt',
//                               'attachment' => $photoUrl
//                           ]
//                       ]);
//
//                       $response = $client->request('POST', env('STORE_LEAD_COMPANY_CAMP') . '/' . $photoAndDocument->campany_camp_id . '/documents', [
//                           'body' => $body,
//                           'headers' => [
//                               'accept' => 'application/json',
//                               'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
//                               'content-type' => 'application/json',
//                           ],
//                       ]);
//                   }else{
//                       $body = json_encode([
//                           'photo' => [
//                               'uri' => $photoUrl,
//                               'captured_at' => $timestamp
//                           ]
//                       ]);
//
//                       $response = $client->request('POST', env('STORE_LEAD_COMPANY_CAMP') . '/' . $photoAndDocument->campany_camp_id . '/photos', [
//                           'body' => $body,
//                           'headers' => [
//                               'accept' => 'application/json',
//                               'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
//                               'content-type' => 'application/json',
//                           ],
//                       ]);
//                   }
//
////                    return $response->getBody();
//                } //end foreach.
//            }
//            if($request->view_lead != ''){
//                return back()->with('flash_message', 'PhotoAndDocument added!');
//            }else{
//                return redirect('photoAndDocument/photo-and-document')->with('flash_message', 'PhotoAndDocument added!');
//            }
//        }
//        return response(view('403'), 403);
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('photoanddocument','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $photoanddocument = PhotoAndDocument::findOrFail($id);

            return view('photoAndDocument.photo-and-document.show', compact('photoanddocument'));
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
        $model = str_slug('photoanddocument','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $photoanddocument = PhotoAndDocument::with('getDocuments')->findOrFail($id);
            $leads = Lead::get();
            return view('photoAndDocument.photo-and-document.edit', compact('photoanddocument','leads'));
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
        $model = str_slug('photoanddocument','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            extract($requestData);
            $photoanddocument = PhotoAndDocument::findOrFail($id);
            PhotoAndDocument::where('id',$photoanddocument->id)->update([
                'lead_id' => $lead_id,
            ]);
            if (isset($photoanddocument) && !empty($photoanddocument)) {
                Notification::create([
                    'lead_id' => $photoanddocument->lead_id,
                    'model'   => 'Photo And Document Update',
                    'title'   => $photoanddocument->name,
                    'time'    => $photoanddocument->created_at,
                ]);
            }//ends if.

            if ($request->photo_and_documents_attachment != '') {
                foreach(explode(',',$request->photo_and_documents_attachment) as $key=>$value){
                    PhotoAndDocumentAttachment::where('document_id',$id)->where('name', $value)->updateOrCreate([
                        'document_id' => $photoanddocument->id,
                        'name'    => $value
                    ]);
                }//end foreach.
            }
            if($request->view_lead != ''){
                return back()->with('flash_message', 'PhotoAndDocument updated!');
            }else{
                return redirect('photoAndDocument/photo-and-document')->with('flash_message', 'PhotoAndDocument updated!');
            }
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
        $model = str_slug('photoanddocument','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            PhotoAndDocument::destroy($id);

            return redirect('photoAndDocument/photo-and-document')->with('flash_message', 'PhotoAndDocument deleted!');
        }
        return response(view('403'), 403);

    }
}
