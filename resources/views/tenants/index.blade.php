@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Tenant Management</h3>
                        <a href="{{ route('tenants.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create New Tenant
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Domain</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Trial Ends</th>
                                        <th>Plan</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tenants as $tenant)
                                        <tr>
                                            <td>{{ $tenant->id }}</td>
                                            <td>{{ $tenant->name }}</td>
                                            <td>{{ $tenant->email }}</td>
                                            <td>
                                                @foreach ($tenant->domains as $domain)
                                                    <span class="badge badge-info">{{ $domain->domain }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $tenant->phone ?? 'N/A' }}</td>
                                            <td>
                                                @if ($tenant->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($tenant->trial_ends_at)
                                                    {{ $tenant->trial_ends_at->format('M d, Y') }}
                                                    @if ($tenant->trialExpired())
                                                        <span class="badge badge-danger">Expired</span>
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ ucfirst($tenant->subscription_plan ?? 'N/A') }}</td>
                                            <td>{{ $tenant->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('tenants.show', $tenant->id) }}"
                                                        class="btn btn-sm btn-info" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('tenants.edit', $tenant->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('tenants.destroy', $tenant->id) }}"
                                                        method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('Are you sure you want to delete this tenant?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">No tenants found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $tenants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
