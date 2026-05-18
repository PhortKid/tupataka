@extends('layout.app')

@section('content')

  
<div class="content">
    <div class="container-fluid">
        
        <!-- ADD BUTTON -->
                        <a href="#" class="btn bg-gradient-dark" 
                           data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                            <i class="fa fa-plus"></i> Add
                        </a>

        <div class="row">
            <div class="col-12">

                <div class="card ">
                    
                      <div class="card-header">
              <h5 class="mb-0">Staff</h5>
              <p class="text-sm mb-0">
                View all Staff.
              </p>
            </div>

               

                        @include('dashboard.staff.add')

                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->firstname }} {{ $employee->middlename }} {{ $employee->lastname }}</td>
                                        <td>{{ $employee->email_address }}</td>
                                        <td>{{ $employee->phone1 }}</td>
                                        <td>{{ ucfirst($employee->gender) }}</td>

                                        <td class="text-end">

                                            <!-- EDIT BTN -->
                                            <button class="text-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editEmployee{{ $employee->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <!-- DELETE BTN -->
                                            <button class="text-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $employee->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>
                                    </tr>

                                    <!-- DELETE MODAL -->
                                    <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Are you sure you want to delete this staff? 
                                                    <br><strong>This action cannot be undone!</strong>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>

                                                    <form action="{{ route('staff.destroy', $employee->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">
                                                            Confirm Delete
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- EDIT MODAL -->
                                    <div class="modal fade" id="editEmployee{{ $employee->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <form action="{{ route('staff.update', $employee->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Staff</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body row g-3">
                                                        
                                                        {{-- FIRST NAME --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" name="firstname" class="form-control"
                                                                value="{{ $employee->firstname }}">
                                                        </div>

                                                        {{-- MIDDLE NAME --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">Middle Name</label>
                                                            <input type="text" name="middlename" class="form-control"
                                                                value="{{ $employee->middlename }}">
                                                        </div>

                                                        {{-- LAST NAME --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" name="lastname" class="form-control"
                                                                value="{{ $employee->lastname }}">
                                                        </div>

                                                        {{-- DOB --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">Date of Birth</label>
                                                            <input type="date" name="dob" class="form-control"
                                                                value="{{ $employee->dob }}">
                                                        </div>

                                                        {{-- DESIGNATION --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">Designation</label>
                                                            <select name="designation_id" class="form-select">
                                                                @foreach($designations as $designation)
                                                                <option value="{{ $designation->id }}"
                                                                    {{ $designation->id == $employee->designation_id ? 'selected' : '' }}>
                                                                    {{ $designation->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- EMAIL --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" name="email_address"
                                                                value="{{ $employee->email_address }}">
                                                        </div>

                                                        {{-- PHONE 1 --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">Phone 1</label>
                                                            <input type="text" class="form-control" name="phone1"
                                                                value="{{ $employee->phone1 }}">
                                                        </div>

                                                        {{-- PHONE 2 --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">Phone 2</label>
                                                            <input type="text" class="form-control" name="phone2"
                                                                value="{{ $employee->phone2 }}">
                                                        </div>

                                                        {{-- GENDER --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">Gender</label>
                                                            <select class="form-select" name="gender">
                                                                <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                                <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                            </select>
                                                        </div>

                                                        {{-- NIDA --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">NIDA</label>
                                                            <input type="text" class="form-control" name="nida"
                                                                value="{{ $employee->nida }}">
                                                        </div>

                                                        {{-- NSSF --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">NSSF Reference</label>
                                                            <input type="text" class="form-control" name="nssf_refference"
                                                                value="{{ $employee->nssf_refference }}">
                                                        </div>

                                                        {{-- TIN --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">TIN Reference</label>
                                                            <input type="text" class="form-control" name="tin_refference"
                                                                value="{{ $employee->tin_refference }}">
                                                        </div>

                                                        {{-- RESIDENTIAL --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label">Residential Address</label>
                                                            <input type="text" class="form-control" name="residential_address"
                                                                value="{{ $employee->residential_address }}">
                                                        </div>

                                                        {{-- PERMANENT --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label">Permanent Address</label>
                                                            <input type="text" class="form-control" name="permanent_address"
                                                                value="{{ $employee->permanent_address }}">
                                                        </div>

                                                        {{-- CONTACT PERSON NAME --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label">Contact Person Name</label>
                                                            <input type="text" class="form-control"
                                                                   name="contact_person_name"
                                                                   value="{{ $employee->contact_person_name }}">
                                                        </div>

                                                        {{-- CONTACT PERSON MOBILE --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label">Contact Person Mobile</label>
                                                            <input type="text" class="form-control"
                                                                   name="contact_person_mobile"
                                                                   value="{{ $employee->contact_person_mobile }}">
                                                        </div>

                                                        {{-- CONTACT PERSON ADDRESS --}}
                                                        <div class="col-md-12">
                                                            <label class="form-label">Contact Person Address</label>
                                                            <input type="text" class="form-control"
                                                                   name="contact_person_address"
                                                                   value="{{ $employee->contact_person_address }}">
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>

                                                </form>

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

@endsection
