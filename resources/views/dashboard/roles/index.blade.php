@extends('dash_layout.app')

@section('content')

@if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('users_management_roles'))
<div class="container mb-4">
    <h2>Roles List</h2>
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Add Role</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Role Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form> 
                       
                        |
                        <a href="/roles/{{$role->id}}/permissions" class="btn btn-primary btn-sm">Permission</a>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@else
<div class="alert alert-warning">
     Access Denied Contact Adminstrator For Assistance
</div>
@endif 

@endsection
