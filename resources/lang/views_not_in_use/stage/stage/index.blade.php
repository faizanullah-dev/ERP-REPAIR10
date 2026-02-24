@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    /*.sortable-item {*/
        /*padding: 10px;*/
        /*background-color: #f5f5f5;*/
        /*border: 1px solid #ccc;*/
        /*margin-bottom: 5px;*/
    /*}*/
</style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}</h3>
                    @can('add-'.str_slug('Stage'))
                        <a class="btn btn-success pull-right" href="{{ url('/stage/stage/create') }}"><i
                                    class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Colour</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="sortable">
                            @php $index=1;@endphp
                            @foreach($stage->sortBy('position') as $item)
                                   <tr class="sortable-item" data-start-index="{{$index++}}" id="{{$item->id}}">
                                    <td class="stage-number">{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <span style="width: 20px; height: 20px; border-radius: 10px; display: block; margin: 0 auto; background-color: {{ $item->colour_id }}"></span>
                                    </td>
                                    <td>
                                        @if(auth()->user()->hasRole('user'))
                                            @if($item->status==1)
                                                <a href="{{route('status_change_stages',[$item->id, 0])}}"><span class='badge badge-success'>Active</span></a>
                                            @else
                                                <a href="{{route('status_change_stages',[$item->id, 1])}}"><badge class='badge badge-warning'>InActive</badge></a>
                                            @endif
                                        @else
                                            @if($item->status==1)
                                                <badge class='badge badge-success'>Active</badge>
                                            @else
                                                <badge class='badge badge-warning'>InActive</badge>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @can('view-'.str_slug('Stage'))
                                            <a href="{{ url('/stage/stage/' . $item->id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                        @endcan
                                        @can('edit-'.str_slug('Stage'))
                                            <a href="{{ url('/stage/stage/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                        @endcan
                                        @can('delete-'.str_slug('Stage'))
                                            <form method="POST"
                                                  action="{{ url('/stage/stage' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $stage->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>



<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
        $(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var sortedData = $(this).sortable('toArray');
//                    alert(sortedData)
                    updatePositions(sortedData);
                },
                placeholder: "sortable-item",
                forcePlaceholderSize: true
            }).disableSelection();


            function updatePositions(sortedData) {
                $.ajax({
                    url: "{{ route('update_positions') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        positions: sortedData
                    },
                    success: function(response) {
                        $(".stage-number").each(function(index) {
                            $(this).html(index + 1);
                        });
                        console.log("Success!", "Stages updated successfully.", "success");
                    },
                    error: function(xhr, status, error) {
                        console.log("Error updating positions: " + error);
                    }
                });
            }

        });
    </script>

@endpush
