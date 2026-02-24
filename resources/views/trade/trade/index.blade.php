@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
    <style>
        .buttons{
            display: flex;
            justify-content: center;
        }
        .buttons a{
            margin: 0 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Trade') }}</h3>
                    @can('add-'.str_slug('Trade'))
                        <button type="button" class="btn btn-success pull-right add_trade_modal_btn" data-bs-toggle="modal" data-bs-target="#tradeModal"><i
                                    class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Trade') }}</button>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trade as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="buttons">
{{--                                        @can('view-'.str_slug('Trade'))--}}
{{--                                            <a href="{{ url('/trade/trade/' . $item->id) }}"--}}
{{--                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Trade') }}">--}}
{{--                                                <button class="btn btn-info btn-sm">--}}
{{--                                                    <i class="fa fa-eye" aria-hidden="true"></i> View--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}

                                        @can('edit-'.str_slug('Trade'))
                                            <a href="{{ url('/trade/trade/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Trade') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Trade'))
                                            <form method="POST"
                                                  action="{{ url('/trade/trade' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Trade') }}"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $trade->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tradeModal" tabindex="-1" role="dialog" aria-labelledby="tradeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-block:auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Add Trade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/trade/trade') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
                            <input class="form-control" name="name" type="text" id="name" value="" >
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group mb-0">
                            <div class="d-flex justify-content-center ">
                                <button type="submit" class="btn d-block mx-auto btn-green">Save</button>
                            </div>
                        </div>
                    </form>
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
