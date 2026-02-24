@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPricingEstimateCalculator') }} {{ $productpricingestimatecalculator->id }}</h3>
                    @can('view-'.str_slug('ProductPricingEstimateCalculator'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPricingEstimateCalculator/product-pricing-estimate-calculator') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpricingestimatecalculator->id }}</td>
                            </tr>
                            <tr><th> Lead Id </th><td> {{ $productpricingestimatecalculator->lead_id }} </td></tr><tr><th> Eaves Rakes Sub Total </th><td> {{ $productpricingestimatecalculator->eaves_rakes_sub_total }} </td></tr><tr><th> Eaves Rakes Waste </th><td> {{ $productpricingestimatecalculator->eaves_rakes_waste }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

