@extends('layouts.master')

@section('content')
    <section class="staff_view_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box staff_details_box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left">
                                        <h3 class="box-title">Staff Details</h3>
                                    </div>
                                    <div class="white-box-header-right">
                                        @can('view-'.str_slug('Staff'))
                                            <a class="btn blue_btn" href="{{ url('/staff/staff') }}">Back  <i class="icon-arrow-left-circle" aria-hidden="true"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table">
                                        <tbody>
                                        <tr>
                                            <th>ID </th>
                                            <td>{{ $staff->id }}</td>
                                            <th> Name </th>
                                            <td> {{ $staff->name??"Not Available" }} </td>
                                        </tr>

                                        <tr>
                                            <th> Email </th>
                                            <td> {{ $staff->email??"Not Available" }} </td>
                                            <th> Phone </th>
                                            <td> {{ $staff->profile->phone??"Not Available" }} </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>
                                            <th> Address </th>
                                            <td> {{ $staff->profile->address??"Not Available" }} </td>
                                            <th>Colour</th>
                                            <td>
                                                <span  class="colour_box" style="background-color: {{ $staff->profile->colour_id }}; "></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{!! ($staff->status==1)?"<badge class='badge badge-success'>Active</badge>":"<badge class='badge badge-warning'>Inactive</badge>" !!}</td>
                                            <th>Role:</th>
                                            <td>
                                                @foreach($roles as $role)
                                                    @if(isset($staff) && $staff->roles->contains('id', $role->id))
                                                       {{$role->name}}
                                                    @endif
                                                @endforeach
                                            </td>


                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left">
                                        <h3 class="box-title">Compensation</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <form class="row">
                                    @php
                                        $staffFinance = json_decode($staffFinance, true) ?? [];
                                        $compensation = json_decode($staffFinance['compensation_record'] ?? '[]', true);
                                        $position = json_decode($staffFinance['position_record'] ?? '[]', true);
                                        $type = $staffFinance['staff_compensation'] ?? '';
                                        $positionKey = $staffFinance['staff_position'] ?? null;
                                        $positionData = $position[$positionKey] ?? [];
                                    @endphp
                                @if ($type === 'hourly')
                                        @php $hourly = $compensation['hourly'] ?? []; @endphp
                                        <div class="col-md-12">
                                        <h6>Hourly</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Pay</label>
                                                <input type="number" class="form-control" min="0" value="{{ $hourly['pay'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Hours Per Week</label>
                                                <input type="number" class="form-control" min="0" value="{{ $hourly['hours_per_week'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total Weeks Per Year</label>
                                                <input type="number" class="form-control" min="0" value="{{ $hourly['total_weeks'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total Yearly Pay</label>
                                                <input type="number"
                                                       class="form-control"
                                                       min="0"
                                                       value="{{ number_format($hourly['total_yearly_pay'] ?? 0, 2, '.', '') }}"
                                                       step="0.01"
                                                       readonly>
                                        </div>

                                    @elseif ($type === 'salary')
                                        @php $salary = $compensation['salary'] ?? []; @endphp
                                        <div class="col-md-12">
                                        <h6>Salary</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Pay</label>
                                                <input type="number" class="form-control" min="0" value="{{ $salary['pay'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Number Of Days Per Week</label>
                                                <input type="number" class="form-control" min="0" value="{{ $salary['days_per_week'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total Weeks Per Year</label>
                                                <input type="number" class="form-control" min="0" value="{{ $salary['total_weeks'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total Yearly Pay</label>
                                                <input type="number" class="form-control" min="0" value="{{ $salary['total_yearly_pay'] ?? '' }}" readonly>
                                            </div>
                                        </div>

                                    @elseif ($type === 'commission')
                                        @php $commission = $compensation['commission'] ?? []; @endphp
                                        <div class="col-md-12">
                                        <h6>Commission</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Rate</label>
                                                <input type="number" class="form-control" min="0" value="{{ $commission['rate'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Sales Target</label>
                                                <input type="number" class="form-control" min="0" value="{{ sprintf('%.2f', $commission['sales_target'] ?? 0) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total Yearly Pay</label>
                                                <input type="number" class="form-control" min="0" value="{{ $commission['total_yearly_pay'] ?? '' }}" readonly>
                                            </div>
                                        </div>

                                    @elseif ($type === 'base_commission')
                                        @php $base_commission = $compensation['base_commission'] ?? []; @endphp
                                        <div class="col-md-12">
                                        <h6>Base + Commission</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Pay</label>
                                                <input type="number" class="form-control" min="0" value="{{ $base_commission['pay'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Weekly</label>
                                                <input type="number" class="form-control" min="0" value="{{ $base_commission['weekly'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total Weeks Per Year</label>
                                                <input type="number" class="form-control" min="0" value="{{ $base_commission['total_weeks'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total (Salary)</label>
                                                <input type="number" class="form-control" min="0" value="{{ $base_commission['total_salary'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Rate</label>
                                                <input type="number" class="form-control" min="0" value="{{ $base_commission['rate'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Sales Target</label>
                                                <input type="number" class="form-control" min="0" value="{{ $base_commission['sales_target'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total (Commission)</label>
                                                <input type="number" class="form-control" min="0" value="{{ $base_commission['total_commission'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Total Yearly Pay</label>
                                                <input type="number" class="form-control" min="0" value="{{ $base_commission['total_yearly_pay'] ?? '' }}" readonly>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="white-box staff_benefits_box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left">
                                        <h3 class="box-title">Benefits</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr><th colspan="2">{{ $positionData['name'] ?? '' }}</th></tr>
                                        <tr><th>Insurance Rate:</th><td>{{ $positionData['insurance_rate'] ?? '' }}</td></tr>
                                        {{--<tr><th>Cost of Insurance:</th><td>{{ $positionData['cost_of_insurance'] ?? '' }}</td></tr>--}}
                                        <tr><th>VAN:</th><td>{{ number_format($positionData['van'] ?? 0, 2) }}</td></tr>
                                        <tr><th>Aut Insurance:</th><td>{{ number_format($positionData['aut_insurance'] ?? 0, 2) }}</td></tr>
                                        <tr><th>Work Insurance:</th><td>{{ $positionData['cost_of_insurance'] ?? '' }}</td></tr>
                                        <tr><th>Stat Federal:</th><td>{{ $positionData['state_federal_amount'] ?? '' }}</td></tr>

                                        <tr><th>Total:</th><td>
                                                {{ number_format(
      floatval($positionData['total_yearly_pay'] ?? 0) +
      floatval($positionData['cost_of_insurance'] ?? 0) +
      floatval($positionData['van'] ?? 0) +
      floatval($positionData['aut_insurance'] ?? 0) +
      floatval($positionData['state_federal_amount'] ?? 0), 2) }}

                                            </td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

