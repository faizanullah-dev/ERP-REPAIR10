<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LEADUP - AI Chat Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --primary-color: #74C911;
            --bg-color: #FFF;
            --sidebar-color: #f7f7f7;
            --text-color: #202123;
            --text-secondary: #565869;
            --border-color: #e5e5e5;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            background-color: var(--sidebar-color);
            height: 100vh;
            border-right: 1px solid var(--border-color);
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .logo-area {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .logo {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 20px;
        }

        .new-chat-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            margin: 15px;
            width: calc(100% - 30px);
            text-align: left;
            transition: all 0.3s;
            text-decoration: none;
        }

        .new-chat-btn:hover {
            background-color: #65b30c;
        }

        .chat-history {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px 15px;
        }

        .chat-item {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
            cursor: pointer;
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-item:hover {
            background-color: #e9e9e9;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .chat-container {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .message {
            max-width: 80%;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            line-height: 1.5;
        }

        .user-message {
            background-color: var(--primary-color);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 2px;
        }

        .ai-message {
            background-color: #f2f2f2;
            color: var(--text-color);
            align-self: flex-start;
            border-bottom-left-radius: 2px;
        }

        .input-area {
            padding: 20px;
            position: relative;
        }

        .message-input {
            width: 100%;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            padding: 12px 50px 12px 15px;
            resize: none;
            max-height: 200px;
            overflow-y: auto;
        }

        .send-button {
            position: absolute;
            right: 30px;
            bottom: 30px;
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 20px;
        }

        .chat-header {
            padding: 35px 20px;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
            font-weight: 600;
        }

        .new-chat{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .exit-button{
            text-decoration: none;
            color: #000;
        }

        .chat-item a{
            text-decoration: none;
            color: #000;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 100;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .menu-button {
                display: block;
                position: absolute;
                top: 15px;
                left: 15px;
                z-index: 101;
                background: var(--primary-color);
                color: white;
                border: none;
                border-radius: 5px;
                padding: 5px 10px;
            }
        }
    </style>
</head>
<body>
<button class="menu-button d-md-none">
    <i class="fas fa-bars"></i>
</button>

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-3 sidebar">
            <div class="logo-area">
                <div class="logo"><img src="{{ asset('website/images/logo.png') }}" class="img-fluid"></div>
            </div>
            <a href="{{url('chatbot-assistant')}}" class="new-chat-btn">
                <i class="fas fa-plus me-2"></i>New chat
            </a>
            <div class="chat-history">
                @foreach($rooms as $room)
                    <div class="chat-item">
                        <a href="{{$room->id}}">{{$room->roomMessages->first()->message??$room->name}}</a>
                    </div>
                @endforeach
            </div>
            <div class="p-3 border-top">
                <div class="chat-item"><i class="fas fa-sign-out me-2"></i>
                    <a href="{{url('dashboard')}}" class="exit-button">Exit</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-9 main-content">
            <div class="chat-header">
                LEADUP AI
            </div>
            <div class="chat-container" id="chatContainer">
                @if($messages->count() < 1)
                    <div class="new-chat">
                        <h1>How Can I Help You Today?</h1>
                    </div>
                @endif
                @foreach($messages as $message)
                    @if($message->sender == 'user')
                        <div class="message user-message">
                            {!! $message->message !!}
                        </div>
                    @elseif($message->sender == 'ai')
                        <div class="message ai-message">
                            {!! $message->message !!}
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="input-area">
                <textarea class="message-input" rows="3" placeholder="Message Leadup AI..." id="messageInput"></textarea>
                <button class="send-button" id="sendButton">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        const chatContainer = $('#chatContainer');
        const messageInput = $('#messageInput');
        const sendButton = $('#sendButton');
        const newChatBtn = $('#newChatBtn');

        // Retrieve sessionId from Blade
        const sessionId = "{{ $sessionId }}";
        const chatbotApiUrl = "http://localhost:5000/chat";

        function appendMessage(sender, message) {
            const messageClass = sender === 'user' ? 'user-message' : 'ai-message';
            const messageHtml = `
                <div class="message ${messageClass}">
                    ${message}
                </div>
            `;
            chatContainer.append(messageHtml);
            chatContainer.scrollTop(chatContainer[0].scrollHeight);
        }

        function showTypingIndicator() {
            const typingHtml = `
                <div class="message ai-message" id="typing-indicator">
                    <i class="fas fa-ellipsis-h fa-beat"></i>
                </div>
            `;
            chatContainer.append(typingHtml);
            chatContainer.scrollTop(chatContainer[0].scrollHeight);
        }

        function hideTypingIndicator() {
            $('#typing-indicator').remove();
        }

        function sendMessage() {
            const message = messageInput.val().trim();
            if (message === '') {
                return;
            }

            appendMessage('user', message);
            messageInput.val('');
            showTypingIndicator();

            $.ajax({
                url: "{{url('store_user_message')}}",
                method: 'POST',
                data:{
                    message: message,
                    chat_bot_room_id: sessionId,
                    sender: 'user',
                    '_token': "{{csrf_token()}}"
                },
                success: function (response){
                    $('.new-chat').hide();
                },
            });

            $.ajax({
                url: chatbotApiUrl,
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ message: message, session_id: sessionId }),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    hideTypingIndicator();
                    if (response.answer) {
                        appendMessage('ai', response.answer);
                        $.ajax({
                            url: "{{url('store_ai_message')}}",
                            method: 'POST',
                            data:{
                                message: response.answer,
                                chat_bot_room_id: sessionId,
                                sender: 'ai',
                                '_token': "{{csrf_token()}}"
                            },
                        });

                    } else {
                        appendMessage('ai', 'Something went wrong.');
                    }
                },
                error: function(xhr) {
                    hideTypingIndicator();
                    appendMessage('ai', 'Error connecting to the chatbot server.');
                    console.error('API Error:', xhr.responseText);
                }
            });
        }

        sendButton.on('click', sendMessage);
        messageInput.on('keypress', function(e) {
            if (e.which === 13 && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // "New Chat" functionality
        newChatBtn.on('click', function() {
            chatContainer.empty();
            // A new session ID will be generated on page reload
            location.reload();
        });
    });
</script>
</html>
