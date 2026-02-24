<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields select2 borderRadius" name="lead_id" id="lead_id" required>
            @foreach($leads as $lead)
                <option value="{{$lead->id}}" @if(isset($workcrew)  && $lead->id == $workcrew->lead_id) selected @endif >{{$lead->title}}</option>
            @endforeach

        </select>
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="col-md-4 control-label">{{ 'Category' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields borderRadius" name="category_id" id="category_id" required>
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if(isset($workcrew)  && $category->id == $workcrew->category_id) selected @endif >{{$category->name}}</option>
            @endforeach

        </select>
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
    <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Job Represantative' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields borderRadius select2" multiple name="job_representative_id[]" id="user_id" required>
            @foreach ($salesmens as $user)
                <option value="{{$user->id}}" @if(isset($workcrew) && in_array($user->id, $workcrew->getWorkCrewJobRepresantative->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}}</option>
            @endforeach
        </select>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
    <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Company Crew' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields borderRadius select2" multiple name="company_crew_id[]" id="user_id" required>
            @foreach ($salesmens as $user)
                <option value="{{$user->id}}" @if(isset($workcrew) && in_array($user->id, $workcrew->getWorkCrewCompanyCrew->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}}</option>
            @endforeach
        </select>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
    <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Labour' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields borderRadius select2" multiple name="labour_id[]" id="user_id" required>
            @foreach ($users as $user)
                <option value="{{$user->id}}" @if(isset($workcrew) && in_array($user->id, $workcrew->getWorkCrewLabour->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}}</option>
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
