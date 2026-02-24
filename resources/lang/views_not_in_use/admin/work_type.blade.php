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
							<h5>Work Type</h5>
							<a href="" class="button create_btn borderRadius">Create</a>
							<i class="fa fa-info-circle"></i>
						</div>
						<hr>
						<div class="card-body">
							<table class="table table-borderless staff">
								<thead>
									<tr>
									<th scope="col">Work Category</th>
									<th scope="col">Description</th>
									<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									<th class="align-middle" scope="row">Carpentry</th>
									<td class="align-middle">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private.</td>
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
									<th class="align-middle" scope="row">Carpentry</th>
									<td class="align-middle">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private.</td>
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
									<th class="align-middle" scope="row">Carpentry</th>
									<td class="align-middle">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private.</td>
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