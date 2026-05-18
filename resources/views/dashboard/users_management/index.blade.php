@extends('layout.app')

@section('page-title', 'Users Management')
@section('module', 'User Module')

@section('content')

 <a href="#" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#disablebackdrop">
                                        <i class="glyphicon glyphicon-plus"></i> Add User
                                    </a>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="green">
                               
                            </div>
                            <div class="card-content">

                                

                                @include('dashboard.users_management.create')

                                <!-- Responsive Table -->
                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead>
                                            <tr>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->firstname }}</td>
                                                <td>{{ $user->lastname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ ucfirst($user->role->name ?? 'Invalid Role') }}</td>
                                                <td class="text-end">
                                                    <!-- Edit User -->
                                                    <a href="#" class="text-warning btn-sm" data-bs-toggle="modal"
                                                       data-bs-target="#editUser{{ $user->id }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Delete User -->
                                                    <a href="#" class="text-danger btn-sm" data-bs-toggle="modal"
                                                       data-bs-target="#deleteUser{{ $user->id }}" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Edit User Modal -->
                                            <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form action="{{ route('users_management.update', $user->id) }}" method="POST">
                                                      @csrf
                                                      @method('PUT')

                                                      <div class="mb-3">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}">
                                                      </div>

                                                      <div class="mb-3">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
                                                      </div>

                                                      <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                                      </div>

                                                      <div class="mb-3">
                                                        <label class="form-label">Phone</label>
                                                        <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}">
                                                      </div>

                                                      <div class="mb-3">
                                                        <label class="form-label">Role</label>
                                                        <select name="role_id" class="form-select">
                                                          @foreach($roles as $role)
                                                          <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                            {{ ucfirst($role->name) }}
                                                          </option>
                                                          @endforeach
                                                        </select>
                                                      </div>

                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                      </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" aria-labelledby="deleteUserLabel{{$user->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteUserLabel{{$user->id}}">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('users_management.destroy', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#disablebackdrop form');

    const firstname = document.getElementById('firstname');
    const lastname = document.getElementById('lastname');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone_number');
    const role = document.getElementById('role');

    function isLettersOnly(value) {
        return /^[A-Za-z]+$/.test(value);
    }

    function markInvalid(input, isValid) {
        if (isValid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
        }
    }

    firstname.addEventListener('input', function() {
        markInvalid(firstname, isLettersOnly(firstname.value) && firstname.value.length >= 2);
    });

    lastname.addEventListener('input', function() {
        markInvalid(lastname, isLettersOnly(lastname.value) && lastname.value.length >= 2);
    });

    email.addEventListener('input', function() {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        markInvalid(email, regex.test(email.value));
    });

    phone.addEventListener('input', function() {
        const regex = /^0[67][0-9]{8}$/;
        markInvalid(phone, regex.test(phone.value));
    });

    role.addEventListener('change', function() {
        markInvalid(role, role.value !== '');
    });

    form.addEventListener('submit', function(e) {
        const validFirst = isLettersOnly(firstname.value) && firstname.value.length >= 2;
        const validLast = isLettersOnly(lastname.value) && lastname.value.length >= 2;
        const validEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value);
        const validPhone = /^0[67][0-9]{8}$/.test(phone.value);
        const validRole = role.value !== '';

        if (!validFirst || !validLast || !validEmail || !validPhone || !validRole) {
            e.preventDefault();
            alert('Please correct the errors before submitting the form.');
        }
    });
});
</script>

@endsection
