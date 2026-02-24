@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Advertisement') }} {{ $advertisement->id }}</h3>
                    @can('view-'.str_slug('Advertisement'))
                        <a class="btn btn-success pull-right" href="{{ url('/advertisement/advertisement') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="left_align_text_tabel">
                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $advertisement->id }}</td>
                                </tr>
                                <tr>
                                    <th> Year </th>
                                    <td> {{ $advertisement->year??"" }} </td>
                                </tr>
                                <tr>
                                    <th> Month </th>
                                    <td> {{ $advertisement->month??"" }} </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table">
                                <tbody>
                                    <tr>
                                        <th> Referral Source </th>
                                        <th> Price </th>
                                    </tr>
                                    @foreach($advertisement->monthlyAdvertisement as $key => $month)
                                    <tr>
                                        <td> {{ $month->referralSource->name??"" }} </td>
                                        <td>{{ number_format($month->price ?? 0, 2) }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <th>Total Monthly Budget</th>
                                        <th>{{ number_format($advertisement->monthly_budget ?? 0, 2) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

