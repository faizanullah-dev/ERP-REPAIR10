@extends('layouts.master')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h2>Select Template</h2>
                    <form method="POST" action="{{url('update_lead_template')}}">
                        @csrf
                        <input type="hidden" name="lead_id" value="{{$leadId->id}}">
                        <div class="select-template-wrapper" >
                            <div class="row">
                                @forelse($templates as $template)
                                    <div class="col-md-3">
                                        <div class="select-template-card" >
                                            <input type="radio" name="template_id" value="{{$template->id}}" required>
                                            <i class="fa-regular fa-file"></i>
                                            <h6 class="select-template-title">{{$template->name}}</h6>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Template Found Against Lead Category.</p>
                                @endforelse
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection