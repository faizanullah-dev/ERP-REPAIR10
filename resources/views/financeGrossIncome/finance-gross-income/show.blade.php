@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'FinanceGrossIncome') }} {{ $financegrossincome->id }}</h3>
                    @can('view-'.str_slug('FinanceGrossIncome'))
                        <a class="btn btn-success pull-right" href="{{ url('/financeGrossIncome/finance-gross-income') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $financegrossincome->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $financegrossincome->name }} </td></tr><tr><th> Value </th><td> {{ $financegrossincome->value }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

