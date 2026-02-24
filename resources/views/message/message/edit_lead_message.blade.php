<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Message Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/message/message/' . $message->id) }}" method="POST">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
            <div class="modal-body">
                <input name="view_lead" value="1" type="hidden">
                <div class="mb-3" id="radio_amount">
                    <label for="taxable" class="form-label">Lead</label>
                    <select class="select2-message form-control clr_input_fields select2 borderRadius" name="lead_id" id="">
                        @foreach($leads as $lead)
                            <option value="{{$lead->id}}" @if(isset($message) && $lead->id == $message->lead_id) selected @endif>{{$lead->title}}</option>--}}
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <textarea class="form-control" rows="5" type="textarea" name="message" id="message_description" value="{!! $message->message??"" !!} ">{!! strip_tags($message->message??"") !!}</textarea>
                </div>
                <div class="d-flex justify-content-center save">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@push('js')

<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

{{--<script type="text/javascript">--}}
    {{--$(document).ready(function() {--}}
        {{--CKEDITOR.replace('message_description');--}}
    {{--});--}}
</script>
@endpush