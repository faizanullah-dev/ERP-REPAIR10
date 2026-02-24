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
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CompanyContact') }}</h3>
                    @can('add-'.str_slug('CompanyContact'))
                        <a class="btn btn-success pull-right" href="{{ url('/companyContact/company-contact/create') }}"><i
                                    class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CompanyContact') }}</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Insurance Start</th>
                                <th>Insurance Expire</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companycontact as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->category->name??"Not Available" }}</td>
                                    <td>{{ $item->company??"Not Available" }}</td>
                                    <td>{{ $item->name??"Not Available" }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->insurance_start ?? '')->format('m-d-Y') ?? 'Not Available' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->insurance_expire ?? '')->format('m-d-Y') ?? 'Not Available' }}</td>
                                    <td>
                                        @if($item->insurance_status == 'active')
                                            <a href="{{ route('change_company_contact_status', [$item->id, 'expire']) }}" onclick="return confirmAndDisable(this);">
                                                <div class="status_btn">
                                                    <label for="status-{{ $item->id }}">
                                                        <badge class="badge badge-success">
                                                            Active
                                                        </badge>
                                                    </label>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{ route('change_company_contact_status', [$item->id, 'active']) }}" onclick="return confirmAndDisable(this);">
                                                <div class="status_btn">
                                                    <label for="status-{{ $item->id }}">
                                                        <badge class="badge badge-warning">
                                                            Expire
                                                        </badge>
                                                    </label>
                                                </div>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('CompanyContact'))
                                            <a href="{{ url('/companyContact/company-contact/' . $item->id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CompanyContact') }}">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('CompanyContact'))
                                            <a href="{{ url('/companyContact/company-contact/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CompanyContact') }}">
                                                <button class="btn edit_btn btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('CompanyContact'))
                                            <form method="POST"
                                                  action="{{ url('/companyContact/company-contact' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn delete_btn btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CompanyContact') }}"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $companycontact->appends(['search' => Request::get('search')])->render() !!} </div>
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
        {{--$(document).ready(function () {--}}

        {{--    @if(\Session::has('message'))--}}
        {{--    $.toast({--}}
        {{--        heading: 'Success!',--}}
        {{--        position: 'top-center',--}}
        {{--        text: '{{session()->get('message')}}',--}}
        {{--        loaderBg: '#ff6849',--}}
        {{--        icon: 'success',--}}
        {{--        hideAfter: 3000,--}}
        {{--        stack: 6--}}
        {{--    });--}}
        {{--    @endif--}}
        {{--})--}}
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
