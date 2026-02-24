@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer') }} #{{ $customer->id }}</h3>
                    @can('view-'.str_slug('Customer'))
                        <a class="btn btn-success pull-right" href="{{ url('/customer/customer') }}">
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

                    <form method="POST" action="{{ url('/customer/customer/' . $customer->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        @include ('customer.customer.form', ['submitButtonText' => 'Update'])

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();

            var tableFields = $('.table-fields'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(tableFields);

            newEntry.find('input').val('');
            tableFields.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="fa fa-minus"></span>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });

        $(document).on('click', '.btn-add2', function (e) {
            e.preventDefault();

            var tableFields = $('.table-fields2'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(tableFields);

            newEntry.find('input').val('');
            tableFields.find('.entry:not(:last) .btn-add2')
                .removeClass('btn-add2').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="fa fa-minus"></span>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
    
    </script>
@endpush