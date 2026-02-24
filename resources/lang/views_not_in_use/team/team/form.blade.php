<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" placeholder="Enter team name" name="name" type="text" id="name" value="{{ $team->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
    <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Users' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields borderRadius select2" multiple name="user_team_id[]" id="user_team_id" required>
            @foreach ($users as $user)
                <option value="{{$user->id}}" @if(isset($team) && in_array($user->id, $team->getUserTeam->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}}</option>
            @endforeach
        </select>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
