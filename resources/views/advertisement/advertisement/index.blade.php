@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Advertisement') }}</h3>
                    @can('add-'.str_slug('Advertisement'))
                        <a class="btn btn-success pull-right" href="{{ url('/advertisement/advertisement/create') }}"><i
                                    class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Advertisement') }}</a>
                    @endcan
                    @can('add-'.str_slug('Advertisement'))
                        <a class="btn btn-success pull-right" href="{{ url('/yearly_advertising_report') }}"><i
                                    class="icon-eye"></i>{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'View Yearly Report') }}</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Year</th>
                                <th>Monthly Budget</th>
                                <th>Month</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($advertisement as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->year??"" }}</td>
                                    <td>{{ number_format($item->monthly_budget ?? 0, 2) }}</td>
                                    <td>{{ $item->month }}</td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('Advertisement'))
                                            <a href="{{ url('/advertisement/advertisement/' . $item->id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Advertisement') }}">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('Advertisement'))
                                            <a href="{{ url('/advertisement/advertisement/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Advertisement') }}">
                                                <button class="btn edit_btn btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Advertisement'))
                                            <form method="POST"
                                                  action="{{ url('/advertisement/advertisement' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn delete_btn btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Advertisement') }}"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $advertisement->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

@endpush
