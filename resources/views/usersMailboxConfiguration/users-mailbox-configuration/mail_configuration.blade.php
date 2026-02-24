@extends('layouts.master')
@section('content')
    <section class="forms forms_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card white-box">
                        <div class="d-flex align-items-center">
                            <h4>{{__('Mail Configuration')}}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small>{{trans('The field labels marked with * are required input fields')}}.</small></p>
                            <form method="POST" id="mail_configurations_form" action="{{route('mail_configuration_store')}}" >
                                @csrf
                                {{--<input type="hidden" name="test_connection_hidden" id="test_connection_hidden" value="{{'false'??old('test_connection_hidden')}}">--}}
                                <input type="hidden" name="test_connection_hidden" id="test_connection_hidden" value="true">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label_custom"><strong>{{__('Mail Host')}} *</strong></label>
                                            <input type="text" name="mail_host" class="form-control_custom" placeholder="imap.gmail.com" value="{{$usersMailboxConfigurationData->mail_host??old('mail_host')}}" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label_custom"><strong>{{__('Mail Address')}} *</strong></label>
                                            <input type="text" name="mail_address" class="form-control_custom" placeholder="username@gmail.com" value="{{$usersMailboxConfigurationData->mail_username??old('mail_address')}}" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label_custom"><strong>{{__('Mail From Name')}} *</strong></label>
                                            <select class="form-control_custom selectpicker select2" name="protocol" data-live-search="true" data-live-search-style="contains" >
                                                <option value="imap" {{ old('protocol') == 'imap' ? "selected" : $usersMailboxConfigurationData->mail_protocol??''}}>IMAP</option>
                                                <option value="smtp" {{ old('protocol') == 'smtp' ? "selected" : $usersMailboxConfigurationData->mail_protocol??''}}>SMTP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label_custom"><strong>{{__('Mail Port')}} *</strong></label>
                                            <input type="number"  style="text-align: left" name="port" class="form-control_custom" placeholder="993" value="{{$usersMailboxConfigurationData->mail_port??old('port')}}" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label_custom"><strong>{{trans('file.Password')}} *</strong></label>
                                            <input type="password" name="password" class="form-control_custom" value="{{$usersMailboxConfigurationData->password??old('password')}}" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label_custom"><strong>{{trans('file.Encryption')}} *</strong></label>
                                            <select class="form-control_custom selectpicker select2" name="encryption" data-live-search="true" data-live-search-style="contains" >
                                                <option value="ssl" {{ old('encryption') == 'ssl' ? "selected" : $usersMailboxConfigurationData->mail_encryption_type??''}}>SSL</option>
                                                <option value="tls" {{ old('encryption') == 'tls' ? "selected" : $usersMailboxConfigurationData->mail_encryption_type??''}}>TLS</option>
                                                <option value="" {{ old('encryption') == 'Null' ? "selected" : $usersMailboxConfigurationData->mail_encryption_type??''}}>Null</option>
                                            </select>
                                        </div>
                                        <div class="form-group mail_configuration_save_btn">
                                            <input type="submit" value="Test Connection" class="btn btn-info test_smtp_connection">
                                            <input type="submit" value="Save" class="btn btn-primary save_connection">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
<script type="text/javascript">
    $(document).on('click', '.test_smtp_connection',function (e) {
        e.preventDefault();
        $('#test_connection_hidden').val('true');
        $('#mail_configurations_form').submit();
    });

</script>
@endpush
