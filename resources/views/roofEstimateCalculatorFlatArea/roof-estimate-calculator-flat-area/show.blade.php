@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculatorFlatArea') }} {{ $roofestimatecalculatorflatarea->id }}</h3>
                    @can('view-'.str_slug('RoofEstimateCalculatorFlatArea'))
                        <a class="btn btn-success pull-right" href="{{ url('/roofEstimateCalculatorFlatArea/roof-estimate-calculator-flat-area') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $roofestimatecalculatorflatarea->id }}</td>
                            </tr>
                            <tr><th> Section </th><td> {{ $roofestimatecalculatorflatarea->section }} </td></tr><tr><th> Eave </th><td> {{ $roofestimatecalculatorflatarea->eave }} </td></tr><tr><th> Rakes </th><td> {{ $roofestimatecalculatorflatarea->rakes }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

