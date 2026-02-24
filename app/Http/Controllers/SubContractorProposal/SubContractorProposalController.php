<?php

namespace App\Http\Controllers\SubContractorProposal;

use App\EmailTemplateVariable;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Lead;
use App\ProposalTemplate;
use App\SubContractorProposal;
use App\User;
use Mail;
use Illuminate\Http\Request;

class SubContractorProposalController extends Controller
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
        $model = str_slug('subcontractorproposal','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $subcontractorproposal = SubContractorProposal::where('lead_id', 'LIKE', "%$keyword%")
                    ->orWhere('proposal_id', 'LIKE', "%$keyword%")
                    ->orWhere('sub_contractor_id', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $subcontractorproposal = SubContractorProposal::paginate($perPage);
            }

            return view('subContractorProposal.sub-contractor-proposal.index', compact('subcontractorproposal'));
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
        $model = str_slug('subcontractorproposal','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('subContractorProposal.sub-contractor-proposal.create');
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
//    public function store(Request $request)
//    {
//        $model = str_slug('subcontractorproposal','-');
//        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
//            extract($request->all());
//            $requestData = $request->all();
//            unset($requestData['email_subject']);
//            $requestData['status'] = 'required';
//            SubContractorProposal::create($requestData);
//            $link = url('/subcontractor_proposal_view/'. $proposal_template_id. '/'. $lead_id);
//            $user = User::find($sub_contractor_id);
//            $email = $user->email;
//            try {
//                $emailSubject = $request->input('email_subject', 'Sub Contractor Proposal Signature');
//                Mail::send('proposal.proposal.customer_proposal_email', ['link' => $link], function ($message) use ($email , $emailSubject) {
//                    $message->to($email)
//                        ->cc('araib.be.tafsol@gmail.com')
//                        ->bcc('development.aftab@yopmail.com')
//                        ->subject($emailSubject);
//                });
//            } catch (\Exception $e) {
//                return back()->withErrors('Failed to send email: ' . $e->getMessage());
//            }
//            return back()->with('flash_message', 'SubContractorProposal added!');
////            return redirect('subContractorProposal/sub-contractor-proposal')->with('flash_message', 'SubContractorProposal added!');
//        }
//        return response(view('403'), 403);
//    }

    public function store(Request $request)
    {
        $model = str_slug('subcontractorproposal', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() !== null) {
            $data = $request->all();
            $description = $data['description'] ?? null;
            if (!$description) {
                return back()->withErrors('Description is required.');
            }
            $fileName = 'proposal_' . time() . '.html';
            $filePath = "subcontractor_proposal_response/{$fileName}";
            try {
                if (!Storage::disk('website')->exists('subcontractor_proposal_response')) {
                    Storage::disk('website')->makeDirectory('subcontractor_proposal_response');
                }
                Storage::disk('website')->put($filePath, $description);
            } catch (\Exception $e) {
                return $e->getMessage();
                return back()->withErrors('Failed to save the proposal file: ' . $e->getMessage());
            }
            try {
                $proposal = SubContractorProposal::updateOrCreate(
                    [
                        'proposal_template_id' => $data['proposal_template_id'],
                        'lead_id' => $data['lead_id'],
                        'sub_contractor_id' => $data['sub_contractor_id'],
//                        'name' => $data['name'] ?? null,
                        'description' => $filePath,
                        'screen_shot' => $data['screen_shot'] ?? null,
                        'status' => $data['status'],
                    ]
                );
                $user = User::find($data['sub_contractor_id']);if (!$user) {
                    return back()->with('flash_message', 'User not found');

                    return back()->withErrors('User not found.');
                }
                $email = $user->email;
                $link = url('/subcontractor_proposal_view/' . $proposal->proposal_template_id . '/' . $proposal->lead_id);
                $emailSubject = $request->input('email_subject', 'Sub Contractor Proposal Signature');
                try {
                    Mail::send('proposal.proposal.customer_proposal_email', ['link' => $link], function ($message) use ($email, $emailSubject) {
                        $message->to($email)
                            ->cc('araib.be.tafsol@gmail.com')
                            ->bcc('development.aftab@yopmail.com')
                            ->subject($emailSubject);
                    });
                } catch (\Exception $e) {
                    return back()->withErrors('Failed to send email: ' . $e->getMessage());
                }
            } catch (\Exception $e) {
                return back()->withErrors('Failed to save the proposal record: ' . $e->getMessage());
            }

            return back()->with('flash_message', 'SubContractorProposal added successfully!');
        }
        return back()->withErrors('You do not have permission to add this proposal.');
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
        $model = str_slug('subcontractorproposal','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $subcontractorproposal = SubContractorProposal::findOrFail($id);
            return view('subContractorProposal.sub-contractor-proposal.show', compact('subcontractorproposal'));
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
        $model = str_slug('subcontractorproposal','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $subcontractorproposal = SubContractorProposal::findOrFail($id);
            return view('subContractorProposal.sub-contractor-proposal.edit', compact('subcontractorproposal'));
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
        $model = str_slug('subcontractorproposal','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();

            $subcontractorproposal = SubContractorProposal::findOrFail($id);
            $subcontractorproposal->update($requestData);


            return redirect('subContractorProposal/sub-contractor-proposal')->with('flash_message', 'SubContractorProposal updated!');
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
        $model = str_slug('subcontractorproposal','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SubContractorProposal::destroy($id);

            return redirect('subContractorProposal/sub-contractor-proposal')->with('flash_message', 'SubContractorProposal deleted!');
        }
        return response(view('403'), 403);

    }
    public function subContractorProposalEdit($id){
        $leads = Lead::where('lead_status', 'won')->get();
        $proposalTemplate = ProposalTemplate::where('proposal_type', 1)->get();
        $variables = EmailTemplateVariable::whereIn('email_variable_type_id', [1, 5])->whereStatus('1')->get();
//        return view('subContractorProposal.sub-contractor-proposal.send_proposal', compact( 'leads','proposalTemplate', 'variables' ,'id'));
        return view('subContractorProposal.sub-contractor-proposal.send_proposal_new', compact( 'leads','proposalTemplate', 'variables' ,'id'));
    }


}
