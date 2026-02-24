<?php

namespace App\Http\Controllers\UserMailSend;

use App\EmailTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\EmailTemplateFolder;
use App\User;
use App\EmailTemplateVariable;
use App\UserMailSend;
use App\UsersMailboxConfiguration;
use App\UsersMailboxesSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMailSendController extends Controller
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
        extract($request->all());
        $model = str_slug('usermailsend', '-');
        $permissions = auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first();
        if ($permissions) {
            $keyword = $request->get('search');
            $perPage = 20;
            if (!empty($keyword)){
                $emailTemplate = EmailTemplate::where('title', 'LIKE', "%$keyword%")
                    ->orWhere('subject', 'LIKE', "%$keyword%")
                    ->orWhere('body', 'LIKE', "%$keyword%")
                    ->orWhere('attachment', 'LIKE', "%$keyword%");
            } else {
                if (UsersMailboxConfiguration::where('user_id', Auth::id())->first() != null){
                      $emailTemplate = EmailTemplate::orderBy('id', 'ASC')->paginate($perPage);
                      $customers = User::whereHas('roles', function($q){$q->where('name','customer');})->get();
                } else {
                    return redirect(route('mail_configuration'))->with(['type' => 'error', 'message' => 'Mail configurations not found, add your mail configurations first.']);
                }
            }//ends if.
            $variables = EmailTemplateVariable::get();
            $emailTemplateFolders = EmailTemplateFolder::whereStatus('1')->get();
            return view('admin.email', compact('emailTemplate','customers','variables','emailTemplateFolders'));
        }//ends if
        return response(view('403'), 403);
    }



//   public function index(Request $request)
//    {
//        extract($request->all());
//        $model = str_slug('usermailsend', '-');
//        $permissions = auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first();
//        if ($permissions) {
//            $keyword = $request->get('search');
//            $perPage = 20;
//            $usermailsend = UserMailSend::query();
//            if (!empty($keyword)) {
//                $usermailsend = $usermailsend
//                    ->where('user_id', 'LIKE', "%$keyword%")
//                    ->orWhere('subject', 'LIKE', "%$keyword%")
//                    ->orWhere('to', 'LIKE', "%$keyword%")
//                    ->orWhere('cc', 'LIKE', "%$keyword%")
//                    ->orWhere('description', 'LIKE', "%$keyword%");
//            } else {
//                if (UsersMailboxConfiguration::where('user_id', Auth::id())->first() != null) {
//                    $configuration_email = UsersMailboxConfiguration::where('user_id', Auth::id())->first()->mail_username ?? "";
//                    if (!empty($email_slug)) {
//                        if ($email_slug == 'inbox') {
//                            $usermailsend = $usermailsend->where('configuration_email', $configuration_email)->where('user_id', Auth::id())->orderBy('id', 'ASC');
//                        }elseif ($email_slug == 'sent') {
//                            $usermailsend = UsersMailboxesSent::where('configuration_email', $configuration_email)->where('user_id', Auth::id())->orderBy('uid', 'DESC');
//                        }elseif ($email_slug == 'trash') {
//                            $usermailsend = UsersMailboxesSent::where('configuration_email', $configuration_email)->where('user_id', Auth::id())->onlyTrashed()->orderBy('uid', 'DESC');
//                        }
//                    }//end if.
//                } else {
//                    return redirect(route('mail_configuration'))->with(['type' => 'error', 'message' => 'Mail configurations not found, add your mail configurations first.']);
//                }
//            }//ends if.
//             $usermailsend = $usermailsend->paginate($perPage);
//             return view('admin.email', compact('usermailsend'));
//        }//ends if
//        return response(view('403'), 403);
//    }

    public function create(){
        $model = str_slug('usermailsend','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $variables = EmailTemplateVariable::get();
            return view('userMailSend.user-mail-send.create', compact('variables'));
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
        
        $model = str_slug('usermailsend','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            UserMailSend::create($requestData);
            return redirect('userMailSend/user-mail-send')->with('flash_message', 'User Mail Send added!');
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
        $model = str_slug('usermailsend','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $usermailsend = UserMailSend::findOrFail($id);
            return view('userMailSend.user-mail-send.show', compact('usermailsend'));
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
        $model = str_slug('usermailsend','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $usermailsend = UserMailSend::findOrFail($id);
            return view('userMailSend.user-mail-send.edit', compact('usermailsend'));
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
        $model = str_slug('usermailsend','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {

            $requestData = $request->all();

            $usermailsend = UserMailSend::findOrFail($id);
            $usermailsend->update($requestData);

            return redirect('userMailSend/user-mail-send')->with('flash_message', 'UserMailSend updated!');
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
    public function destroy($ids)
    {
        return $ids;
        $model = str_slug('usermailsend','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            $ids = explode(',', $ids);
            UserMailSend::whereIn('id', $ids)->delete();
            return redirect('userMailSend/user-mail-send')->with('flash_message', 'UserMailSend deleted!');
        }
        return response(view('403'), 403);

    }
}
