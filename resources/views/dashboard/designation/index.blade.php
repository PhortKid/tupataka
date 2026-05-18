@extends('layout.app')

@section('content')

<div class="content">
    <div class="container-fluid">
         <a href="#" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                                <i class="fa fa-plus"></i> Add
                            </a>

        <div class="row">
            <div class="col-12">
                
                <div class="card">
                    <div class="card-header  text-white d-flex align-items-center">
                        
                        <h5 class="mb-0">Vehicle Management</h5>
                    </div>

                    <div class="card-body">

                        

                        @include('dashboard.designation.add')

                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($designations as $designation)
                                    <tr>
                                        <td>{{ $designation->name }}</td>
                                        <td>{{ $designation->description }}</td>

                                        <td class="text-end">

                                            <!-- Edit -->
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCustomerBill{{ $designation->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <!-- Delete -->
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $designation->id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                            <form id="delete-form-{{ $designation->id }}" action="{{ route('designation.destroy', $designation->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="deleteModal{{ $designation->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Are you sure you want to delete this Designation? This action cannot be undone!
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                                            <button type="button" class="btn btn-danger"
                                                                onclick="document.getElementById('delete-form-{{ $designation->id }}').submit();">
                                                                <i class="bi bi-trash"></i> Confirm
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>


                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editCustomerBill{{ $designation->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <form action="{{ route('designation.update', $designation->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Designation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ $designation->name }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="description">{{ $designation->description }}</textarea>
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
</div>

@endsection
