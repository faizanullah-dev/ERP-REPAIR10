@extends('layouts.master')

@push('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
{{--                <div class="white-box">--}}
{{--                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointment') }}</h3>--}}
{{--                    @can('view-'.str_slug('Appointment'))--}}
{{--                        <a class="btn btn-success pull-right" href="{{ url('/appointment/appointment') }}">--}}
{{--                            <i class="icon-arrow-left-circle"></i>{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Back') }}--}}
{{--                        </a>--}}
{{--                    @endcan--}}

{{--                    <div class="clearfix"></div>--}}
{{--                    <hr>--}}
{{--                    @if ($errors->any())--}}
{{--                        <ul class="alert alert-danger">--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @endif--}}
{{--                </div>--}}

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $('.clr_input_fields').select2();
    </script>
    <script>
        document.querySelector('.btn-success').addEventListener('click', function (event) {
            event.preventDefault();
            window.location.href = '{{ url()->previous() }}';
        });
    </script>
@endpush
