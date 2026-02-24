@extends('layouts.master')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box lead_lead_page my_lead_parent">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="box-title">Referrals</h3>
                        </div>
                    </div>
                </div>
                <div class="row lead-card-view">
                    @foreach($referrals as $referral)
                        <div class="col-md-4">
                            <div class="item-card-view">
                                <ul>
                                    <li class="customer"><b>Name:</b> {{$referral->first_name??''}} {{$referral->last_name??''}} </li>
                                    <li class="customer"><b>Phone: </b> {{$referral->phone??''}}</li>
                                    <li class="representative"> <b>Email: </b> {{$referral->email??''}}</li>
                                    <li class="category"> <b>Address: </b> {{$referral->address??''}}</li>
                                </ul>
                                <a class="btn btn-green" href="{{ url('customer/customer/create?referral=' . $referral->id??'') }}">Join</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush

