<?php

namespace App\Http\Controllers\ChatMessage;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ChatMessage;
use App\Lead;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
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
        $model = str_slug('chatmessage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $chatmessage = ChatMessage::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('sender_type', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $chatmessage = ChatMessage::paginate($perPage);
            }

            return view('chatMessage.chat-message.index', compact('chatmessage'));
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
        $model = str_slug('chatmessage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('chatMessage.chat-message.create');
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
        $model = str_slug('chatmessage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ChatMessage::create($requestData);
            return redirect('chatMessage/chat-message')->with('flash_message', 'ChatMessage added!');
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
        $model = str_slug('chatmessage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $chatmessage = ChatMessage::findOrFail($id);
            return view('chatMessage.chat-message.show', compact('chatmessage'));
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
        $model = str_slug('chatmessage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $chatmessage = ChatMessage::findOrFail($id);
            return view('chatMessage.chat-message.edit', compact('chatmessage'));
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
        $model = str_slug('chatmessage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $chatmessage = ChatMessage::findOrFail($id);
             $chatmessage->update($requestData);

             return redirect('chatMessage/chat-message')->with('flash_message', 'ChatMessage updated!');
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
        $model = str_slug('chatmessage','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ChatMessage::destroy($id);

            return redirect('chatMessage/chat-message')->with('flash_message', 'ChatMessage deleted!');
        }
        return response(view('403'), 403);

    }

    public function getLeadChat(Request $request)
    {
        $leadId = $request->input('lead_id');

        $lead = Lead::with('category')->findOrFail($leadId);

        $messages = ChatMessage::where('lead_id', $leadId)->get();

        return (string) view('dashboard.customerDashboard.ajax.lead_chat', [
            'lead' => $lead,
            'messages' => $messages
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240'
        ]);

        if(auth()->user()->hasRole('customer')){
            $sender = 'customer';
        }
        else{
            $sender = 'admin';
        }

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $this->storeImage('chat_attachments', $file);
                $attachments[] = [
                    'url' => asset('website/' . $path),
                    'type' => $file->getMimeType(),
                    'name' => $file->getClientOriginalName()
                ];
            }
        }
        $message = ChatMessage::create([
            'lead_id' => $request->lead_id??null,
            'message' => $request->message ?? null,
            'sender_type' => $sender,
            'reply_to' => $request->reply_to,
            'type' => $request->type,
            'sender_id' => $request->sender_id??null,
            'attachments' => !empty($attachments) ? json_encode($attachments) : null
        ]);
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}
