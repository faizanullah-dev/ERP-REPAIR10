<?php

namespace App\Http\Controllers\ChatBotRoom;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ChatBotRoom;
use Illuminate\Http\Request;

class ChatBotRoomController extends Controller
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
        $model = str_slug('chatbotroom','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $chatbotroom = ChatBotRoom::where('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $chatbotroom = ChatBotRoom::paginate($perPage);
            }

            return view('chatBotRoom.chat-bot-room.index', compact('chatbotroom'));
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
        $model = str_slug('chatbotroom','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('chatBotRoom.chat-bot-room.create');
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
        $model = str_slug('chatbotroom','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ChatBotRoom::create($requestData);
            return redirect('chatBotRoom/chat-bot-room')->with('flash_message', 'ChatBotRoom added!');
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
        $model = str_slug('chatbotroom','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $chatbotroom = ChatBotRoom::findOrFail($id);
            return view('chatBotRoom.chat-bot-room.show', compact('chatbotroom'));
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
        $model = str_slug('chatbotroom','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $chatbotroom = ChatBotRoom::findOrFail($id);
            return view('chatBotRoom.chat-bot-room.edit', compact('chatbotroom'));
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
        $model = str_slug('chatbotroom','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $chatbotroom = ChatBotRoom::findOrFail($id);
             $chatbotroom->update($requestData);

             return redirect('chatBotRoom/chat-bot-room')->with('flash_message', 'ChatBotRoom updated!');
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
        $model = str_slug('chatbotroom','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ChatBotRoom::destroy($id);

            return redirect('chatBotRoom/chat-bot-room')->with('flash_message', 'ChatBotRoom deleted!');
        }
        return response(view('403'), 403);

    }
}
