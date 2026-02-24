@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Holiday') }} {{ $holiday->id }}</h3>
                    @can('view-'.str_slug('Holiday'))
                        <a class="btn btn-success pull-right" href="{{ url('/holiday/holiday') }}">
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
                                <td>{{ $holiday->id }}</td>
                            </tr>
                            <tr>
                                <th> User Id </th>
                                <td> {{ $holiday->user->name??"" }} </td>
                            </tr>
                            <tr>
                                <th> Name </th>
                                <td> {{ $holiday->name??"" }} </td>
                            </tr>
                            <tr>
                                <th> Date </th>
                                <td>
                                    @forelse($holiday->getHoliday as $item)
                                        @if ($item->date)
                                            {{ \Carbon\Carbon::parse($item->date)->format('F-j-Y')??"Not Available" }},<br>
                                        @endif
                                    @empty
                                        Not Available
                                    @endforelse
                                </td>

                            </tr>
                            <tr>
                                <th> Status </th>
                                <td>
                                    @if($holiday->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">InActive</span>
                                    @endif
                                </td>
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

