<div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
    <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Users' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields borderRadius select2" multiple name="assign_announcement_user_id[]" id="user_id" required>
            @foreach ($users as $user)
                <option value="{{$user->id}}" @if(isset($announcement) && in_array($user->id, $announcement->getAnnouncementUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}}</option>
            @endforeach
        </select>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('announcement') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ $announcement->description??''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>

@push('js')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
</script>
@endpush