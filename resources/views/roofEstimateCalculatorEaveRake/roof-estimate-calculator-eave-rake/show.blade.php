@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculatorEaveRake') }} {{ $roofestimatecalculatoreaverake->id }}</h3>
                    @can('view-'.str_slug('RoofEstimateCalculatorEaveRake'))
                        <a class="btn btn-success pull-right" href="{{ url('/roofEstimateCalculatorEaveRake/roof-estimate-calculator-eave-rake') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $roofestimatecalculatoreaverake->id }}</td>
                            </tr>
                            <tr><th> Section </th><td> {{ $roofestimatecalculatoreaverake->section }} </td></tr><tr><th> Eave </th><td> {{ $roofestimatecalculatoreaverake->eave }} </td></tr><tr><th> Rakes </th><td> {{ $roofestimatecalculatoreaverake->rakes }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

