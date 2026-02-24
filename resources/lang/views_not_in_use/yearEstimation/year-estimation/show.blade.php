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
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'YearEstimation') }} {{ $yearestimation->year }}</h3>
                    @can('view-'.str_slug('YearEstimation'))
                        <a class="btn btn-success pull-right" href="{{ url('/yearEstimation/year-estimation') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th> Year </th>
                                    <th> Goal </th>
                                    <th> Achieved </th>
                                </tr>
                                <tr>
                                    <td>{{ $yearestimation->id }}</td>
                                    <td> {{ $yearestimation->year }} </td>
                                    <td> {{ number_format($yearestimation->estimate_amount) }} </td>
                                    <td> {{ number_format($yearestimationRealProduction->estimate_amount??0) }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="card  border-0 mt-5">
                        <div class="card-headerr calendar_sec_heading">
                            <h4>Monthly Target</h4>
                        </div>
                        <div class="card-body calendar_wrapper">
                            <div class="row calendar_row">
                                @for($i=1; $i<=12; $i++)
                                   <div class="col-md-2">
                                        <div class="single_calendar_box">
                                            <div class="calendar_month" style="background-image: {{asset('website')}}'/images/calendar.png';">
                                                <p>{{date('F', mktime(0, 0, 0, $i, 10))}}</p>
                                            </div>
                                            <div class="calendar_content">
                                                <p>
                                                    <span class="green-text">{{(($yearestimation->released_amount??0) / ($yearestimation->estimate_amount??0)) * 100}}%</span>
                                                    <span>|</span>
                                                    <span class="green-text">${{ number_format((float)(($yearestimation->estimate_amount??0)/12), 2, '.', '') }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-6">
                <h5 align="center">Revenue</h5>
                <div class="ct_dot_wrapper">
                    <div>
                        <span class="ct_chart_dot" style="background: #ED7D31;"></span><span>Goal</span>
                    </div>
                    <div>
                        <span class="ct_chart_dot" style="background: #4472C4;"></span><span>Actual</span>
                    </div>
                </div>
                <div class="white-box">
                    <div id="morris-bar-chart"></div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('plugins/components/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('plugins/components/morrisjs/morris.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            "use strict";
            // Morris bar chart
            Morris.Bar({
                element: 'morris-bar-chart',
                data: [
                    @foreach($yearestimation->months as $key=>$month)
                        {
                            y: "{{$month->name}}",
                            a: {{$month->amount}},
                            @if (isset($yearestimationRealProduction->months))
                                b: {{$yearestimationRealProduction->months[$key]->amount}},
                            @endif
                        },
                    @endforeach                     
                ],
                xkey: 'y',
                ykeys: [
                    'a',
                    @if (isset($yearestimationRealProduction->months))
                        'b'
                    @endif
                ],
                labels: [
                    'Goal',
                    @if (isset($yearestimationRealProduction->months))
                        'Achieved'
                    @endif
                ],
                barColors: [
                    '#ED7D31', 
                    @if (isset($yearestimationRealProduction->months))
                        '#4472C4'
                    @endif
                ],
                
                hideHover: 'auto',
                gridLineColor: '#e0e0e0',
                resize: true
            });
        });
    </script>
@endpush

