<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
            <label for="lead_id" class="col-md-4 control-label">{{ 'Lead' }}</label>
            <select class="form-control   borderRadius assign_lead_readonly" name="lead_id" id="lead_id" required>
                @if(!empty($leadExist))
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @else
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($task) && $lead->id == $task->assign_to_lead_id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @endif
            </select>
            {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('follow_up_reminder') ? 'has-error' : ''}}">
            <label for="follow_up_reminder" class="col-md-4 control-label">{{ 'Follow Up Reminder' }} <span class="text-danger">*</span></label>
            <input class="form-control" name="follow_up_reminder" type="date" id="follow_up_reminder" value="{{ $followupcallnote->follow_up_reminder ?? $yearEstimation->year . '-01-01'}}">
            {!! $errors->first('follow_up_reminder', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
            <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Assign To User' }}</label>
            {{--<select class="form-control clr_input_fields select2 borderRadius js-example-basic-multiple"
                name="assign_to_user_id" id="assign_to_user_id">--}}
            <select class="form-control  borderRadius custom_modal_select2" multiple name="user_id[]" id="user_id" required data-placeholder="Select an Option">
                @foreach ($users as $user)
                    <option value="{{$user->id}}" @if(isset($followupcallnote) && in_array($user->id, $followupcallnote->getFollowUpCallNoteUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}}</option>
                @endforeach
            </select>
            {!! $errors->first('assign_to_user_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group follow_up_notes_mark_wrap {{ $errors->has('mark_id') ? 'has-error' : ''}}">
            <label for="mark_id" class="col-md-4 control-label">{{ 'Mark' }} <span class="text-danger">*</span></label>
            <div class="form-check form-check-inline follow_up_notes_mark_input_wrap">
                @foreach($marks as $key => $mark)
                    <input class="mx-3" type="radio" name="mark_id" id="mark{{ $key }}" value="{{ $mark->id }}" @if((!old('mark_id') && isset($followupcallnote) && $followupcallnote->mark_id == $mark->id) || (old('mark_id') == $mark->id)) checked @endif required>
                    <label class="form-check-label fs-4" for="mark{{ $key }}">{{ $mark->name }}</label>
                @endforeach
            </div>
            {!! $errors->first('mark_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
            <textarea class="form-control" rows="5" name="description" type="textarea" id="description">{{ $followupcallnote->description??''}}</textarea>
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-0 d-flex justify-content-center">
            <input class="btn btn-green" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    {{--<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>--}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Spaces are not allowed.");
            $.validator.addMethod("select2Required", function(value, element, params) {
                return $(element).val() ? true : false;
            }, "This field is required");
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "Message field is required");
            $("#followupcallnoteForm").validate({
                ignore: ":hidden:not(.select2-hidden-accessible)",
                rules: {
                    lead_id: {
                        required: true,
                        noSpace: true
                    },
                    follow_up_reminder: {
                        required: true,
                        noSpace: true
                    },
                    'user_id[]': {
                        select2Required: true
                    },
                    mark_id: {
                        required: true,
                        noSpace: true
                    },
                    description: {
                        ckrequired: true
                    }
                },

                messages: {
                    lead_id: {
                        required: "Please select lead",
                    },
                    follow_up_reminder: {
                        required: "Please select follow up reminder",
                    },
                    'user_id[]': {
                        select2Required: "Please select assign to user",
                    },
                    mark_id: {
                        required: "Please select mark",
                    },
                    description: {
                        ckrequired: "Message field is required"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass("select2-hidden-accessible")) {
                        error.insertAfter(element.next('span.select2'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });


        // $(document).ready(function () {
        //     CKEDITOR.replace('description');
        //     $(".select2").select2();
        // });
        $(document).ready(function() {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
@endpush
