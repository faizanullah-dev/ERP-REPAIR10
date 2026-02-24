@extends('layouts.master')

@push('css')
    <style>
        #email-branding .email-logo > div { max-width: 250px; }
        #email-branding .white-box { margin: 40px 40px 0; width: calc(100% - 80px); padding: 20px 15px 30px 15px; }
        #email-branding .email-logo img { min-width: 250px; min-height: 180px; max-height: 200px; object-fit: cover; border-radius: 10px; }
        #email-branding input[type="file"] { top: 0; left: 0; opacity: 0; width: 100%; height: 100%; cursor: pointer; position: absolute; }

        #email-branding label:has([type="radio"]) { border-color: #e5e5e5; }
        #email-branding .btn:is(.btn-gray) { color: #000; transition: .5s; letter-spacing: 1px; background: #cbcbcb; }
        #email-branding .btn:is(.btn-gray):hover { color: #fff; transition: .5s; background: var(--primary_blue_2C3146); }
        #email-branding .btn-outline-secondary:is(.active), #email-branding .btn-outline-secondary:hover { background: #74c911; border-color: #74c911; }

        .preview-column .email-logo { min-height: 230px; }
        .preview-template { border-radius: 10px; max-width: fit-content; padding: 10px 20px 20px; box-shadow: 0 0 20px #dbdbdb; }
        .preview-column [class^=email] *:not(h5, img) { color: #000; font-size: 15px; line-height: 1.5; font-family: 'Open Sans', sans-serif; }

        .page-wrapper .preview-template [readonly] { border-color: #fff; }
    .preview-template [name=message_header][readonly] { border-color: #e5ebec; }
    .page-wrapper .preview-template textarea { width: 100%; min-height: auto; border-radius: 0; overflow-y: hidden; background: transparent; }
    .preview-template input:not([type=file]), .page-wrapper .preview-template textarea { border: 0; padding: 0; border-bottom: 1px solid #000; }
    </style>
@endpush


@section('content')
    <section id="email-branding" class="">
        <div class="container-fluid">
            <div class="row">
                <div class="white-box">
                    <form id="email_template" method="POST" action="{{url('store_email_branding')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <h4 class="my-0">Email Logo</h4>
                            <div class="email-logo">
                                <div class="my-4 position-relative">
                                    @if($branding->logo)
                                        <img src="{{asset('website')}}/{{$branding->logo}}" class="img-fluid">
                                    @else
                                        <img src="{{asset('website')}}/images/email-branding.jpg" class="img-fluid">
                                    @endif
                                    <input type="file" name="logo" title="Click to change logo">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="logoBgColor">Logo Background Color:</label>
                                <input type="color" class="form-control" id="logoBgColor" name="logo_background" value="{{$branding->logo_background??'#000000'}}" style="width: 100px; height: 40px;">
                            </div>

                            <div class="form-group">
                                <label class="d-block">Logo Alignment:</label>
                                <div class="btn-group btn-group-toggle alignment-options" data-toggle="buttons">
                                    <label class="btn btn-outline-secondary @if($branding->logo_alignment == 'left') active @endif">
                                        <input type="radio" name="logo_alignment" id="alignmentLeft" value="left" autocomplete="off" @if($branding->logo_alignment == 'left') checked @endif> Left
                                    </label>
                                    <label class="btn btn-outline-secondary @if($branding->logo_alignment == 'center') active @endif">
                                        <input type="radio" name="logo_alignment" id="alignmentCenter" value="center" autocomplete="off" @if($branding->logo_alignment == 'center') checked @endif> Center
                                    </label>
                                    <label class="btn btn-outline-secondary @if($branding->logo_alignment == 'right') active @endif">
                                        <input type="radio" name="logo_alignment" id="alignmentRight" value="right" autocomplete="off" @if($branding->logo_alignment == 'right') checked @endif> Right
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="d-block">Logo Position:</label>
                                <div class="btn-group btn-group-toggle position-options" data-toggle="buttons">
                                    <label class="btn btn-outline-secondary @if($branding->logo_position == 'start') active @endif">
                                        <input type="radio" name="logo_position" id="positionTop" value="start" autocomplete="off" @if($branding->logo_position == 'start') checked @endif> Top
                                    </label>
                                    <label class="btn btn-outline-secondary @if($branding->logo_position == 'center') active @endif">
                                        <input type="radio" name="logo_position" id="positionCenter" value="center" autocomplete="off" @if($branding->logo_position == 'center') checked @endif> Center
                                    </label>
                                    <label class="btn btn-outline-secondary @if($branding->logo_position == 'end') active @endif">
                                        <input type="radio" name="logo_position" id="positionBottom" value="end" autocomplete="off" @if($branding->logo_position == 'end') checked @endif> Bottom
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-0 gap-4 d-flex align-items-center">
                                <button type="button" class="btn btn-gray text-uppercase" id="btnCancel">Cancel</button>
                                <button type="submit" class="btn btn-green border-0">Save</button>
                            </div>
                        </div>

                        <div class="col-md-6 preview-column">
                            <h4 class="my-0">Preview</h4>

                            <div class="preview-template mt-4">
                                <div class="email-logo d-flex">
                                    <div class="my-4 position-relative">
                                        @if($branding->logo)
                                            <img src="{{asset('website')}}/{{$branding->logo}}" class="img-fluid">
                                        @else
                                            <img src="{{asset('website')}}/images/email-branding.jpg" class="img-fluid">
                                        @endif
                                    </div>
                                </div>


                                <div class="d-flex gap-4 flex-column justify-content-between">
                                    <div class="email-header">
                                        <textarea name="pre_body_description" readonly> {{$branding->pre_body_description??'Description Here'}} </textarea>
                                    </div>

                                    <div class="email-body">
                                        <textarea name="description" readonly>{{$branding->description??'Description Here'}}</textarea>
                                    </div>

                                    <div class="email-footer mt-2">
                                        <input type="text" value="{{$branding->name??'Name Here'}}" name="name" readonly> <br>
                                        <input type="text" value="{{$branding->designation??'Designation Here'}}" name="designation" readonly class="mb-2">

                                        <div class="contact-info mt-2">
                                            <div class="contact-item"><strong>Phone:</strong> <input type="text" name="phone" value="{{$branding->phone??'Phone Here'}}" readonly> </div>
                                            <div class="contact-item"><strong>Email:</strong> <input type="email" name="email" value="{{$branding->email??'Email Here'}}" readonly> </div>
                                            <div class="contact-item"><strong>Website:</strong> <input type="text" name="website" value="{{$branding->website??'Website Here'}}" readonly> </div>
                                            <div class="contact-item"><strong>Address:</strong> <input type="text" name="address" value="{{$branding->address??'Address Here'}}" readonly> </div>

                                            <div class="contact-item mt-3"><strong>Social Links:</strong> </div>
                                            <div class="contact-item"><strong>Facebook:</strong> <input type="text" name="social_link_one" value="{{$branding->social_link_one??'Social Link Here'}}" readonly> </div>
                                            <div class="contact-item"><strong>LinkedIn:</strong> <input type="text" name="social_link_two" value="{{$branding->social_link_two??'Social Link Here'}}" readonly> </div>
                                            <div class="contact-item"><strong>Twitter:</strong> <input type="text" name="social_link_three" value="{{$branding->social_link_three??'Social Link Here'}}" readonly> </div>
                                            <div class="contact-item"><strong>Instagram:</strong> <input type="text" name="social_link_four" value="{{$branding->social_link_four??'Social Link Here'}}" readonly> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            dynamicWidth();
            var txtField = '.preview-template input:not([type=file]), .preview-template textarea';
            $(document).on('change', '#email-branding .btn-group input[type="radio"]', function(){
                dynamicWidth();
                let val = $(this).val();
                let name = $(this).attr('name');
                if(name == 'logo_alignment'){
                    $('.preview-column .email-logo').css('justify-content',val);
                }

                if(name == 'logo_position'){
                    $('.preview-column .email-logo').css('align-items',val);
                }
            });

            $(document).on('change', '#email-branding input[type="file"]', function(e){
                dynamicWidth();
                var file = e.target.files[0];
                if (file && file.type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.email-logo img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                } else {
                    console.log('Please select a valid image file');
                }
            });

            $(document).on('click', txtField, function(){
                $(txtField).attr('readonly', true);
                $(this).removeAttr('readonly');
            });

            $(document).on('keyup', txtField, function(e){
            let val = $(this).val();
            if ($(this).is('textarea')) {
                $(this).val(val);
                $(this).text(val);
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
                } else {
                $(this).attr('value',val);
                }

                dynamicWidth();
            });

            $(document).on('blur', txtField, function(){
                $(txtField).attr('readonly', true);
            });

            //Edit Input Fields Dynamic Width
            function dynamicWidth() {
                $('.preview-template input:not([type=file])').each(function () {
                    $(this).css('width', ($(this).val().length + 1) + 'ch');
                });
            }
        });
    </script>
@endpush