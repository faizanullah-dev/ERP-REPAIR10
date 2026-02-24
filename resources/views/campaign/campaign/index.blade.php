@extends('layouts.master')

@push('css')
        <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/components/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Campaign ') }}</h3>
                    @can('add-'.str_slug('Campaign'))
                        {{--<a class="btn btn-success pull-right" href="{{ url('/campaign/campaign/create') }}"><i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Campaign') }}</a>--}}
                        <a class="btn btn-success pull-right" href="{{ url('campaign') }}"><i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Campaign') }}</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Names</th>
                                <th>For Campaign Stage</th>
                                <th>Status</th>
                                <th>Pause/Resume</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($campaign as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->name??"Not Available" }}</td>
                                    <td>{{ $item->getStages->name??"Not Available"}}</td>
                                    <td>
                                        @if(auth()->user()->hasRole('user'))
                                            @if($item->status==1)
                                                <a href="{{route('status_change_campaign',[$item->id, 0])}}" onclick="return confirmAndDisable(this);">
                                                <div class="lead_check">
                                            <div class="status_btn">
                                                <badge class='badge pric_span btn-success badge-success'>Active </badge>
                                                </div>
                                                </div>
                                                </a>
                                            @else
                                                <a href="{{route('status_change_campaign',[$item->id, 1])}}" onclick="return confirmAndDisable(this);">
                                                <div class="lead_check">
                                            <div class="status_btn">
                                               <badge class='badge pric_span btn-warning badge-warning'>InActive</badge>
                                               </div>
                                                </div>
                                                </a>
                                            @endif
                                        @else
                                            @if($item->status==1)
                                            <div class="lead_check">
                                            <div class="status_btn">
                                                <badge class='badge .pric_span btn-success badge-success'>Active</badge>
                                                </div>
                                                </div>
                                            @else
                                            <div class="lead_check">
                                            <div class="status_btn">
                                               <badge class='badge .pric_span btn-warning badge-warning'>InActive</badge>
                                               </div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" @if(isset($item) && $item->play_or_resume == 1) checked @endif name="play_or_resume" data-campaign-id="{{ $item->id }}" class="js-switch" data-color="#00a02c"/>
                                    </td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('Campaign'))
                                            <a href="{{ url('/campaign/campaign/' . $item->id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Campaign') }}">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('Campaign'))
                                            <a href="{{ url('/campaign/campaign/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Campaign ') }}">
                                                <button class="btn edit_btn btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('delete-'.str_slug('Campaign'))
                                                <form method="POST"
                                                      action="{{ url('/campaign/campaign' . '/' . $item->id) }}"
                                                      accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="btn delete_btn btn-sm"
                                                            title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Campaign') }}"
                                                            onclick="showDeleteConfirmation(this)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </form>

                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $campaign->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/components/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('plugins/components/peity/jquery.peity.init.js')}}"></script>
    <script src="{{asset('plugins/components/switchery/dist/switchery.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
<script>
        jQuery(document).ready(function () {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
        });
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
            $(document).ready(function() {
                $(".js-switch").on("change", function() {
                    var campaignId = $(this).attr('data-campaign-id');
                    var playOrResumeValue = this.checked ? 1 : 0;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                     $.ajax({
                        url: "{{ route('update_campaign_play_or_resume', ['id' =>$item->id??""]) }}",
                        type: 'PUT',
                         headers: {
                             'X-CSRF-TOKEN': csrfToken
                         },
                        data: { campaign_id: campaignId, play_or_resume: playOrResumeValue },
                        success: function(response) {
                        },
                    });
                });
            });
        function confirmAndDisable(link) {
            event.preventDefault();
            if (link.classList.contains('disabled')) {
                return false; // Link is already disabled
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change the status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    link.classList.add('disabled'); // Disable the link
                    window.location = link.href;
                }
            });
        }
</script>
@endpush