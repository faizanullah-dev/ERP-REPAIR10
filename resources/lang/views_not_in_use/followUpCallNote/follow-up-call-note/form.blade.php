<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields select2 borderRadius" name="lead_id" id="lead_id" required>
            @foreach($leads as $lead)
                <option value="{{$lead->id}}" @if(isset($followupcallnote)  && $lead->id == $followupcallnote->lead_id) selected @endif >{{$lead->title}}</option>
            @endforeach
        </select>
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('mark_id') ? 'has-error' : ''}}">
    <label for="mark_id" class="col-md-4 control-label">{{ 'Mark' }}</label>
    <div class="col-md-6">
        <div class="form-check form-check-inline">
            @foreach($marks as $key => $mark)
                <input class="mx-3" type="radio" name="mark_id" id="mark{{ $key }}" value="{{ $mark->id }}"
                       @if(!old('mark_id') && $key === 0)
                       checked
                       @elseif(old('mark_id') == $mark->id)
                       checked
                        @endif>
                <label class="form-check-label fs-4" for="mark{{ $key }}">{{ $mark->name }}</label>
            @endforeach
        </div>
        {!! $errors->first('mark_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ $followupcallnote->description??''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('follow_up_reminder') ? 'has-error' : ''}}">
    <label for="follow_up_reminder" class="col-md-4 control-label">{{ 'Follow Up Reminder' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="follow_up_reminder" type="date" min="2023-05-17" id="follow_up_reminder" value="{{ $followupcallnote->follow_up_reminder??''}}" >
        {!! $errors->first('follow_up_reminder', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
    <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Assign To User' }}</label>
    <div class="col-md-6">
        {{--<select class="form-control clr_input_fields select2 borderRadius js-example-basic-multiple" name="assign_to_user_id" id="assign_to_user_id">--}}
        <select class="form-control clr_input_fields borderRadius select2" multiple name="user_id[]" id="user_id" required>
            @foreach ($users as $user)
                <option value="{{$user->id}}" @if(isset($followupcallnote) && in_array($user->id, $followupcallnote->getFollowUpCallNoteUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}}</option>
            @endforeach
        </select>
        {!! $errors->first('assign_to_user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
</script>
@endpush