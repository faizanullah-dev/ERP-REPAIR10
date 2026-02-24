@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Roofestimatecalculatorpreferd') }} {{ $roofestimatecalculatorpreferd->id }}</h3>
                    @can('view-'.str_slug('Roofestimatecalculatorpreferd'))
                        <a class="btn btn-success pull-right" href="{{ url('/roofestimatecalculatorpreferd/roofestimatecalculatorpreferd') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $roofestimatecalculatorpreferd->id }}</td>
                            </tr>
                            <tr><th> Recommended Price </th><td> {{ $roofestimatecalculatorpreferd->recommended_price }} </td></tr><tr><th> Roofing Price </th><td> {{ $roofestimatecalculatorpreferd->roofing_price }} </td></tr><tr><th> Total Sq </th><td> {{ $roofestimatecalculatorpreferd->total_sq }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

