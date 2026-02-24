@extends('layouts.master')

@section('content')

    <div class="container-fluid">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
               
                    <div class=" d-flex align-item-center justify-content-between ">
                    <h3 class="box-title pull-left d-flex align-item-center ">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'PhotoAndDocument') }}</h3>
                    @can('view-'.str_slug('PhotoAndDocument'))
                    <a  class="btn btn-success pull-right" href="{{url('/photoAndDocument/photo-and-document')}}"><i class="icon-arrow-left-circle"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'PhotoAndDocument') }}</a>
                    @endcan
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/photoAndDocument/photo-and-document') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('photoAndDocument.photo-and-document.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
