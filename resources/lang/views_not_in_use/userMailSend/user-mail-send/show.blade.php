@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserMailSend') }} {{ $usermailsend->id }}</h3>
                    @can('view-'.str_slug('UserMailSend'))
                        <a class="btn btn-success pull-right" href="{{ url('/userMailSend/user-mail-send') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr><th>ID</th><td>{{ $usermailsend->id }}</td></tr>
                            <tr><th> Sender </th><td>   {{   $usermailsend->getUser->name??"not available"}} </td></tr>
                            <tr><th> Subject </th><td>  {{  $usermailsend->subject??"not available" }} </td></tr>
                            <tr><th> To      </th><td>  {{  $usermailsend->to??"not available" }}      </td></tr>
                            <tr><th> CC      </th><td>  {{  $usermailsend->cc??"not available" }}      </td></tr>
                            <tr><th> BCC      </th><td> {{ $usermailsend->bcc??"not available" }}      </td></tr>
                            <tr><th> Description      </th><td> {{ $usermailsend->description??"not available" }}      </td></tr>
                            <tr>
                                <th> Photo And Documents </th>
                                <td>
                                    <div class="files_wrapper">
                                        <div class="row">
                                            @if(isset($usermailsend) && $usermailsend->mail_attachment)
                                                @forelse(Json_decode($usermailsend->mail_attachment) as $key => $value)
                                                    <div class="col-md-4">
                                                        <a href="{{asset('')}}/{{$value}}" target="_blank" >
                                                            <div class="file">
                                                                @if(isset($value) && in_array(array_reverse(explode('.',$value))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']) )
                                                                    <img src="{{asset('')}}/{{$value}}" >
                                                                @elseif(isset($value) && in_array(array_reverse(explode('.',$value))[0],['pdf']) )
                                                                    <img src="{{ asset('/website/images').'/pdf.png' }}" >
                                                                @elseif(isset($value) && in_array(array_reverse(explode('.',$value))[0],['doc','docx','txt']))
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
@endsection

