@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('plugins/components/dropify/dist/css/dropify.min.css')}}">
@endpush
@section('content')

    <section class="proposal_page">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12">
                    <h4>Proposal</h4>
                    <p>Select Proposal Theme</p>
                </div>
                <div class="col-lg-4">
                    <div class="black_page proposal" data-target="black_page">
                        <div class="inner_content">

                        </div>
                    </div>
                    <p>Blank Page</p>
                </div>
                <div class="col-lg-4">
                    <div class="template_page proposal" data-target="template_page">
                        <div class="inner_content">
                            <div class="corner top-left"></div>
                            <div class="corner bottom-right"></div>
                        </div>
                    </div>
                    <p>Design 1</p>
                </div>
            </div>
        </div>
    </section>




@endsection

@push('js')
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>

    <script src="{{asset('plugins/components/dropify/dist/js/dropify.min.js')}}"></script>
    <script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.proposal').on('click', function() {
                var targetDiv = $(this).data('target');
                window.location.href = '{{ route('proposal_editor') }}?target=' + targetDiv;
            });
        });
    </script>


@endpush
