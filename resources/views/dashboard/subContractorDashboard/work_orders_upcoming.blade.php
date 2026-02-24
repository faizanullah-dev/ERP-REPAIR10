@extends('layouts.new-master')

@push('css')
    <!-- DataTables CSS -->

@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h2>Work Orders</h2>
                        <div class="table-responsive">
                            <table id="workOrdersTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Project Address</th>
                                    <th>Project Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Smith 1</td>
                                    <td>123 main st Willimantic</td>
                                    <td>12-05-2025</td>
                                    <td><span class="badge badge-warning">Required</span></td>
                                    <td><a href="#" class="btn btn_primary"><i class="fa-regular fa-file-lines"></i> View Contract</a></td>
                                </tr>
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
    <script>
        $(document).ready(function() {
            $('#workOrdersTable').DataTable({
                "pageLength": 10, // Default entries per page
                "lengthMenu": [10, 25, 50, 100], // Options for "Show entries"
                "searching": true, // Enable search
                "paging": true, // Enable pagination
                "info": true, // Show "Showing 1 to 10 of X entries"
                "ordering": true // Enable sorting
            });
        });
    </script>
@endpush