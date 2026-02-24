@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box" style="height: 100%" >
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailTemplate') }}</h3>
                    @can('view-'.str_slug('EmailTemplate'))
                    <a  class="btn btn-success pull-right" href="{{url('/emailTemplate/email-template')}}"><i class="icon-arrow-left-circle"></i> {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Back') }}</a>
                    @endcan

                    <div class="clearfix"></div>
                    <hr>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/emailTemplate/email-template') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="emailtemplatevalidate">
                        {{ csrf_field() }}

                        @include ('emailTemplate.email-template.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
