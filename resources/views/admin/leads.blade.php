@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush
@section('content')
<section class="staff_table pt-3 top_left_right_padding">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
						<div class="card-headerr">
							<h5>Leads</h5>
							<a href="" class="button create_btn borderRadius">Create</a>
							<i class="fa fa-info-circle"></i>
						</div>
						<hr>
						<div class="card-body">
							<table class="table table-borderless staff">
								<thead>
									<tr>
									<th scope="col">ID</th>
									<th scope="col">Client Name</th>
                                    <th scope="col">Company</th>
									<th scope="col">Email</th>
									<th scope="col">Phone Number</th>
                                    <th scope="col">Address</th>
									<th scope="col">State</th>
                                    <th scope="col">City</th>
									<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									<th class="align-middle" scope="row">0221</th>
									<td class="align-middle">Mr.Khan</td>
									<td class="align-middle">abc Company</td>
									<td class="align-middle">abc@example.com</td>
									<td class="align-middle">+61 123 4567 890</td>
									<td class="align-middle">Dummy address here</td>
                                    <td class="align-middle">Dummy state</td>
									<td class="align-middle">Dummy city</td>
									<td class="align-middle action">
										<div class="dropdown">
											<button class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a class="dropdown-item" href="#">Edit</a>
												<a class="dropdown-item" href="#">Preview</a>
												<a class="dropdown-item" href="#">Deactivate</a>
											</div>
										</div>
									</td>
									</tr>
									<tr>
									<th class="align-middle" scope="row">0221</th>
									<td class="align-middle">Mr.Khan</td>
									<td class="align-middle">abc Company</td>
									<td class="align-middle">abc@example.com</td>
									<td class="align-middle">+61 123 4567 890</td>
									<td class="align-middle">Dummy address here</td>
                                    <td class="align-middle">Dummy state</td>
									<td class="align-middle">Dummy city</td>
									<td class="align-middle action">
										<div class="dropdown">
											<button class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a class="dropdown-item" href="#">Edit</a>
												<a class="dropdown-item" href="#">Preview</a>
												<a class="dropdown-item" href="#">Deactivate</a>
											</div>
										</div>
									</td>
									</tr>
                                    <tr>
									<th class="align-middle" scope="row">0221</th>
									<td class="align-middle">Mr.Khan</td>
									<td class="align-middle">abc Company</td>
									<td class="align-middle">abc@example.com</td>
									<td class="align-middle">+61 123 4567 890</td>
									<td class="align-middle">Dummy address here</td>
                                    <td class="align-middle">Dummy state</td>
									<td class="align-middle">Dummy city</td>
									<td class="align-middle action">
										<div class="dropdown">
											<button class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a class="dropdown-item" href="#">Edit</a>
												<a class="dropdown-item" href="#">Preview</a>
												<a class="dropdown-item" href="#">Deactivate</a>
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
	</section>
@endsection