@extends('layouts.master')
@push('css')
    <style>
        .goal-field {
            display: none;
            margin-top: 15px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'YearEstimation') }}</h3>
                    @can('view-'.str_slug('YearEstimation'))
                        <a class="btn btn-success pull-right" href="{{ url('/yearEstimation/year-estimation') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <a class="btn btn-primary pull-right" id="analysis_form" href="javascript:void(0)">Analysis</a>

                    <div class="clearfix"></div>
                    <hr>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/yearEstimation/year-estimation') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="year_estimation_create_form">
                        {{ csrf_field() }}

                        @include ('yearEstimation.year-estimation.form')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="analysisModal" tabindex="-1" aria-labelledby="analysisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="analysisModalLabel">Year Estimation Analysis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-5">
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-primary p-3" id="aiAnalysisBtn">AI Analysis</button>
                        </div>
                        <div class="col-md-6 text-start">
                            <button type="button" class="btn btn-primary p-3" id="goalAnalysisBtn">Goal Analysis</button>
                        </div>
                    </div>

                    <div class="goal-field" id="goalFieldContainer">
                        <div class="mb-3 mt-3">
                            <label for="goalValue" class="form-label">Enter Goal Value:</label>
                            <input type="text" class="form-control" id="goalValue" placeholder="Enter your goal">
                        </div>
                        <button type="button" class="btn btn-primary" id="submitGoalBtn">Get Result</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#analysis_form').click(function() {
                $('#analysisModal').modal('show');
                $('#goalFieldContainer').hide();
            });

            $('#goalAnalysisBtn').click(function() {
                $('#goalFieldContainer').toggle();
            });

            // GOAL ANALYSIS
            $('#submitGoalBtn').click(async function() {
                const goalValue = $('#goalValue').val().trim();
                if (!goalValue) {
                    alert('Please enter a goal value');
                    return;
                }

                const $btn = $(this);
                if ($btn.data('downloading')) return;
                $btn.data('downloading', true)
                    .prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm"></span> Processing...');

                try {
                    const response = await fetch('{{url("goal_analysis")}}?goal=' + encodeURIComponent(goalValue), {
                        headers: {
                            'Accept': 'application/zip',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const blob = await response.blob();
                    const url = URL.createObjectURL(blob);

                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'goal_analysis_' + goalValue + '.zip';
                    document.body.appendChild(a);
                    a.click();

                    setTimeout(() => {
                        URL.revokeObjectURL(url);
                        document.body.removeChild(a);
                        $btn.data('downloading', false)
                            .prop('disabled', false)
                            .html('Submit Goal');
                    }, 100);

                } catch (error) {
                    console.error('Download failed:', error);
                    $btn.data('downloading', false)
                        .prop('disabled', false)
                        .html('Submit Goal');
                    alert('Error processing your goal. Please try again.');
                }
            });



            //HISTORICAL ANALYSIS
            $('#aiAnalysisBtn').click(async function(){
                const $btn = $(this);
                if ($btn.data('downloading')) return;
                $btn.data('downloading', true);

                $btn.prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm"></span> Processing...');

                try {
                    const response = await fetch('{{url("historical_analysis")}}?t=' + Date.now());
                    const blob = await response.blob();
                    const url = URL.createObjectURL(blob);

                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'sales_prediction_package.zip';
                    a.style.display = 'none';
                    document.body.appendChild(a);
                    a.click();

                    // Cleanup
                    setTimeout(() => {
                        URL.revokeObjectURL(url);
                        document.body.removeChild(a);
                        $btn.data('downloading', false)
                            .prop('disabled', false)
                            .html('AI Analysis');
                    }, 100);
                } catch (error) {
                    console.error('Download failed:', error);
                    $btn.data('downloading', false)
                        .prop('disabled', false)
                        .html('AI Analysis');
                    alert('Download failed. Please try again.');
                }
            });
        });
    </script>
@endpush
