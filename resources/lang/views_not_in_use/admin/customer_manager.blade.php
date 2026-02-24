@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush

@section('content')
	<section class="staff_table customer_manager_table pt-3 top_left_right_padding">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
						<div class="card-headerr">
							<h5>Customer Manager</h5>
							<a href="" class="button create_btn borderRadius">Create</a>
							<i class="fa fa-info-circle"></i>
						</div>
						<hr>
						<div class="card-body">
							<table class="table table-borderless staff">
								<thead>
									<tr>
									<th scope="col">Name</th>
									<th scope="col">Work Type</th>
                                    <th scope="col">Price</th>
									<th scope="col">Last Contacted Date</th>
                                    <th scope="col">Notifications</th>
									<th scope="col">Call</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Message</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									<th class="align-middle" scope="row">Mr.Khan</th>
									<td class="align-middle">Painter</td>
									<td class="align-middle">$300</td>
									<td class="align-middle">03/07/2022</td>
                                    <td class="align-middle">02</td>
									<td class="align-middle"><i class="fa fa-phone" aria-hidden="true"></i></td>
                                    <td class="align-middle"><i class="fa fa-envelope"></i></td>
                                    <td class="align-middle"><i class="fa fa-commenting-o" aria-hidden="true"></i></td>
									</tr>
									<tr>
									<th class="align-middle" scope="row">Mr.Khan</th>
									<td class="align-middle">Painter</td>
									<td class="align-middle">$300</td>
									<td class="align-middle">03/07/2022</td>
                                    <td class="align-middle">02</td>
									<td class="align-middle"><i class="fa fa-phone" aria-hidden="true"></i></td>
                                    <td class="align-middle"><i class="fa fa-envelope"></i></td>
                                    <td class="align-middle"><i class="fa fa-commenting-o" aria-hidden="true"></i></td>
									</tr>
                                    <tr>
									<th class="align-middle" scope="row">Mr.Khan</th>
									<td class="align-middle">Painter</td>
									<td class="align-middle">$300</td>
									<td class="align-middle">03/07/2022</td>
                                    <td class="align-middle">02</td>
									<td class="align-middle"><i class="fa fa-phone" aria-hidden="true"></i></td>
                                    <td class="align-middle"><i class="fa fa-envelope"></i></td>
                                    <td class="align-middle"><i class="fa fa-commenting-o" aria-hidden="true"></i></td>
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