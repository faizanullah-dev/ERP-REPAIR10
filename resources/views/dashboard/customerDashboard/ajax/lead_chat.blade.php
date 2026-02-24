<button type="button" class="remove_right_wrap" ><i class="fa-solid fa-xmark"></i></button>
<div class="row customer_row_flex">
    <div class="col-md-12">
        <div class="white-box customer_right_side_box_wrapper">
            <div class="">
                <div class="customer_leads_gutter_wrap">
                    <div class="txt_img_button">
                        <div class="text_img_wrap">
                            <div class="image_wrap">
                                <div>
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('website/images/customer_p.png') }}" alt="Logo">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customer_details_wrap_right">
                        <div><label>Name:</label><span>{{ $lead->title ?? '-' }}</span></div>
                        <div><label>Phone:</label><span>{{ $lead->customer->customerPhonePrimary->phone ?? '-' }}</span></div>
                        <div><label>Email:</label><span>{{ $lead->customer->email ?? '-' }}</span></div>
                        <div><label>Address:</label><span>{{ $lead->address ?? '-' }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="white-box">
            <h3> Chat with Us </h3>
            <div class="chat_full_container-wrap">
                <div class="chat_container">
                    <div class="chat-messages">
                        @foreach($messages as $message)
                            <div class="message_customer message-{{ $message->sender_type === 'customer' ? 'right' : 'left' }}">
                                <div class="message-bubble">
                                    @if($message->message)
                                        {{ $message->message }}
                                    @endif

                                    @if($message->attachments)
                                        @php
                                            $attachments = json_decode($message->attachments, true);
                                        @endphp

                                        @foreach($attachments as $attachment)
                                            @if(str_starts_with($attachment['type'], 'image/'))
                                                <div class="message-attachment">
                                                    <img src="{{ $attachment['url'] }}" alt="Attachment" class="attachment-image img-fluid">
                                                </div>
                                            @elseif($attachment['type'] === 'application/pdf')
                                                <div class="message-attachment">
                                                    <a href="{{ $attachment['url'] }}" target="_blank" class="pdf-attachment">
                                                        <i class="fas fa-file-pdf"></i> {{ $attachment['name'] ?? 'PDF Document' }}
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="message-time">{{ $message->created_at->format('h:i A') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="input_container">
                    <form id="chatForm" action="{{ url('send_chat_message') }}" method="POST">
                        @csrf
                        <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                        <div class="input_group">
                            <input type="text" class="form-control messageInput" name="message" placeholder="Type Message" id="messageInput">
                            <button class="btn btn-send sendButton" type="submit" id="sendButton">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).off('keypress', '#messageInput')
            .off('submit', '#chatForm');

        $(document).on('keypress', '#messageInput', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#chatForm').trigger('submit');
            }
        });

        $(document).on('submit', '#chatForm', function(e) {
            e.preventDefault();

            const $form = $(this);
            if ($form.data('submitting')) return;
            $form.data('submitting', true);

            const $input = $form.find('.messageInput');
            const message = $input.val().trim();

            if (!message) {
                $form.data('submitting', false);
                return;
            }

            const $button = $form.find('.sendButton');
            const $messagesContainer = $form.closest('.chat_full_container-wrap').find('.chat-messages');

            $button.prop('disabled', true);

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                success: function(response) {
                    if (response.success) {
                        $messagesContainer.append(`
                        <div class="message_customer message-right">
                            <div class="message-bubble">${message}</div>
                            <div class="message-time">Just now</div>
                        </div>
                    `);
                        $input.val('');
                        $messagesContainer.scrollTop($messagesContainer[0].scrollHeight);
                    }
                },
                error: function() {
                    alert('Error sending message');
                },
                complete: function() {
                    $button.prop('disabled', false);
                    $form.data('submitting', false);
                }
            });
        });
    });


    $(document).on('click', '.remove_right_wrap',  function() {
        const $wrapper = $(this).closest('.leads_user_index_sec');
        const $chatBox = $wrapper.find('.customer_leads_chat_w_two');
        $chatBox.hide();
        $wrapper.removeClass('active');
    });

</script>