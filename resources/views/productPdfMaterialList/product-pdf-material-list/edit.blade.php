@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPdfMaterialList') }} #{{ $productpdfmateriallist->id }}</h3>
                    @can('view-'.str_slug('ProductPdfMaterialList'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPdfMaterialList/product-pdf-material-list') }}">
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

                    <form method="POST" action="{{ url('/productPdfMaterialList/product-pdf-material-list/' . $productpdfmateriallist->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        @include ('productPdfMaterialList.product-pdf-material-list.form', ['submitButtonText' => 'Update'])

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
