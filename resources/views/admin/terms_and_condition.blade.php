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
                        <div class="heading pb-3">
                            <h5>Terms & Condition</h5>
                            <a data-bs-toggle="tooltip" data-bs-placement="left" title="Read Description Below">
                                <i class="fa fa-info-circle"></i>
                            </a>
                        </div>


                        <a href="{{ url('/termAndCondition/term-and-condition/' . $termsAndCondition->id . '/edit') }}" class="button create_btn borderRadius">Edit</a>
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
