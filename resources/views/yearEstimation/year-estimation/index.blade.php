@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'YearEstimation') }} (Target)</h3>
                    @can('add-'.str_slug('YearEstimation'))
                        <a class="btn btn-success pull-right" href="{{ url('/yearEstimation/year-estimation/create') }}">
                        <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'YearEstimation') }}</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="no-sort">Status</th>
                                        <th>Year</th>
                                        <th>Estimate Amount ($)</th>
                                        <th>Amount Per Job ($)</th>
                                        <th class="no-sort">Result</th>
                                        <th>Conversion Ratio (%)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            <tbody>
                            @foreach($yearestimation as $item)
                                <tr>
                                    <td>
                                        <input type="radio" name="status" id="{{$item->id}}" status="{{$item->status}}" @if($item->status == 1) checked @endif class="edit_status switch month_id" data-color="#13dafe">
                                    </td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ number_format(floatval($item->estimate_amount ?? 0), 2) }}</td>
                                    <td>{{ number_format(floatval($item->amount_per_job ?? 0), 2) }}</td>
                                    <td>
                                        @php
                                            $achievedPercentage = 0;
                                            if ($item->estimate_amount > 0){
                                                $achievedPercentage = ($item->leadsum / $item->estimate_amount) * 100;
                                            }//end if..
                                        @endphp
                                        <div class="progress progress-xs margin-vertical-10">
                                            <div class="progress-bar progress-bar-warning" style="width: {{ $achievedPercentage }}%"></div>
                                        </div>
                                    </td>
                                    <td>{{ number_format((float) ($item->job_convertion_ratio ?? 0), 2) }}</td>
                                    <td>
                                        <div class="btn_td">
                                        @can('view-'.str_slug('YearEstimation'))
                                                @if($financeSheet->contains('year_estimation_id', $item->id))
                                                    <a href="{{ url('view_estimation/' . $item->id) }}">
                                                        <button class="btn view_btn btn-sm">
                                                            <i class="fa-solid fa-link"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{ url('create_new_year_estimate/' . $item->id) }}">
                                                        <button class="btn view_btn btn-sm">
                                                            <i class="fa-solid fa-link"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            @endcan
                                        @can('view-'.str_slug('YearEstimation'))
                                            <a href="{{ url('yearly_report/' . $item->id) }}" title="Yearly Report">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-file"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('view-'.str_slug('YearEstimation'))
                                            <a href="{{ url('/yearEstimation/year-estimation/' . $item->id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'YearEstimation') }}">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('edit-'.str_slug('YearEstimation'))
                                            <a href="{{ url('/yearEstimation/year-estimation/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'YearEstimation') }}">
                                                <button class="btn edit_btn btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('delete-'.str_slug('YearEstimation'))

                                                <form method="POST"
                                                      action="{{ url('/yearEstimation/year-estimation' . '/' . $item->id) }}"
                                                      accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="btn delete_btn btn-sm"
                                                            title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'YearEstimation') }}"
                                                            onclick="showDeleteConfirmation(this)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                        @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
{{--                        <div class="pagination-wrapper"> {!! $yearestimation->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })
        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1], /* 1st one, start by the right */
                    "targets": 'no-sort',
                    "orderable": false,
                }]
                // "columnDefs": [ {
                //     "targets": 'no-sort',
                //     "orderable": false,
                // } ]
            });

        });
        $(document).on('click', '.edit_status', function(e) {
            var id = $(this).attr('id'); // Correctly capture the ID
            var status = $(this).attr('status'); // Correctly capture the status
            $.ajax({
                url: "{{ url('edit_status_year_esstimation') }}",
                type: "POST",
                data: {
                    id: id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message == 'Status Updated!') {
                        Swal.fire({
                            title: 'Updated!',
                            text: 'The status has been updated.',
                            icon: 'success',
                            timer: 2000,
                        }).then((result) => {
                            location.reload();
                        });
                    }//ends if..
                },
            });
        });
    </script>
@endpush
