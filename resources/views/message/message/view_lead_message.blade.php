<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Message Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                    <input name="view_lead" value="1" type="hidden">
                    <div class="mb-3" id="radio_amount">
                        <label for="taxable" class="form-label">lead</label>
                      <input type="text" class="form-control" value="{{ $message->getLead->title??"" }}" readonly>
                    </div>
                    <div class="">
                        {{--<textarea class="form-control" rows="5" type="textarea" readonly id="message_description" value="{{ $message->message??"" }}">{!! strip_tags($message->message??"Not Available") !!}</textarea>--}}
                        <p>{!! strip_tags($message->message??"Not Available") !!}</p>

                    </div>
                    <div>
                    </div>
            </div>
        </div>
    </div>
</div>
