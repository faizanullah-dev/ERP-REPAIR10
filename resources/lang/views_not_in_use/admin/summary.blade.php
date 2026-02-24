@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush

@section('content')
<section class="summary_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr bg-white">
                            <h5>Sales Performance Report</h5>
                        </div>
                        <div class="hr-line mt-2"></div>
                        <div class="report_tabs">
                            <ul>
                                <li class="borderRadius"><a  href="">Jobs Won</a></li>
                                <li class="borderRadius"><a  href="">Performance(#)</a></li>
                                <li class="borderRadius"><a  href="">By Salesman</a></li>
                                <li class="borderRadius"><a  href="">Summary</a></li>
                                <li class="borderRadius"><a  href="">Job Listing(#)</a></li>
                            </ul>
                            <div class="advance_btn ml-auto">
                            <a href="" class="button create_btn borderRadius ml-auto">Advance Search</a>
                            </div>
                        </div>
                        <div class="table_div">
                        <table class="table table-borderless staff">
								<thead>
									<tr>
									<th scope="col">#</th>
									<th scope="col">Salesman/Customer Rep</th>
                                    <th scope="col"># Leads 434</th>
									<th scope="col"># Proposal 363</th>
									<th scope="col"># Jobs Awarded 129</th>
                                    <th scope="col"># Contracts (Proposal) 85</th>
									<th scope="col"># Contracts (Jobs) 71</th>
                                    <th scope="col">Proposal Amount $2,838,740.26</th>
									<th scope="col">Contract Amount $1,425,286.26</th>
                                    <th scope="col">Change Order Amount $137,372.19</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									<th class="align-middle" scope="row">1</th>
									<td class="align-middle">Mr.Khan</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
                                    <td class="align-middle">0</td>
									<td class="align-middle">$0.00</td>
									<td class="align-middle">$0.00</td>
                                    <td class="align-middle">$2,250.00</td>
									</tr>
									<tr>
									<th class="align-middle" scope="row">1</th>
									<td class="align-middle">Mr.Khan</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
                                    <td class="align-middle">0</td>
									<td class="align-middle">$0.00</td>
									<td class="align-middle">$0.00</td>
                                    <td class="align-middle">$2,250.00</td>
									</tr>
                                    <tr>
									<th class="align-middle" scope="row">1</th>
									<td class="align-middle">Mr.Khan</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
									<td class="align-middle">0</td>
                                    <td class="align-middle">0</td>
									<td class="align-middle">$0.00</td>
									<td class="align-middle">$0.00</td>
                                    <td class="align-middle">$2,250.00</td>
									</tr>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection