@extends('layouts.master')

@push('css')
    <style>
        .error-message {
            color: red;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ReferralSource') }}</h3>
                    @can('view-'.str_slug('ReferralSource'))
                    <a  class="btn btn-success pull-right" href="{{url('/referralSource/referral-source')}}"><i class="icon-arrow-left-circle"></i> {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Back') }}</a>
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

                    <form method="POST" action="{{ url('/referralSource/referral-source') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="referral_source_form">
                        {{ csrf_field() }}
                        @include ('referralSource.referral-source.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function () {
        $('#referral_source_form').validate({
            rules: {
                name: {
                    required: true
                },
                status: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter name"
                },
                status: {
                    required: "Please select status"
                }
            },
            errorElement: "span",
            errorClass: "error-message",
        });
    });
</script>
@endpush
