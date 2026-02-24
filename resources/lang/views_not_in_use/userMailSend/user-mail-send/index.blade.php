@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserMailSend') }}</h3>
                    @can('add-'.str_slug('UserMailSend'))
                        {{--<a class="btn btn-success pull-right"   href="{{ url('/userMailSend/user-mail-send/create') }}"><i class="icon-plus"></i> {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserMailSend') }}</a>--}}
                        <a class="btn btn-success pull-right"  data-toggle="modal" data-target="#taskModal" ><i class="icon-plus"></i> Send Email {{--{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserMailSend') }}--}}</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email sent by</th>
                                    <th>Subject</th>
                                    <th>To</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($usermailsend as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>@if($item->getUser->name == 'User') Admin @else {{$item->getUser->name??""}} @endif</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>{{ $item->to }}</td>
                                    <td>
                                        @can('view-'.str_slug('UserMailSend'))
                                            <a href="{{ url('/userMailSend/user-mail-send/' . $item->id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserMailSend') }}">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('UserMailSend'))
                                            <a href="{{ url('/userMailSend/user-mail-send/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserMailSend') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('UserMailSend'))
                                            <form method="POST"
                                                  action="{{ url('/userMailSend/user-mail-send' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserMailSend') }}"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $usermailsend->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="taskModal" class="main_modal modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Task Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
              <form class="form-horizontal" method="post" action="{{route('email_send')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                      <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="recipient-name" class="input_labels control-label">To:</label>
                                <input type="email" name="to" class="form-control" id="to" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class=" input_labels control-label">CC:</label>
                                <input type="email" name="cc" class="form-control" id="cc">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class=" input_labels control-label">BCC:</label>
                                <input type="email" name="bcc" class="form-control" id="bcc">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Enter Subject" id="subject" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Attachments *</label>
                                <div class="input_fields_wrap_right">
                                    <div class="custom_add_inputs">
                                        <input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" value=""/>
                                        <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </div>
                                    <button class="add_field_button btn btn-warning " type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="recipient-name" class="input_labels control-label">Description:</label>
                                <textarea class="form-control" rows="5" name="description" type="textarea" id="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button  class="btn btn-form-control" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>

<!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {

            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
        
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
        $(document).ready(function(){
            var phone_count = 1;
            $(".input_fields_wrap_right .add_field_button").click(function(){
                var tr = '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" value=""/> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';


                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount >= 1 && rowCount<=4){
                    $('.input_fields_wrap_right').prepend("<div class='custom_add_inputs'>" + tr + "</div>");
                }
                phone_count++;
            });

            $(".input_fields_wrap_right").on('click', '.remove_button', function () {
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount > 1){
                    $(this).closest('.input_fields_wrap_right .custom_add_inputs').remove();
                }
            });
        });

</script>
@endpush