@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProgressBoard') }}</h3>
{{--                    @can('add-'.str_slug('ProgressBoard'))--}}
{{--                        <a class="btn btn-success pull-right" href="{{ url('/progressBoard/progress-board/create') }}"><i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProgressBoard') }}</a>--}}
{{--                    @endcan--}}
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Lead</th>
{{--                                <th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody id="sortable">
                            @foreach($lead as $item)
                                <tr class="sortable-item">
                                    <td class="sequence">{{ $loop->iteration }}</td>
                                    <td> {{ $item->title??""}} </td>
{{--                                    <td>--}}
{{--                                        @can('view-'.str_slug('ProgressBoard'))--}}
{{--                                            <a href="{{ url('/progressBoard/progress-board/' . $item->id) }}"--}}
{{--                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProgressBoard') }}">--}}
{{--                                                <button class="btn btn-info btn-sm">--}}
{{--                                                    <i class="fa fa-eye" aria-hidden="true"></i> --}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}
{{--                                        @can('edit-'.str_slug('ProgressBoard'))--}}
{{--                                            <a href="{{ url('/progressBoard/progress-board/' . $item->id . '/edit') }}"--}}
{{--                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProgressBoard') }}">--}}
{{--                                                <button class="btn btn-primary btn-sm">--}}
{{--                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> --}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}
{{--                                        @can('delete-'.str_slug('ProgressBoard'))--}}
{{--                                            <form method="POST"--}}
{{--                                                  action="{{ url('/progressBoard/progress-board' . '/' . $item->id) }}"--}}
{{--                                                  accept-charset="UTF-8" style="display:inline">--}}
{{--                                                {{ method_field('DELETE') }}--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                <button type="submit" class="btn btn-danger btn-sm"--}}
{{--                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProgressBoard') }}"--}}
{{--                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> --}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                        @endcan--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $lead->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
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
            // $(function() {
                // $("#sortable").sortable({
                //     update: function(event, ui) {
                //         var sortedData = $(this).sortable('toArray');
                //         updatePositions(sortedData);
                //     },
                //     placeholder: "sortable-item",
                //     forcePlaceholderSize: true
                // }).disableSelection();
                $(document).ready(function() {
                    $("#sortable").sortable({
                        update: function(event, ui) {
                            updateSequence();
                        }
                    });
                });

                function updateSequence() {
                    $('#sortable .sortable-item').each(function(index) {
                        $(this).find('.sequence').text(index + 1);
                    });
                }
                {{--function updatePositions(sortedData) {--}}
                {{--    $.ajax({--}}
                {{--        url: "{{ route('update_positions') }}",--}}
                {{--        type: "POST",--}}
                {{--        data: {--}}
                {{--            _token: "{{ csrf_token() }}",--}}
                {{--            positions: sortedData--}}
                {{--        },--}}
                {{--        success: function(response) {--}}
                {{--            $(".stage-number").each(function(index) {--}}
                {{--                $(this).html(index + 1);--}}
                {{--            });--}}
                {{--            console.log("Success!", "Stages updated successfully.", "success");--}}
                {{--        },--}}
                {{--        error: function(xhr, status, error) {--}}
                {{--            console.log("Error updating positions: " + error);--}}
                {{--        }--}}
                {{--    });--}}
                {{--}--}}
            // });
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
