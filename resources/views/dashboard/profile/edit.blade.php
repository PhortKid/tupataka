@extends('layout.app')

@section('content')

<h2>Profile Management</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="panel panel-default">
    <div class="panel-body">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="control-label">Full Name</label>
                <input type="text" class="form-control" value="{{ $user->firstname }} {{ $user->lastname }}" disabled>
            </div>

            <div class="form-group">
                <label class="control-label">Email Address</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label class="control-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

        <hr>

        <!-- Change Password Button -->
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#changePasswordModal">
            Change Password
        </button>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                <h4 class="modal-title" id="changePasswordModalLabel">Change Password</h4>
            </div>

            <div class="modal-body">
                <form action="{{ route('profile.changePassword') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="control-label">Current Password</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Confirm New Password</label>
                        <input type="password" class="form-control" name="new_password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-success">Change Password</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
