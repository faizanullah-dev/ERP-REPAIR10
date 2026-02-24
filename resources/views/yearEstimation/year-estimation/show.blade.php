@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">
    <style type="text/css">
        .ct_chart_dot {
            width: 15px;
            height: 15px;
            display: block;
        }
        .ct_dot_wrapper>div{
            display: flex;
            align-items: center;
            gap:2px;
        }
        .ct_dot_wrapper{
            display: flex;
            align-items: center;
            justify-content: center;
            gap:10px;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="form-horizontal">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Year Goal') }} {{ $yearestimation->year }}</h3>
                    @can('view-'.str_slug('YearEstimation'))
                        <a class="btn btn-success pull-right" href="{{ url('/yearEstimation/year-estimation') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table mb-5">
                            <tbody>
                                <tr>
                                    <th> ID </th>
                                    <th> Year </th>
                                    <th> Goal </th>
                                    <th> Result </th>
                                    <th> Achieved </th>
                                </tr>
                                <tr>
                                    <td> {{ $yearestimation->id }}</td>
                                    <td> {{ $yearestimation->year }} </td>
                                    <td> {{ number_format($yearestimation->estimate_amount) }} </td>
                                        <td>
                                            @php
                                                $achievedPercentage = 0;
                                                if ($yearestimation->estimate_amount > 0){
                                                    $achievedPercentage = ($yearestimationRealProduction / $yearestimation->estimate_amount) * 100;
                                                }//end if..
                                            @endphp
                                            <div class="progress progress-xs margin-vertical-10">
                                                <div class="progress-bar progress-bar-warning" style="width: {{ $achievedPercentage }}%"></div>
                                            </div>
                                        </td>
                                    <td> ${{ number_format($yearestimationRealProduction ?? 0, 2) }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <h3>Year  Estimation {{$yearestimation->year??00}}</h3>




                    <div class="row mt-5 cust_row">
                            <div class="col-md-1">


                            <div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
                                <label for="year" class="col-md-12 control-label">{{ 'Value' }}</label>
                                <input class="form-control calculation" readonly name="estimate_amount"  type="text" id="estimate_amount" value="{{$yearestimation->estimate_value??00}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
                            </div>
                            </div>
                        <div class="col-md-1">
                            <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
                                <label for="year" class="col-md-12 control-label">{{ 'Year' }}</label>
                                <input class="form-control calculation" readonly name="estimate_amount"  type="text" id="estimate_amount" value="{{$yearestimation->year??00}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                                <label for="type" class="col-md-12 control-label">{{ 'Type' }}</label>
                                <input class="form-control calculation" readonly name="estimate_amount"  type="text" id="estimate_amount" value="{{$yearestimation->type??00}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('estimate_amount') ? 'has-error' : ''}}">
                                <label for="estimate_amount" class="col-md-12 control-label">{{ 'Gross Income' }}</label>
                                <input class="form-control calculation" readonly name="estimate_amount" type="text" id="estimate_amount"
                                       value="{{ number_format($yearestimation->estimate_amount ?? 2000000, 2) }}"
                                       required
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                {!! $errors->first('estimate_amount', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('amount_per_job') ? 'has-error' : ''}}">
                                <label for="amount_per_job" class="col-md-12 control-label">{{ 'Amount Per Job' }}</label>
                                <input class="form-control calculation"
                                       readonly
                                       name="amount_per_job"
                                       type="number"
                                       id="amount_per_job"
                                       value="{{ number_format($yearestimation->amount_per_job ?? 11600, 2) }}"
                                       required
                                       step="0.01"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                {!! $errors->first('amount_per_job', '<p class="help-block">:message</p>') !!}


                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('job_convertion_ratio') ? 'has-error' : ''}}">
                                <label for="job_convertion_ratio" class="col-md-12 control-label">{{ 'Job Conversion Ratio %' }}</label>
                                <input class="form-control calculation"
                                       readonly
                                       name="job_convertion_ratio"
                                       type="text"
                                       id="job_convertion_ratio"
                                       value="{{ number_format($yearestimation->job_convertion_ratio ?? 30, 2, '.', '') }}"
                                       required
                                       oninput="this.value = this.value
                .replace(/[^0-9.]/g, '')
                .replace(/(\..*?)\..*/g, '$1');">
                                {!! $errors->first('job_convertion_ratio', '<p class="help-block">:message</p>') !!}

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('extra_push') ? 'has-error' : ''}}">
                                <label for="extra_push" class="col-md-12 control-label">{{ 'Extra Push %' }}</label>
                                <input class="form-control calculation" readonly name="extra_push" type="text"  id="extra_push" value="{{ $yearestimation->extra_push??40}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                {!! $errors->first('extra_push', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>


                    @php
                        $totalPercentage         = 0;
                        $totalAmount             = 0;
                        $totalMonthRequiredLeads = 0;
                        $totalMonthNeededLeads   = 0;
                        $totalExtraLeads         = 0;
                        $totalextraAmount        = 0;
                    @endphp
                    @if($yearestimation->months->count() > 0)
                        @foreach($yearestimation->months as $key => $estimation)
                            @php
                                $totalPercentage         += $estimation->percentage;
                                $totalAmount             += $estimation->amount;
                                $totalMonthRequiredLeads += $estimation->month_required_leads;
                                $totalMonthNeededLeads   += $estimation->month_needed_leads;
                                $totalExtraLeads         += $estimation->extra_leads;
                                $totalextraAmount        += $estimation->extra_amount;
                            @endphp



                            <div class="row row_january cust_row">
                                <div class="col-md-1">
                                    <div class="form-group {{ $errors->has('month_january') ? 'has-error' : ''}}">
                                        <label for="month_january" class="col-md-4 control-label">{{ 'Month' }}</label>
                                        <input class="form-control month" readonly name="month[january][name]" value="{{$estimation->name??'not available'}}" type="text"  id="month_january"  >
                                        {!! $errors->first('month_january', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group {{ $errors->has('percentage_january') ? 'has-error' : ''}}">
                                        <label for="percentage_january" class="col-md-12 control-label">{{ 'Percent %' }}</label>
                                        <input class="form-control month_percentate calculation" readonly value="{{ number_format($estimation->percentage ?? 0, 2) }}" name="month[january][percentage]" type="number" id="percentage_january">
                                        {!! $errors->first('percentage_january', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('amount_january') ? 'has-error' : ''}}">
                                        <label for="amount_january" class="col-md-12 control-label">{{ 'Amount $' }}</label>
                                        <input class="form-control month_amount" readonly value="{{ number_format($estimation->amount ?? 0, 2) }}" name="month[january][amount]" type="text">
                                        {!! $errors->first('amount_january', '<p class="help-block">:message</p>') !!}</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('month_required_leads_january') ? 'has-error' : ''}}">
                                        <label for="month_required_leads_january" class="col-md-12 control-label">{{ 'Required Leads' }}</label>
                                        <input class="form-control month_required_leads" readonly value="{{$estimation->month_required_leads}}"  name="month[january][month_required_leads]" type="number"    >
                                        {!! $errors->first('month_required_leads_january', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('month_needed_leads_january') ? 'has-error' : ''}}">
                                        <label for="month_needed_leads_january" class="col-md-12 control-label">{{ 'Leads Needed' }}</label>
                                        <input class="form-control month_needed_leads" readonly name="month[january][month_needed_leads]" value="{{$estimation->month_needed_leads}}"  type="number"   >
                                        {!! $errors->first('estimate_amount', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('extra_leads_january') ? 'has-error' : ''}}">
                                        <label for="extra_leads_january" class="col-md-12 control-label">{{ 'Extra Leads' }}</label>
                                        <input class="form-control month_extra_leads " readonly name="month[january][extra_leads]" value="{{$estimation->extra_leads}}" type="number"   >
                                        {!! $errors->first('extra_leads_january', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('extra_amount_january') ? 'has-error' : ''}}">
                                        <label for="extra_amount_january" class="col-md-12 control-label">{{ 'Extra Amount $' }}</label>
                                        <input class="form-control month_extra_amount" readonly name="month[january][extra_amount]" value="{{ number_format($estimation->extra_amount ?? 0, 2) }}" type="text" id="extra_amount_january">
                                        {!! $errors->first('extra_amount_january', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row mb-5 row_total">
                        <hr>
                        <div class="col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="text" id="month_december" value="Total">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <b><input class="form-control total_percent" readonly value="{{ number_format($totalPercentage, 2) }}%" type="text"></b>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="form-control total_amount" readonly value="{{ number_format($totalAmount ?? 0, 2) }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="form-control total_required_leads" readonly value="{{ $totalMonthRequiredLeads ?? 0 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="form-control total_needed_leads" readonly value="{{ $totalMonthNeededLeads ?? 0 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="form-control total_extra_leads" readonly value="{{ $totalExtraLeads ?? 0 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="form-control total_extra_amount" readonly value="{{ number_format($totalextraAmount ?? 0, 2) }}" type="text">
                            </div>
                        </div>


                    </div>
                    </div>
                    </div>
            </div>
        </div>
        <hr>
    </div>
@endsection

