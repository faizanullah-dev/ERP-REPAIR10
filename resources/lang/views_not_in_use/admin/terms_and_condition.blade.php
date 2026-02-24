@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush

@section('content')
<section class="terms_and_condition_section pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card borderRadius20 box-shadow-card border-0">
                    <div class="card-headerr">
                        <h5>Terms & Condition</h5>
                         <a href="{{ url('/termAndCondition/term-and-condition/' . $termsAndCondition->id . '/edit') }}" class="button create_btn borderRadius">Edit</a>
                        <i class="fa fa-info-circle"></i>
                    </div>
                    <hr>
                    <div class="card-body">
                        {!! $termsAndCondition->description??"" !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection