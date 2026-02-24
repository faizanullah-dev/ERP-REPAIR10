@extends('layouts.master')

@push('css')
<style>

</style>
@endpush
@section('content')
    <section class="staff_table pt-3 top_left_right_padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                        <div class="card-headerr">
                            <h5>Leads</h5>
                            {{--<a href="" class="button create_btn borderRadius">Create</a>--}}
                            {{--<i class="fa fa-info-circle"></i>--}}
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-borderless staff" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Lead Number</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Customer</th>
                                        <th>Representative</th>
                                        <th>Category</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($leadByStages as $item)
                                        <tr>
                                            <td>{{ $loop->iteration??$item->id }}</td>
                                            <td>{{ $item->lead_number??"000" }}</td>
                                            <td>{{ $item->title??"" }}</td>
                                            <td>{!! substr($item->description,0,50),'...' !!}</td>
                                            <td>{{ $item->customer->name }}</td>
                                            <td>{{ $item->representative->name??"" }}</td>
                                            <td>{{ $item->category->name??"" }}</td>
                                            <td>{!! substr($item->address,0,50),'...' !!} {{--{{ $item->address??"" }}--}}</td>
                                            <td class="align-middle action">
                                                <div class="dropdown">
                                                    <button class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="{{ url('view_lead/' . $item->id) }}">view</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="9" >
                                                <h5>no leads available for "{{$stage->name??""}}" stage</h5>
                                            </th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection