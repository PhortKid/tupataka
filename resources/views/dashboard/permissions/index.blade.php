
@extends('dash_layout.app')

@section('content')

@if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('permission_management'))
<div class="container mb-5">
    <h3 class="mb-4 d-flex justify-content-between align-items-center">
        Manage Permissions
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
            + Add Permission
        </button>
    </h3>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Permissions Table --}}
    <div class="card">
        <div class="card-header">All Permissions</div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Permission Name</th>
                        <th>Module</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->module }}</td>
                        <td>{{ $permission->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Delete this permission?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" disabled>Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No permissions found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Permission Modal --}}
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('permissions.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addPermissionModalLabel">Add New Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="module" class="form-label">Module</label>
                    <select name="module" id="module" class="form-select" required>
                        <option value="">-- Select Module --</option>
                        <option value="Users">Users</option>
                        <option value="Product">Product</option>
                        <option value="Purchase">Purchase</option>
                        <option value="Sales">Sales</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Report">Report</option>
                        <option value="Disposal">Disposal</option>
                       
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Permission Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="e.g. user_management" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Permission</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>


@else
<div class="alert alert-warning">
     Access Denied Contact Adminstrator For Assistance
</div>
@endif 

@endsection

