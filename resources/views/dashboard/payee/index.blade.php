@extends('layout.app')

@section('content')

<div class="content">
    <div class="container-fluid">
       

        <div class="row">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-header  text-white d-flex align-items-center">
                       
                        <h5 class="mb-0">Payee Management</h5>
                    </div>

                    <div class="card-body">
<div class="d-flex justify-content-end">
                         <a href="#" class="btn bg-gradient-success btn-sm" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                                <i class="fa fa-plus"></i> Add Payee
                            </a>
                            </div>

                        @include('dashboard.payee.add')

                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">

                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>TIN</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                @foreach($payees as $payee)
                                    <tr>
                                        <td>{{ $payee->name }}</td>
                                        <td>{{ $payee->tin }}</td>
                                        <td>{{ $payee->mobile }}</td>
                                        <td>{{ $payee->email }}</td>

                                        <td class="text-end">

                                            <!-- Edit -->
                                            <a href="#" class="text-secondary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editCustomerBill{{ $payee->id }}">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <!-- Delete -->
                                            <a href="#" class="text-secondary"
                                               data-bs-toggle="modal"
                                               data-bs-target="#deleteModal{{ $payee->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                            <!-- Hidden delete form -->
                                            <form id="delete-form-{{ $payee->id }}" 
                                                action="{{ route('payee.destroy', $payee->id) }}"
                                                method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="deleteModal{{ $payee->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Are you sure you want to delete this Payee? This action cannot be undone.
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                                            <button type="button" class="btn btn-danger"
                                                                onclick="document.getElementById('delete-form-{{ $payee->id }}').submit();">
                                                                <i class="bi bi-trash"></i> Confirm
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>


                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editCustomerBill{{ $payee->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <form action="{{ route('payee.update', $payee->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Payee</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" class="form-control" 
                                                                name="name" value="{{ $payee->name }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">TIN</label>
                                                            <input type="text" class="form-control" 
                                                                name="tin" value="{{ $payee->tin }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Mobile</label>
                                                            <input type="text" class="form-control" 
                                                                name="mobile" value="{{ $payee->mobile }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" class="form-control" 
                                                                name="email" value="{{ $payee->email }}" required>
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
