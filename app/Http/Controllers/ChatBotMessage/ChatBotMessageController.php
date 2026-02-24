<?php

namespace App\Http\Controllers\ChatBotMessage;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ChatBotMessage;
use Illuminate\Http\Request;

class ChatBotMessageController extends Controller
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
        $model = str_slug('chatbotmessage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $chatbotmessage = ChatBotMessage::where('chat_bot_room_id', 'LIKE', "%$keyword%")
                ->orWhere('sender', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $chatbotmessage = ChatBotMessage::paginate($perPage);
            }

            return view('chatBotMessage.chat-bot-message.index', compact('chatbotmessage'));
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
        $model = str_slug('chatbotmessage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('chatBotMessage.chat-bot-message.create');
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
        $model = str_slug('chatbotmessage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ChatBotMessage::create($requestData);
            return redirect('chatBotMessage/chat-bot-message')->with('flash_message', 'ChatBotMessage added!');
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
        $model = str_slug('chatbotmessage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $chatbotmessage = ChatBotMessage::findOrFail($id);
            return view('chatBotMessage.chat-bot-message.show', compact('chatbotmessage'));
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
        $model = str_slug('chatbotmessage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $chatbotmessage = ChatBotMessage::findOrFail($id);
            return view('chatBotMessage.chat-bot-message.edit', compact('chatbotmessage'));
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
        $model = str_slug('chatbotmessage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $chatbotmessage = ChatBotMessage::findOrFail($id);
             $chatbotmessage->update($requestData);

             return redirect('chatBotMessage/chat-bot-message')->with('flash_message', 'ChatBotMessage updated!');
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
        $model = str_slug('chatbotmessage','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ChatBotMessage::destroy($id);

            return redirect('chatBotMessage/chat-bot-message')->with('flash_message', 'ChatBotMessage deleted!');
        }
        return response(view('403'), 403);

    }
}
