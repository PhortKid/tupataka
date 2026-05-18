@extends('dash_layout.app')

@section('content')
<div class="container">
    <h2>Add Role</h2>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Role Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Save Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
