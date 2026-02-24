<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Name' }}</label>
            <input class="form-control" placeholder="Enter team name" name="name" type="text" id="name" value="{{ $team->name??''}}"  required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
            <label for="assign_to_user_id" class="control-label">{{ 'Users' }}</label>
            <select class="form-control  borderRadius select2" multiple name="user_team_id[]" id="user_team_id" required>
                @foreach ($roles as $role)
                    @if ($role->name !== 'admin' && $role->name !== 'user')
                        <optgroup label="{{ $role->name }}">
                            @foreach ($role->users as $user)
                                <option value="{{ $user->id }}" @if(isset($team) && in_array($user->id, $team->getUserTeam->pluck('user_id')->toArray())) selected @endif>
                                    {{ $user->name ?? "" }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endif
                @endforeach
            </select>
            {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
              <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
