@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet"
          type="text/css" />
    <link href="{{asset('plugins/components/custom-select/custom-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/components/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/components/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="table-responsive">
                    <div class="dataTables_wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Stage</th>
                                    <th>Total Leads</th>
                                    <th>Total Amount</th>
                                    <th>Colour</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <form method="GET" action="{{route('months')}}" enctype="multipart/form-data" id="stages_form">
                                @forelse($stages->sortBy('position') as $key => $stage)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$stage->name??""}} </td>
                                        <td> {{$stage->stageCount??""}} </td>
                                        <td>${{ number_format((float)$stage->LeadPrice ?? 0, 2) }}</td>
                                        <td>
                                            <span style="width: 20px; height: 20px; border-radius: 10px; display: block; margin: 0 auto; background-color: {{ $stage->colour_id }}"></span>
                                        </td>
                                        <td>
                                            <input type="checkbox" value="{{$stage->id}}" name="stage_id[]" class="js-switch stage_id" data-color="#00a02c" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <span class="label label-danger">No Data Found</span>
                                        </td>
                                    </tr>
                                @endforelse
                                <button type="submit" class="btn btn-success reporting_nxt_btn pull-right">Next <i class="fa-solid fa-arrow-right"></i></button>
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('plugins/components/switchery/dist/switchery.min.js')}}"></script>
    <script>
        jQuery(document).ready(function () {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());
            });
        });
        $(document).ready(function() {
            $('.reporting_nxt_btn').prop('disabled', true);
            $('input[type="checkbox"].stage_id').change(function() {
                if ($('input[type="checkbox"].stage_id:checked').length > 0) {
                    $('.reporting_nxt_btn').prop('disabled', false);
                } else {
                    $('.reporting_nxt_btn').prop('disabled', true);
                }
            });
        });
        $(document).ready(function () {
            $('#stages_form').submit(function (event) {
                if (!$('.stage_id').is(':checked')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Please select at least one stage',
                        text: 'Validation Error',
                    });
                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
@endpush
