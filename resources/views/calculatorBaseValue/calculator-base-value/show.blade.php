@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CalculatorBaseValue') }} {{ $calculatorbasevalue->id }}</h3>
                    @can('view-'.str_slug('CalculatorBaseValue'))
                        <a class="btn btn-success pull-right" href="{{ url('/calculatorBaseValue/calculator-base-value') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $calculatorbasevalue->id }}</td>
                            </tr>
                            <tr><th> Roof </th><td> {{ $calculatorbasevalue->roof }} </td></tr><tr><th> Siding </th><td> {{ $calculatorbasevalue->siding }} </td></tr><tr><th> Chimney </th><td> {{ $calculatorbasevalue->chimney }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

