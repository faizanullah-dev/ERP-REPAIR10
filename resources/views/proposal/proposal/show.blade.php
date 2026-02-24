@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Proposal') }} {{ $proposal->id }}</h3>
                    @can('view-'.str_slug('Proposal'))
                        <a class="btn btn-success pull-right" href="{{ url('/proposal/proposal') }}">
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
                                <td>{{ $proposal->id }}</td>
                            </tr>
                            <tr>
                                <th> Lead </th>
                                <td> {{ $proposal->getLead->title??"Not Available" }} </td>
                            </tr>
                            <tr>
                                <th> Photo And Documents </th>
                                <td>
                                    <div class="files_wrapper">
                                        <div class="row">
                                            @if(isset($proposal) && $proposal->images)
                                                @forelse($proposal->images as $key => $value)
                                                    <div class="col-md-4">
                                                        <a href="{{asset('website')}}/{{$value->name}}" target="_blank" >
                                                            <div class="file">
                                                                @if(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']) )
                                                                    <img src="{{asset('website')}}/{{$value->name}}" >
                                                                @elseif(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['pdf']) )
                                                                    <img src="{{ asset('/website/images').'/pdf.png' }}" >
                                                                @elseif(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['doc','docx','txt']))
                                                                    <img src="{{ asset('/website/images').'/Word-Logo.png' }}">
                                                                @else
                                                                    <img src="{{ asset('/website/images').'/image.png' }}">
                                                                @endif
                                                                <span> View/Download </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @empty
                                                    <div class="heading_btn_wrapper">
                                                        <div class="main_heading">
                                                            <h5>Not Available</h5>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            @else
                                                <div class="heading_btn_wrapper">
                                                    <div class="main_heading">
                                                        <h5>Not Available</h5>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

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

