@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('plugins/components/dropify/dist/css/dropify.min.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

    <style>
        .draggable {
            resize: both;
            overflow: auto;
            border: 1px solid #ccc;
            padding: 5px;
            position: absolute; /* This is important for dragging */
            background: white;
            cursor: move; /* Add cursor style for clarity */
        }

        #draggable { width: 150px; height: 150px; padding: 0.5em; }

    </style>
@endpush
@section('content')

    <section class="proposal_editor_page white-box">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12">
                    <h4>Customize Proposals</h4>
                </div>
                <div class="col-lg-3">
                    <div class="editor_sidebar">
                        <h5>Test</h5>
                        <div class="sidebar_section">
                            <div class="top_btn">
                                <button type="button" class="btn btn_green addTextarea">T</button>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Poppins</option>
                                    <option value="1">Montserrat</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <select class="form-select font_list" aria-label="Default select example">
                                    <option selected>10</option>
                                    <option value="1">16</option>
                                    <option value="2">20</option>
                                    <option value="3">24</option>
                                </select>
                            </div>
                            <div class="text_style_items">
                                <button type="button" class="btn"><i class="fa fa-bold"></i></button>
                                <button type="button" class="btn"><i class="fa fa-italic"></i></button>
                                <button type="button" class="btn"><i class="fa fa-underline"></i></button>
                                <button type="button" class="btn"><i class="fa fa-list-ol"></i></button>
                                <button type="button" class="btn"><i class="fa fa-list"></i></button>
                                <button type="button" class="btn"><i class="fa fa-align-right"></i></button>
                                <button type="button" class="btn"><i class="fa fa-align-justify"></i></button>
                                <button type="button" class="btn"><i class="fa fa-align-left"></i></button>
                            </div>
                        </div>
                        <h5>Image</h5>
                        <div class="sidebar_section">
                            <label for="file" class="labelFile">
                                <span><i class="fa fa-upload"></i></span>
                            </label>
                            <input class="img_input" name="text" id="file" type="file" />
                        </div>
                        <h5>Columns</h5>
                        <div class="sidebar_section">
{{--                            <div class="columns">--}}
{{--                            <div class="column_template">--}}
{{--                                <div class="blank"></div>--}}
{{--                            </div>--}}
{{--                            <div class="column_template">--}}
{{--                                <div class="header_footer"></div>--}}
{{--                            </div>--}}
{{--                            <div class="column_template">--}}
{{--                                <div class="two_columns"></div>--}}
{{--                            </div>--}}
{{--                            <div class="column_template">--}}
{{--                                <div class="four_columns"></div>--}}
{{--                            </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="black_page" class="template_page card-div">
                        <div class="inner_content">

                        </div>
                    </div>
                    <div id="template_page" class="template_page card-div">
                        <div class="inner_content">
                            <div class="corner top-left"></div>
                            <div class="corner bottom-right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection

@push('js')
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="{{asset('plugins/components/dropify/dist/js/dropify.min.js')}}"></script>
    <script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>

{{--    <script>--}}
{{--        $( function() {--}}
{{--            $( "#draggable" ).draggable();--}}
{{--        } );--}}
{{--    </script>--}}

        <script>
            $(document).ready(function() {
                function getQueryParam(param) {
                    var urlParams = new URLSearchParams(window.location.search);
                    return urlParams.get(param);
                }

                var targetDiv = getQueryParam('target');
                $('.card-div').hide();
                if (targetDiv) {
                    $('#' + targetDiv).show();
                }

                $('.addTextarea').on('click', function() {
                    var div = $('<div id="draggable" class="ui-widget-content"><p>Drag me around</p></div>');
                    $('.inner_content').append(div);
                    $( "#draggable" ).draggable();
                    // Apply draggable and resizable to the div
                    // div.draggable({
                    //     containment: "parent"
                    // }).resizable();
                });
            });

        </script>
@endpush
