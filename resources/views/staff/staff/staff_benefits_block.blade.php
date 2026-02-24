@extends('layouts.master')

@push('css')

@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left">
                                        <h3 class="box-title">Benefits Block</h3>
                                    </div>
                                    <div class="white-box-header-right">
                                        <button type="button" class="btn blue_btn" data-bs-toggle="modal" data-bs-target="#addNewPosition">Add New Position<i class="icon-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form class="row" method="POST" action="{{ route('positions.update') }}">
                                    @csrf
                                    @foreach($positions as $position)
                                    <div class="col-md-12">
                                        <div class="input_group_row input_group_row_staff_benefits_wrap">
                                            <div class="form-group">
                                                <label class="form-label" >Position</label>
                                                <input type="hidden" name="positions[{{$position->id}}][id]" value="{{$position->id}}">
                                                <input type="text" value="{{$position->name}}" name="positions[{{$position->id}}][name]" class="form-control" min="0"  placeholder="" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" >Insurance Rate</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           name="positions[{{$position->id}}][insurance_rate]"
                                                           value="{{ number_format($position->insurance_rate ?? 0, 2) }}"
                                                           class="form-control"
                                                           min="0"
                                                           placeholder="">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="form-group pay_rate_weekly">
                                                <label class="form-label" >Pay Rate Weekly</label>
                                                <div class="input-group">
                                                    <input type="number"
                                                           name="positions[{{$position->id}}][pay_rate_weekly]"
                                                           value="{{ number_format($position->pay_rate_weekly ?? 0, 2) }}"
                                                           class="form-control"
                                                           min="0"
                                                           placeholder="">


                                                    <select class="form-control" name="positions[{{$position->id}}][pay_rate_type]">
                                                        <option value="flat" @if($position->pay_rate_type == 'flat') selected @endif>Flat</option>
                                                        <option value="percentage" @if($position->pay_rate_type == 'percentage') selected @endif>%</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" >Total Yearly Pay</label>
                                                <input type="number" name="positions[{{$position->id}}][total_yearly_pay]" value="{{$position->total_yearly_pay}}" class="form-control" min="0"  placeholder=""  >
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" >VAN</label>
                                                <input type="number" name="positions[{{$position->id}}][van]" value="{{$position->van}}" class="form-control" min="0"  placeholder=""  >
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" >AUT Insurance</label>
                                                <input type="number" name="positions[{{$position->id}}][aut_insurance]" value="{{$position->aut_insurance}}" class="form-control" min="0"  placeholder=""  >
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" >State Federal Payment</label>
                                                <div class="input-group">
                                                    <input type="text" name="positions[{{$position->id}}][state_federal_payment]" value="{{$position->state_federal_payment}}" class="form-control" min="0"  placeholder=""  >
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" >Cost of Insurance</label>
                                                <input type="number" name="positions[{{$position->id}}][cost_of_insurance]" value="{{$position->cost_of_insurance}}" class="form-control" min="0"  placeholder="" readonly >
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        <div class="form_action_btns">
                                            <button class="btn green_btn" type="submit">Save Changes <i class="fa-solid fa-check"></i></button>
                                            <button class="btn btn-secondary" type="button" > Cancel <i class="fa-solid fa-xmark"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal" id="addNewPosition" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >New Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST"  action="{{ url('/positionBlock/position-block') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label input_labels">Name <span class="text-danger">*</span></label>
                                        <input type="text"  name="name" class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="back_button_flex_between">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel <i class="fa-solid fa-xmark"></i></button>
                                        <button class="btn green_btn borderRadius add_task_modal_btn" type="submit">Submit <i class="fa-solid fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $(".input_group_row").each(function () {
                let row = $(this);

                function calculateInsurance() {
                    let rate = parseFloat(row.find("input[name^='positions'][name$='[insurance_rate]']").val()) || 0;
                    let yearlyPay = parseFloat(row.find("input[name^='positions'][name$='[total_yearly_pay]']").val()) || 0;
                    let insuranceCost = (rate / 100) * yearlyPay;
                    row.find("input[name^='positions'][name$='[cost_of_insurance]']").val(insuranceCost.toFixed(2));
                }

                row.find("input[name^='positions'][name$='[insurance_rate]'], input[name^='positions'][name$='[total_yearly_pay]']").on("input", function () {
                    calculateInsurance();
                });
            });
        });
    </script>
@endpush
