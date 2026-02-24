@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="container-fluid create_template">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box template_white_box">
                    <h3 class="box-title pull-left">Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductTemplate') }} #{{ $producttemplate->id }}</h3>
                    @can('view-'.str_slug('ProductTemplate'))
                        <a class="btn btn-success pull-right" href="{{ url('/productTemplate/product-template') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
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

                    <form method="POST" action="{{ url('/productTemplate/product-template/' . $producttemplate->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        @include ('productTemplate.product-template.form', ['submitButtonText' => 'Update'])

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
