<h6 class="pull-left">Search Leads</h6>
<h6 class="pull-right">TOTAL: {{$leadCount??'0'}}</h6>
@forelse($leads as $lead)
    <div class="row">
        <div class="col-md-12">
            <div class="search_result_link">
                <a href="{{url('customer/customer/'. $lead->customer_id)}}" target="_blank">
                    <div class="name">
                        <p>{{$lead->customer->name??""}}</p>
    {{--                    <p>{{$lead->title}}</p>--}}
                    </div>
                </a>
                <a href="{{url('view_lead/'. $lead->id)}}" target="_blank">
                    <div class="name">
    {{--                    <p>{{$lead->customer->name??""}}</p>--}}
                        <p>{{$lead->title}}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <hr>
@empty
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <p> No Lead Found </p>
        </div>
    </div><hr>
@endforelse