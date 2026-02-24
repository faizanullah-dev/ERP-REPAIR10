@extends('layouts.master')

@push('css')
    <style>
        .leads_user_index_sec .customer_leads_gutter_wrap{z-index: 0;}
        .button_view_wrap a{z-index: 999;position: relative;}
    </style>
@endpush

@section('content')
    <section class="leads_user_index_sec">
        <div class="container-fluid">
            <div class="leads_user_index_wrapper">
                <div class="customer_leads_wrapper_w_one">
                    <div class="row customer_row_flex">
                        <div class="col-md-12">
                            <div class="white-box">
                                <h3> Leads </h3>
                                <div class="customer_leads_gutter_all_cards_wrap">


                                    @foreach($leads->where('lead_status', '!=', 'won') as $lead)
                                    <div class="customer_leads_gutter_wrap chat_show_hide_wrapper" data-lead-id="{{ $lead->id }}">
                                        <div class="txt_img_button">
                                            <div class="text_img_wrap">
                                                <a href="javascript:void(0)" class="">
                                                    <div class="image_wrap">
                                                        <div>

                                                            <img src="{{ asset('website/images/customer_p.png') }}" alt="Logo">

                                                        </div>
                                                    </div>
                                                    <h4>{{$lead->title??'-'}}</h4>
                                                </a>
                                            </div>
                                            @if($lead->lead_status == 'pending')
                                                <button type="button" class="btn btn-pending-lead">
                                                    {{$lead->lead_status??'-'}}
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-lost-lead">
                                                    {{$lead->lead_status??'-'}}
                                                </button>
                                            @endif
                                        </div>
                                        <div class="customer_gutter_list_wrap">
                                            <ul>
                                                <li><b>Category:</b> {{$lead->category->name??'-'}}</li>
                                                <li><b>Lead Number:</b> {{$lead->lead_number??'-'}}</li>
                                                <li><b>Address:</b> {{$lead->address??'-'}}</li>
                                            </ul>
                                        </div>
                                        <div class="button_view_wrap">
                                            <a href="{{url('customer-management')}}/{{$lead->id}}"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="white-box">
                                <h3> My Projects </h3>
                                <div class="customer_leads_gutter_all_cards_wrap">

                                    @foreach($leads->where('lead_status', 'won') as $lead)
                                    <div class="customer_leads_gutter_wrap">
                                        <div class="txt_img_button">
                                            <div class="text_img_wrap">
                                                <a href="javascript:void(0)" class="">
                                                    <div class="image_wrap">
                                                        <div>

                                                            <img src="{{ asset('website/images/customer_p.png') }}" alt="Logo">

                                                        </div>
                                                    </div>
                                                    <h4>{{$lead->title??'-'}}</h4>
                                                </a>
                                            </div>
                                            <button  type="submit" class="btn btn_green">{{$lead->lead_status??'-'}}</button>
                                        </div>
                                        <div class="customer_gutter_list_wrap">
                                            <ul>
                                                <li><b>Category:</b> {{$lead->category->name??'-'}}</li>
                                                <li><b>Lead Number:</b> {{$lead->lead_number??'-'}}</li>
                                                <li><b>Address:</b> {{$lead->address??'-'}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="customer_leads_chat_w_two">

                </div>
            </div>

        </div>
    </section>

@endsection

@push('js')
    {{--    show hide chat --}}
    <script>
        $(document).ready(function () {
            $('.button_view_wrap a').on('click', function (e) {
                e.stopPropagation();
            });

            $('.chat_show_hide_wrapper').on('click', function () {
                const leadId = $(this).data('lead-id');
                const $wrapper = $(this).closest('.leads_user_index_wrapper');
                const $chatBox = $wrapper.find('.customer_leads_chat_w_two');

                // Hide all chat boxes first
                $('.customer_leads_chat_w_two').hide();
                $('.leads_user_index_wrapper').removeClass('active');

                // Show loading state
                $chatBox.html('<div class="text-center py-4">Loading chat...</div>').show();

                // Fetch chat data via AJAX
                $.ajax({
                    url: '{{url("get_lead_chat")}}', // Your route to fetch chat
                    method: 'GET',
                    data: { lead_id: leadId },
                    success: function(response) {
                        $chatBox.html(response);
                        $wrapper.addClass('active');

                        // Scroll to bottom of chat
                        const $messages = $chatBox.find('.chat-messages');
                        $messages.scrollTop($messages[0].scrollHeight);
                    },
                    error: function() {
                        $chatBox.html('<div class="text-center py-4">Error loading chat</div>');
                    }
                });
            });


        });
    </script>
{{--    chat functionaity--}}
{{--    <script>--}}
{{--        $('.sendButton').on('click', function () {--}}
{{--            const $input = $('.messageInput');--}}
{{--            const message = $.trim($input.val());--}}

{{--            if (message) {--}}
{{--                const $messagesContainer = $('.chat-messages');--}}
{{--                const now = new Date();--}}
{{--                const timeString = now.toLocaleTimeString('en-US', {--}}
{{--                    hour: 'numeric',--}}
{{--                    minute: '2-digit',--}}
{{--                    hour12: true--}}
{{--                });--}}

{{--                const $lastMessage = $messagesContainer.find('.message_customer.message-right').last();--}}
{{--                const $lastTime = $lastMessage.find('.message-time');--}}
{{--                const lastTimeText = $lastTime.text().trim();--}}

{{--                let showTime = true;--}}

{{--                if (lastTimeText === timeString) {--}}
{{--                    // Remove last time to avoid duplicate--}}
{{--                    $lastTime.remove();--}}
{{--                }--}}

{{--                const $messageDiv = $('<div>', { class: 'message_customer message-right' });--}}
{{--                $messageDiv.html(`<div class="message-bubble">${message}</div><div class="message-time">${timeString}</div>`);--}}

{{--                $messagesContainer.append($messageDiv);--}}
{{--                $messagesContainer.scrollTop($messagesContainer[0].scrollHeight);--}}
{{--                $input.val('');--}}
{{--            }--}}
{{--        });--}}

{{--        $('.messageInput').on('keypress', function (e) {--}}
{{--            if (e.key === 'Enter') {--}}
{{--                $('.sendButton').click();--}}
{{--            }--}}
{{--        });--}}
{{--        // Enable/disable send button based on input--}}
{{--        $('.messageInput').on('input', function () {--}}
{{--            const message = $.trim($(this).val());--}}
{{--            $('.sendButton').prop('disabled', message === '');--}}
{{--        });--}}


{{--    </script>--}}
@endpush

