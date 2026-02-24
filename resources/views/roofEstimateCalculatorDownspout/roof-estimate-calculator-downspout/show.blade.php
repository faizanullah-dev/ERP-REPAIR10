@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculatorDownspout') }} {{ $roofestimatecalculatordownspout->id }}</h3>
                    @can('view-'.str_slug('RoofEstimateCalculatorDownspout'))
                        <a class="btn btn-success pull-right" href="{{ url('/roofEstimateCalculatorDownspout/roof-estimate-calculator-downspout') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $roofestimatecalculatordownspout->id }}</td>
                            </tr>
                            <tr><th> Gutters </th><td> {{ $roofestimatecalculatordownspout->gutters }} </td></tr><tr><th> Downspouts </th><td> {{ $roofestimatecalculatordownspout->downspouts }} </td></tr><tr><th> Guards </th><td> {{ $roofestimatecalculatordownspout->guards }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

