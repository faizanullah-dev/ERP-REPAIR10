@if($notificationList->count() > 0)
    @foreach($notificationList as $notification)
        <div class="message-center" data-status="unseen" data-notification-id="{{ $notification->id }}" >
            <div class="message_icon_parent">
                <div class="message_icon_container">
                    <i class="{{ $notification->icon ??'' }}"></i>
                </div>
            </div>
            <div class="mail-content">
                <div class="message_heading_time">
                    <h6>{{ $notification->model }}</h6>
                    <span class="green_text">{{ $notification->created_at->format('l, h:i A d-M-Y') }}</span>
                </div>
                <p class="mail-desc">{!! $notification->title !!} {{ $notification->user->name??"" }}.</p>
            </div>
        </div>
    @endforeach
@endif