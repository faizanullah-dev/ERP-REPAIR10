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
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculator') }}</h3>
                    @can('add-'.str_slug('RoofEstimateCalculator'))
                        <a class="btn btn-success pull-right" href="{{ url('/roofEstimateCalculator/roof-estimate-calculator/create') }}"><i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculator') }}</a>
{{--                        <a class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#roofMarginModal"><i class="icon-plus"></i> Add Margin Profit</a>--}}
                        <a class="btn btn-success pull-right" href="{{ url('roof_base') }}"><i class="icon-plus"></i> Add Roof Base Value</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Lead</th>
                                    <th>Final Eave Rakes</th>
                                    <th>Final Flat Areas</th>
                                    <th>Total SQ</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($roofestimatecalculator as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->Lead->title??'' }}</td>
                                    <td>{{ number_format($item->total_eave_rakes ?? 0, 2) }}</td>
                                    <td>{{ number_format($item->total_eave_flat_area ?? 0, 2) }}</td>
                                    <td>{{ number_format($item->total_sq ?? 0, 2) }}</td>

                                    <td class="btn_td">
                                        @can('view-'.str_slug('RoofEstimateCalculator'))
                                            {{--                                            <a href="{{ url('/roofEstimateCalculator/roof-estimate-calculator/' . $item->id) }}"--}}
                                            <a href="{{ url('roof_estimation_calculator/' . $item->lead_id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculator') }}">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

{{--                                        @can('edit-'.str_slug('RoofEstimateCalculator'))--}}
{{--                                            <a href="{{ url('/roofEstimateCalculator/roof-estimate-calculator/' . $item->id . '/edit') }}"--}}
{{--                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculator') }}">--}}
{{--                                                <button class="btn btn-primary btn-sm">--}}
{{--                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}

                                        @can('delete-'.str_slug('RoofEstimateCalculator'))
                                            <form method="POST"
                                                  action="{{ url('/roofEstimateCalculator/roof-estimate-calculator' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="button" class="btn delete_btn btn-sm sweet_delete_btn"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculator') }}">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>

                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $roofestimatecalculator->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div id="roofMarginModal" class="modal fade" tabindex="-1" aria-labelledby="roofMarginModal" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content mx-auto max_width_500">--}}
{{--            <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="roofMarginModalLabel">Margin Profit Percent</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body" id="myModal">--}}
{{--                <form action="{{ route('store_roof_margin_profit') }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <div class="mb-3">--}}
{{--                        <label for="tax" class="form-label">Margin Profit (in percentage):</label>--}}
{{--                        <input type="number" class="form-control" name="roof_margin_profit" min="0" max="100" placeholder="Enter margin profit" value="{{ $roofBase->roof_margin_profit??'' }}">--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer mt-4 pt-4 pb-0">--}}
{{--                            <button id="submitBtn" class="btn btn-green d-block mx-auto save" type="submit">Save</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Progress Board Modal  -->--}}
{{--</div>--}}
@endsection


@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
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
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
    </script>
    <script>
        $(document).on('click', '.sweet_delete_btn', function (e) {
            e.preventDefault();

            let $form = $(this).closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ensure form exists and is not blocked
                    if ($form.length > 0) {
                        $form[0].submit(); // Native DOM submit
                    } else {
                        console.error('Form not found');
                    }
                }
            });
        });

    </script>
@endpush
