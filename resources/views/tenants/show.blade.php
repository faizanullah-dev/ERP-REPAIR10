@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tenant Details</h3>
                    <div>
                        <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('tenants.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Tenant ID</th>
                                    <td>{{ $tenant->id }}</td>
                                </tr>
                                <tr>
                                    <th>Company Name</th>
                                    <td>{{ $tenant->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $tenant->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $tenant->phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $tenant->address ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Status</th>
                                    <td>
                                        @if($tenant->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Subscription Plan</th>
                                    <td>{{ ucfirst($tenant->subscription_plan ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <th>Trial Ends At</th>
                                    <td>
                                        @if($tenant->trial_ends_at)
                                            {{ $tenant->trial_ends_at->format('M d, Y h:i A') }}
                                            @if($tenant->trialExpired())
                                                <span class="badge badge-danger ml-2">Expired</span>
                                            @else
                                                <span class="badge badge-success ml-2">Active</span>
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $tenant->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $tenant->updated_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Domains</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Domain</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tenant->domains as $domain)
                                        <tr>
                                            <td>
                                                <a href="http://{{ $domain->domain }}" target="_blank">
                                                    {{ $domain->domain }}
                                                    <i class="fa fa-external-link-alt ml-1"></i>
                                                </a>
                                            </td>
                                            <td>{{ $domain->created_at->format('M d, Y h:i A') }}</td>
                                            <td>
                                                <span class="badge badge-info">Primary</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No domains found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Database Information</h4>
                            <div class="alert alert-info">
                                <strong>Database Name:</strong> tenant{{ $tenant->id }}<br>
                                <strong>Connection:</strong> MySQL<br>
                                <strong>Status:</strong> <span class="badge badge-success">Connected</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

