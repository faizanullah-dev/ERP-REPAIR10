@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'TermAndCondition') }}</h3>
                    @can('view-'.str_slug('TermAndCondition'))
                    <a  class="btn btn-success pull-right" href="{{url('/termAndCondition/term-and-condition')}}"><i class="icon-arrow-left-circle"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'TermAndCondition') }}</a>
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

                    <form method="POST" action="{{ url('/termAndCondition/term-and-condition') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="term_and_condition_create">
                        {{ csrf_field() }}

                        @include ('termAndCondition.term-and-condition.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
