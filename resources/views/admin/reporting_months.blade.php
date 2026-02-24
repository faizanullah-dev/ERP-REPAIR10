@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Stage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="GET" action="{{route('monthly_sales_report')}}" enctype="multipart/form-data" id="monthly_sales_form">
                            @forelse($months as $month)
                                <tr>
                                    <td> {{$loop->iteration}}</td>
                                    <td> {{$month}} </td>
                                    <td>
                                        <input type="checkbox" name="month[]" value="{{$loop->iteration}}" class="switch month_id" data-color="#00a02c">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        <span class="label label-danger">No Data Found</span>
                                    </td>
                                </tr>
                            @endforelse
                            @foreach($stages as $stage)
                            <input type="hidden" value="{{$stage}}" name="stage_id[]" class="js-switch"data-color="#00a02c" />
                            @endforeach
                            <button type="submit" class="btn btn-success reporting_nxt_btn pull-right">Next<i class="fa-solid fa-arrow-right"></i></button>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.partials.right-sidebar')
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#monthly_sales_form').submit(function (event) {
            //Check if the checkbox is checked
            if (!$('.month_id').is(':checked')) {
                Swal.fire({
                    icon:  'error',
                    title: 'Please at least check one month!',
                    text:  'Validation Error',
                });
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>
@endpush