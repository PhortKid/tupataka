@extends('dash_layout.app')

@section('content')

@if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('users_role_permission'))
<div class="container mb-5">
<h2 class="h4 fw-bold mb-4">Manage Permissions for Role: {{ $role->name }}</h2>

<form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')

    @foreach ($permissionsByModule as $module => $permissions)
        <div class="mb-4 border p-3 rounded bg-light">
            <h5 class="text-primary mb-3">{{ ucfirst($module) }}</h5>
            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="permissions[]" value="{{ $permission->id }}"
                                   id="perm_{{ $permission->id }}"
                                   {{ in_array($permission->id, $allowedPermissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Save Permissions</button>
</form>


</div>


@else
<div class="alert alert-warning">
     Access Denied Contact Adminstrator For Assistance
</div>
@endif 
@endsection
