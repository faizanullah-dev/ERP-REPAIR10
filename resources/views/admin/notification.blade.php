@extends('layouts.master')
@section('content')
    <div class="white-box">
        <div id="taf-tabs" class="taf_tabs">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="outer_inputs mb-2 d-flex align-items-center col-md-1">
                                    <input class="  noti_check mt-0 " type="checkbox" name="notify_check" id="notify_check">
                                    <label for="notify_check"></label>
                                    <div class="button_logo m-0" >
                                        <button type="button" class="btn borderRadius delete_inbox_email" data-notification-id="" id="btn-delete-multiple" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"> <span class="fa fa-trash-o"></span> </button>
                                    </div>
                                </div>

                            </div>
                            <div class="scrollable-content taf_tabs_inner" style="background-color: #f1f1f1">
                                @foreach($notificationList as $notification)
                                    @if(auth()->id() == 2 || $notification->user_id == auth()->id())
                                    <div class="message-center" data-status="unseen" data-notification-id="{{ $notification->id }}" id="notification_status" style="background-color: white">
                                        <div class="message_icon_parent_wrapper" >
                                            <input class="noti_check noti_checks m-0 " type="checkbox" data-notifyCheck-id="{{ $notification->id }}" name="" id="">
                                            <div class="message_icon_parent">
                                                <div class="message_icon_container">
                                                    @if($notification->model == 'lead')
                                                        <i class="fa-solid fa-magnet"></i>
                                                    @elseif($notification->model == 'photoAndDocument')
                                                        <i class="fa-solid fa-panorama"></i>
                                                    @elseif($notification->model == 'receivePayment')
                                                        <i class="fa-solid fa-money-check-dollar"></i>
                                                    @elseif($notification->model == 'jobNote')
                                                        <i class="fa-solid fa-clipboard"></i>
                                                    @elseif($notification->model == 'proposal')
                                                        <i class="fa-solid fa-briefcase"></i>
                                                    @elseif($notification->model == 'stage')
                                                        <i class="fa-solid fa-bars-staggered"></i>
                                                    @elseif($notification->model == 'email')
                                                        <i class="fa-solid fa-envelope"></i>
                                                    @elseif($notification->model == 'task')
                                                        <i class="fa-solid fa-list-check"></i>
                                                    @elseif($notification->model == 'materail')
                                                        <i class="fa-solid fa-cubes-stacked"></i>
                                                    @elseif($notification->model == 'appointment')
                                                        <i class="fa-solid fa-calendar-check"></i>
                                                    @elseif($notification->model == 'changeOrder')
                                                        <i class="fa-regular fa-square-plus"></i>
                                                    @else
                                                        <i class="fa-solid fa-bell"></i>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="mail-contnet">
                                                <h5>{{ $notification->model }}</h5>
                                                <div class="mail_contnet_heading_time" >
                                                    <span class="mail-desc">
                                                        @if($notification->model == 'lead')
                                                            A new Lead name " {{$notification->title??""}} " has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'photoAndDocument')
                                                            Documents have been created for the {{$notification->lead->title??""}}
                                                        @elseif($notification->model == 'receivePayment')
                                                            A payment of amount ${{ number_format(floatval($notification->getReceivePayment->amount ?? "")) }} has been created against the lead "{{$notification->lead->title ?? ""}}" by "{{$notification->user->name ?? ""}}"
                                                        @elseif($notification->model == 'jobNote')
                                                            New notes have been added against the lead " {{$notification->getLead->title??""}} "
                                                        @elseif($notification->model == 'proposal')
                                                            A new proposal has been created for the lead " {{$notification->lead->title??""}} "
                                                        @elseif($notification->model == 'stage')
                                                            A new stage ( {{ $notification->title??"" }} ) has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'Email Create')
                                                            @if(isset($lead->customer) && $lead->customer->name)    An email has been sent to the customer " {{ $lead->customer->name }} " associated with the lead @endif
                                                        @elseif($notification->model == 'Lead Price Update')
                                                            The lead price has been updated to ' {{ number_format($lead->lead_price) }} '
                                                        @elseif($notification->model == 'task')
                                                            A task has been created for the lead " {{$notification->lead->title??""}} " by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'material')
                                                            Materials have been created for the lead " {{$notification->title??""}} "
                                                        @elseif($notification->model == 'appointment')
                                                            An appointment "{{ $notification->title??"" }}" has been created against lead "{{ $notification->lead->title ??'' }}" by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'changeOrder')
                                                            A change order for the lead " {{$notification->lead->title??""}} " has been created
                                                        @elseif($notification->model == 'mark')
                                                            A Mark name "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'user')
                                                            A User "{{ $notification->title }}" assigned role "{{ optional(optional($notification->getUser)->roles)->first()->name ?? 'Not specified' }}" has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'category')
                                                            A new Category "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'team')
                                                            A new Team "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'priority')
                                                            A new Priority "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'campaign')
                                                            A new Campaign "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'proposalTemplate')
                                                            A new Proposal Template name "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} "
                                                        @elseif($notification->model == 'emailTemplate')
                                                            A new Email Template "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} "
                                                        @else
                                                            {{ $notification->title }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="time">{{ $notification->created_at->format('l, h:i A d-M-Y') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-end">
{{--                                            <button type="button"--}}
{{--                                                    class="btn-lg btn-danger border-0 delete_inbox_email btn-delete"--}}
{{--                                                    data-notification-id="{{ $notification->id }}">--}}
{{--                                                <span class="fa fa-trash"></span>--}}
{{--                                            </button>--}}
                                            <div class="button_logo m-0" >
                                                <button type="button" class="btn borderRadius delete_inbox_email btn-delete" data-notification-id="{{ $notification->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"> <span class="fa fa-trash-o"></span> </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script>
        $(document).on('click', '.btn-delete', function (event) {
            event.preventDefault();
            var notificationID = $(this).attr('data-notification-id');
            var clickedButton = $(this);

            // Show confirmation dialog
            Swal.fire({
                title: 'Are You Sure You Want To Delete This Notification?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if (result.isConfirmed) {
                    deleteNotification(notificationID, clickedButton);
                }
            });
        });

        function deleteNotification(notificationID, clickedButton) {
            $.ajax({
                url: "/notification/delete/" + notificationID,
                type: 'GET',
                data: {id: notificationID},
                success: function (response) {
                    clickedButton.closest('.message-center').remove();
                    var newCount = response.unseenCount;
                    $('#notifi-count').text(newCount);
                    if(response.status == "success"){
                        Swal.fire({
                            title: "Notification Deleted Successfully",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        });
                    }
                    console.log('Delete Response:', response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Delete Error:', textStatus, errorThrown);
                }
            });
        }

        $(document).ready(function () {
            $('#notify_check').change(function () {
                if (this.checked) {
                    $('.noti_checks').prop('checked', true);
                } else {
                    $('.noti_checks').prop('checked', false);
                }
            });
        });

        $(document).on('click', '#btn-delete-multiple', function (event) {
            event.preventDefault();
            var selectedNotificationIDs = $('.noti_checks:checked').length;
            if (selectedNotificationIDs.length === 0) {
                Swal.fire('Warning!', 'Please select at least one customer to delete.', 'warning');
                return;
            }
            showConfirmationDialog();
        });

        function showConfirmationDialog() {
            Swal.fire({
                title: 'Are You Sure You Want To Delete The Notification?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    deleteSelectedCustomers();
                }
            });
        }
        function deleteSelectedCustomers() {
            var clickedButton = $(this);
            selectedNotificationIDs = [];
            $('.noti_checks:checked').each(function () {
                selectedNotificationIDs.push($(this).attr('data-notifyCheck-id'));
            });
            $.ajax({
                url: "/notification/delete/multiple",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    ids: selectedNotificationIDs
                },
                success: function (response) {
                    selectedNotificationIDs.forEach(function (id) {
                        $('.noti_checks[data-notifyCheck-id="' + id + '"]').closest('.message-center').remove();
                        var newCount = response.unseenCount;
                        $('#notifi-count').text(newCount);
                    });
                    if (response.status == "success") {
                        Swal.fire({
                            title: "Selected Notifications Deleted Successfully",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        });
                    }
                    console.log('Delete IDS:', selectedNotificationIDs);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Delete Error:', textStatus, errorThrown);
                }
            });
        }
    </script>
@endpush
