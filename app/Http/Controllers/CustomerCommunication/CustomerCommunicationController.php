<?php

namespace App\Http\Controllers\CustomerCommunication;

use App\CustomerPhone;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Twilio\Rest\Client as TwilioClient;

use App\CustomerCommunication;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerCommunicationController extends Controller
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
        $model = str_slug('customercommunication','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $customercommunication = CustomerCommunication::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('from', 'LIKE', "%$keyword%")
                ->orWhere('to', 'LIKE', "%$keyword%")
                ->orWhere('cc', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $customercommunication = CustomerCommunication::paginate($perPage);
            }

            return view('customerCommunication.customer-communication.index', compact('customercommunication'));
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
        $model = str_slug('customercommunication','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('customerCommunication.customer-communication.create');
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
    public function store(Request $request){
//        return $request->all();
        $model = str_slug('customercommunication','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            try {
                $userEmail = User::where('id', $request->user_id)->first();//ends user.
                $mailMessage = strip_tags(html_entity_decode($request->message));
                $attachments = [];
                $attachmentsDB = [];
                $mailAttachments = $request->file('mail_attachment');
                if ($mailAttachments && is_array($mailAttachments)) {
                    foreach ($mailAttachments as $file) {
                        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('emails_attachment'), $filename);
                        $filePath = 'emails_attachment/' . $filename;
                        $fileAttachment = public_path($filePath);
                        $attachmentsDB[] = $filePath; // Add file path to $attachmentsDB
                        $attachments[] = $fileAttachment;
                    }//end foreach.
                }//emd if.
                $userIds = $request->user_ids;
                foreach ($userIds as $userId) {
                    $userEmail = User::where('id', $userId)->first();
                    if ($userEmail) {
                        $CustomerCommunication = CustomerCommunication::create([
                            'user_id' => $userId,
                            'to' => $userEmail->email,
                            'cc' => $userEmail->email,
                            'from' => env('MAIL_USERNAME'),
                            'message' => $mailMessage,
                            'mail_attachment' => json_encode($attachmentsDB),
                            'subject' => $request->subject,
                            'type' => $request->type,
                        ]);
                    }
                }
                if ($CustomerCommunication->type == 'phone') {
                    try {
                        $account_sid = "AC0190cfbd8b9584b91b40274036215caf";
                        $auth_token = "62b25eb18af8e635d01f1c4cafa377d0";
                        $twilio_number = "+18446580060";
                        $twilio_client = new TwilioClient($account_sid, $auth_token);
                        $customerPhones = CustomerPhone::where('customer_id', $userIds)->get();

                        foreach ($customerPhones as $phone) {
                            $to = '+1' . $phone->phone;
                            try {
                                $result = $twilio_client->messages->create($to, [
                                    'from' => $twilio_number,
                                    'body' => $mailMessage,
                                ]);
                            } catch (\Twilio\Exceptions\RestException $e) {
                                error_log("Twilio Error: " . $e->getMessage());
                            }
                        }
                    } catch (\Exception $e) {
                        error_log("Exception: " . $e->getMessage());
                    }
                    //ends tryCatch.
               }else{
                    Mail::raw($mailMessage, function ($message) use ($request, $userEmail, $attachments) {
                        foreach ($attachments as $attachment) {
                            $message->attach($attachment);//
                        }//end if.
                        $message->from(env('MAIL_USERNAME'))
                            ->to($userEmail->email)
                            ->cc($userEmail->email)
                            ->subject($request->subject);
                    });
               }
                return back()->with('flash_message', 'Send Email Successfully!');
            } catch (\Exception $e) {
                return back()->with(['title' => 'Fail', 'message' => 'Something went wrong', 'type' => 'error']);
            }//end trycatch
//            return redirect('customerCommunication/customer-communication')->with('flash_message', 'CustomerCommunication added!');
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
        $model = str_slug('customercommunication','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $customercommunication = CustomerCommunication::findOrFail($id);
            return view('customerCommunication.customer-communication.show', compact('customercommunication'));
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
        $model = str_slug('customercommunication','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $customercommunication = CustomerCommunication::findOrFail($id);
            return view('customerCommunication.customer-communication.edit', compact('customercommunication'));
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
        $model = str_slug('customercommunication','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $customercommunication = CustomerCommunication::findOrFail($id);
             $customercommunication->update($requestData);

             return redirect('customerCommunication/customer-communication')->with('flash_message', 'CustomerCommunication updated!');
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
        $model = str_slug('customercommunication','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CustomerCommunication::destroy($id);

            return redirect('customerCommunication/customer-communication')->with('flash_message', 'CustomerCommunication deleted!');
        }
        return response(view('403'), 403);

    }
}
