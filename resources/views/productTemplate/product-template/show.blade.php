@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductTemplate') }} {{ $producttemplate->id }}</h3>
                    @can('view-'.str_slug('ProductTemplate'))
                        <a class="btn btn-green pull-right" href="{{ url('/productTemplate/product-template/create') }}">
                            Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductTemplate') }}<i
                                class="icon-plus"></i></a>
                        <a class="btn btn-success pull-right" href="{{ url('/productTemplate/product-template') }}">
                            Back<i class="icon-arrow-left-circle" aria-hidden="true"></i> </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
{{--                                <th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($producttemplate->templateProducts->sortBy('sort_index') as $products)
                                <tr>
                                    <td>{{$products->getProduct->sub_category??''}}</td>
                                    <td>{{$products->getProduct->price??''}}</td>
{{--                                    <td>--}}
{{--                                        @can('view-'.str_slug('ProductTemplate'))--}}
{{--                                            <a href="#!"--}}
{{--                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductTemplate') }}">--}}
{{--                                                <button class="btn btn-info btn-sm">--}}
{{--                                                    <i class="fa fa-eye" aria-hidden="true"></i> View--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}

{{--                                        @can('edit-'.str_slug('ProductTemplate'))--}}
{{--                                            <a href="#!"--}}
{{--                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductTemplate') }}">--}}
{{--                                                <button class="btn btn-primary btn-sm">--}}
{{--                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}

{{--                                        @can('delete-'.str_slug('ProductTemplate'))--}}
{{--                                            <form method="POST"--}}
{{--                                                  action=""--}}
{{--                                                  accept-charset="UTF-8" style="display:inline">--}}
{{--                                                {{ method_field('DELETE') }}--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                <button type="submit" class="btn btn-danger btn-sm"--}}
{{--                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductTemplate') }}"--}}
{{--                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                        @endcan--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

