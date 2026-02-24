@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <style>

    </style>
@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title pull-left"> Sub Contractor </h3>
                        <a class="btn btn-success pull-right" href="{{ url('sub_contractor_create') }}">Add Sub Contractor <i class="icon-plus"></i> </a>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Corporation</th>
                                    <th>Trades</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subcontractors as $subcontractor)
                                    <tr class="staff_check">
                                        <td>{{$subcontractor->subContractorCompany->name??''}}</td>
                                        <td>{{$subcontractor->subContractorCompany->email??''}}</td>
                                        <td>{{$subcontractor->subContractorCompany->city??''}}</td>
                                        <td>{{$subcontractor->subContractorCompany->corporation??''}}</td>
                                        <td>
                                            @php
                                                $tradeIds = json_decode($subcontractor->subContractorCompany->trades ?? '[]', true) ?? [];

                                                $tradeNames = $allTrades
                                                    ->whereIn('id', $tradeIds)
                                                    ->pluck('name')
                                                    ->filter()
                                                    ->values()
                                                    ->toArray();

                                                $displayLimit = 2;
                                                $visibleTrades = array_slice($tradeNames, 0, $displayLimit);
                                                $hiddenCount = count($tradeNames) - $displayLimit;
                                            @endphp

                                            @foreach($visibleTrades as $trade)
                                                <span class='badge badge-primary trades_status'>
                                                    {{ $trade }}
                                                </span>
                                            @endforeach

                                            @if($hiddenCount > 0)
                                                <span class='badge badge-plus' title="{{ implode(', ', array_slice($tradeNames, $displayLimit)) }}">
                                                            +{{ $hiddenCount }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="btn_td">
                                            <a href="{{url('sub_contractor_show')}}/{{$subcontractor->id}}" title="View">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>

{{--                                            <a href="#" class="btn view_btn btn-sm" title="View">--}}
{{--                                                <i class="fa-solid fa-file-import"></i>--}}
{{--                                            </a>--}}

{{--                                            <a href="#"--}}
{{--                                               title="Edit">--}}
{{--                                                <button class="btn edit_btn btn-sm">--}}
{{--                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}
{{--                                                </button>--}}
{{--                                            </a>--}}

                                            <form method="POST" action="" accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="button" class="btn delete_btn btn-sm" title="Delete" onclick="showDeleteConfirmation(this)">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>

    <script>
        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1]
                }]
            });
        });
    </script>
@endpush
