<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content my-0">
        <div class="modal-header">
            <h5 class="modal-title">Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }}</h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <div class="modal-body">

            <div class="clearfix"></div>
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ url('/team/team/' . $team->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}


{{--                 @include ('team.team.form', ['submitButtonText' => 'Update'])--}}


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="name" class="control-label">{{ 'Name' }}</label>
                            {{--            <input class="form-control" placeholder="Enter team name" name="name" type="text" id="name" value="{{ $team->getUserTeam->pluck('name')??''}}"  required>--}}
                            <input class="form-control" placeholder="Enter team name" name="name" type="text" id="name" value="{{ $team->name??''}}"  required>
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                            <label for="assign_to_user_id" class="control-label">{{ 'Users' }}</label>
                            <select class="form-control  borderRadius custom_modal_select2" multiple name="user_team_id[]" id="user_team_id" required>
                                @foreach ($roles as $role)
                                    @if ($role->name !== 'admin' && $role->name !== 'user')
                                        <optgroup label="{{ $role->name }}">
                                            @foreach ($role->users as $user)
                                                <option value="{{ $user->id }}" @if(isset($team) && in_array($user->id, $team->getUserTeam->pluck('user_id')->toArray())) selected @endif>
                                                    {{--                                <option value="{{ $user->id }}">--}}
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
                        <div class="form-group text-center mt-3">
                            <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
