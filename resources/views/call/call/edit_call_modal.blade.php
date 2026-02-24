<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Call</h4>
            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('update_call') }}" method="POST" accept-charset="UTF-8" class="form-horizontal">
                <input type="hidden" name="call_id" value="{{ $call->id??"" }}">
                @csrf
                <section class="task_form">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                    <label for="phone" class="control-label">{{ 'Phone*' }}</label>
                                    <input class="form-control" name="phone" id="phone" value="{{ $call->phone??''}}" readonly>
                                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
                                    <label for="time" class="control-label">{{ 'Time*' }}</label>
                                    <input class="form-control" type="time" name="time" value="{{ isset($call->time) ? date('H:i', strtotime($call->time)) : '' }}" required>
                                    {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
                                    <label for="duration" class="control-label">{{ 'Duration*' }}</label>
                                    <input class="form-control" type="text" name="duration" value="{{ $call->duration??''}}" required>
                                    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                                        <label for="date" class="control-label">{{ 'Date*' }}</label>
                                        <input class="form-control" type="date" name="date" value="{{ $call->date??''}}" required>
                                        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('notes') ? 'has-error' : ''}}">
                                    <label for="notes" class="control-label">{{ 'Notes*' }}</label>
                                    <textarea class="form-control" name="notes" value="{{ $call->notes??''}}" required>{{ $call->notes??"" }}</textarea>
                                    {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-center save col-md-offset-4 col-md-4">
                                <input class="btn btn-primary" type="submit" value="Update">
                            </div>
                        </div>
                </section>
                <script>
                </script>
            </form>
        </div>
    </div>
</div>

