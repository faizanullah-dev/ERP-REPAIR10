<?php

namespace App\Http\Controllers\Proposal;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\Notification;
use App\Proposal;
use App\ProposalAttachment;
use App\ProposalTemplate;
use App\ProposalTemplateAttachment;
use App\EmailTemplateVariable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class ProposalController extends Controller
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
        $model = str_slug('proposal','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $proposal = Proposal::where('lead_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $proposal = Proposal::paginate($perPage);
            }

            return view('proposal.proposal.index', compact('proposal'));
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
        $model = str_slug('proposal','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            if(!empty($lead_id)){
                $leadExist=lead::findorfail($lead_id);
                $proposalTemplates = ProposalTemplate::get();
                return view('proposal.proposal.create',compact('leads','proposalTemplates','leadExist'));
            }//ends if.
            return view('proposal.proposal.create',compact('leads'));
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
        $model = str_slug('proposal','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            extract($requestData);
            $proposal =  Proposal::create(['lead_id' => $lead_id ??"", 'created_by' => auth()->id() ??'', ]);
            if ($request->proposal_template_id != null) {
                $proposalTemplates = ProposalTemplate::where('id', $proposal_template_id)->get();
                foreach ($proposalTemplates as $proposalTemplate) {
                    if ($proposalTemplate->images) {
                        foreach ($proposalTemplate->images as $image) {
                            ProposalAttachment::create([
                                'proposal_id' => $proposal->id,
                                'name' => $image->name
                            ]);
                        }
                    }
                }
            }//ends if.
            if ($request->proposal_attachment != '') {
                    foreach(explode(',',$request->proposal_attachment) as $key => $value){
                        ProposalAttachment::create([ 'proposal_id' => $proposal->id,'name'  => $value,]);
                    }//end foreach.
            }//ends if.
            if(isset($proposal) && !empty($proposal)) {
                Notification::create([
                    'lead_id' => $proposal->lead_id,
                    'model'   => 'Proposal Create',
                    'title'   => $proposal->name,
                    'time'    => $proposal->created_at,
                ]);
            }//ends if.
            if($request->view_lead != ''){
                return back()->with('flash_message', 'Proposal added!');
            }else{
                return redirect('proposal/proposal')->with('flash_message', 'Proposal added!');
            }
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
        $model = str_slug('proposal','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $proposal = Proposal::findOrFail($id);
            return view('proposal.proposal.show', compact('proposal'));
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
        $model = str_slug('proposal','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $proposal = Proposal::findOrFail($id);
            $lead = Lead::get();
            return view('proposal.proposal.edit',compact('proposal','lead'));
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
        $model = str_slug('proposal','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            extract($requestData);
            $proposal = Proposal::findOrFail($id);
                 Proposal::whereid($proposal->id)->update([
                     'lead_id' => $lead_id,
                 ]);
                if ($request->proposal_attachment != '') {
                    foreach(explode(',',$request->proposal_attachment) as $key => $value){
                        ProposalAttachment::where('proposal_id',$id)->where('name', $value)->updateOrCreate(['proposal_id' => $proposal->id, 'name' => $value]);
                    }//end foreach.
                }//end if.
                if (isset($proposal) && !empty($proposal)) {
                    Notification::create([
                        'lead_id' => $proposal->lead_id,
                        'model'   => 'Proposal Update',
                        'title'   => $proposal->name,
                        'time'    => $proposal->created_at,
                    ]);
                }//ends if.
            if($request->view_lead != ''){
                return back()->with('flash_message', 'Proposal added!');
            }else{
                return redirect('proposal/proposal')->with('flash_message', 'Proposal added!');
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
        $model = str_slug('proposal','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Proposal::destroy($id);

            return redirect('proposal/proposal')->with('flash_message', 'Proposal deleted!');
        }
        return response(view('403'), 403);

    }
    public function leadCustomProposal($lead_id){
        $leads = Lead::get();
        $lead = $leads->find($lead_id);
        $proposalTemplate = ProposalTemplate::where('proposal_type', 2)->get();
        $selectedLeadId = $lead_id;
        $variables = EmailTemplateVariable::whereIn('email_variable_type_id', [1, 5])->whereStatus('1')->get();

//        return view('proposal.proposal.custom_proposal', compact('lead', 'leads','proposalTemplate', 'selectedLeadId' ,'variables'));
        return view('proposal.proposal.lead_custom_proposal_new', compact('lead', 'leads','proposalTemplate', 'selectedLeadId' ,'variables'));
    }//ends function leadCustomProposal.

//    public function storeLeadsCustomProposal(Request $request){
////        return $request->all();
//        extract($request->all());
//        $screenShot = $screen_shot;
//        $proposal = Proposal::updateOrCreate(
//            [   'proposal_id'    => $proposal_id,
//                'lead_id'       => $lead_id,
//            ],
//            [
//                'name'          => $name ?? null,
//                'proposal_id'   => $proposal_id ?? null,
//                'lead_id'       => $lead_id ?? null,
//                'description'   => $description,
//                'screen_shot'   => $screenShot,
//            ]
//        );
//        $link = url(env('APP_URL').'/customer_proposal_view/'.$proposal_id.'/'.$request->lead_id);
//        Mail::send('proposal.proposal.customer_proposal_email',['link' => $link], function ($message) use ($proposal) {
//            $message->
//            from('development.aftab@gmail.com')->
//            to($proposal->getLead->customer->email)->
//            cc('araib.be.tafsol@gmail.com')->
//            bcc('abdulbasitfe.tafsol@gmail.com')->
//            subject('Customer Proposal Signature');
//        });
//        return back()->with('flash_message', 'Please check your email. Proposal added successfully!');
//    }//ends function storeLeadsCustomProposal.
    public function storeLeadsCustomProposal(Request $request){
        extract($request->all());

        if (!$description) {
            return back()->withErrors('Description is required.');
        }
        $fileName = 'proposal_' . time() . '.html';
        try {
            $filePath = "user_proposal/{$fileName}";
            if (!Storage::disk('website')->exists('user_proposal')) {
                Storage::disk('website')->makeDirectory('user_proposal');
            }
            Storage::disk('website')->put($filePath, $description);
        } catch (\Exception $e) {
            return back()->withErrors('Failed to save the proposal file: ' . $e->getMessage());
        }
        try {
            $proposal = Proposal::updateOrCreate(
                ['id' => $proposal_id],
                [
                    'proposal_template_id' => $proposal_template_id,
                    'lead_id' => $lead_id,
                    'name' => $name ?? null,
                    'description' => $filePath,
                    'screen_shot' => $screen_shot,
                    'status' => $status,
                ]
            );

        } catch (\Exception $e) {
            return back()->withErrors('Failed to save the proposal record: ' . $e->getMessage());
        }
        if($status === 'sent' || $status === 'save') {
        $link = url('/customer_proposal_view/'. $proposal->id);
        try {
            $emailSubject = $request->input('email_subject', 'Customer Proposal Signature');
            Mail::send('proposal.proposal.customer_proposal_email', ['link' => $link], function ($message) use ($proposal, $emailSubject) {
                $message->to($proposal->getLead->customer->email)
                    ->cc('araib.be.tafsol@gmail.com')
                    ->bcc('development.aftab@yopmail.com')
                    ->subject($emailSubject);
            });
        } catch (\Exception $e) {
            return back()->withErrors('Failed to send email: ' . $e->getMessage());
        }
        }
        return back()->with('flash_message', 'Proposal added successfully!');
    }

    public function customizeProposalsDelete($id)
    {
        $proposals = ProposalTemplate::find($id);
        $proposals->delete();
        return response()->json(['success' => true]);
    }
    public function updateProposalOrder(Request $request, $id)
    {
        $order = $request->input('order');
        foreach ($order as $index => $proposalId) {
            ProposalTemplate::where('id', $proposalId)
                ->where('proposal_type', $id)
                ->update([
                    'order_index' => $index + 1
                ]);
        }
        return response()->json(['success' => true]);
    }

}
