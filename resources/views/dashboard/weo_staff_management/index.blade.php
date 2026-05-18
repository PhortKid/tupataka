@extends('layout.app')

@section('content')

<div class="content">
   
    <div class="container-fluid">
        
          <a href="#" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                            <i class="fa fa-plus"></i> Add WEO Staff
                        </a>
        <div class="row">

            <div class="col-12">
                <div class="card">

                    <!-- Header -->
                    <div class="card-header  text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center">
                           
                            Ward Executive Officer
                        </h5>

                       
                    </div>

                    <div class="card-body">

                        @include('dashboard.weo_staff_management.add')

                        <div class="table-responsive">
                            <table cclass="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>FullName</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($staffs as $staff)
                                    <tr>
                                        <td>{{ $staff->firstname }} {{ $staff->middlename }}  {{ $staff->lastname }}</td>
                                     
                                        <td>{{ $staff->phone_number }}</td>
                                        <td>{{ $staff->email }}</td>

                                        <td class="text-end">
                                            
                                 

                                            <!-- Edit -->
                                          <a href="#" class="text-secondary" data-bs-toggle="modal"
   data-bs-target="#editModal{{ $staff->id }}">
    <i class="fa fa-edit"></i>
</a>


                                            <!-- Delete -->
                                            <a href="#" class="text-secondary " 
                                               data-bs-toggle="modal"
                                               data-bs-target="#deleteModal{{ $staff->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>

                                    <!-- DELETE MODAL -->
                                    <div class="modal fade" id="deleteModal{{ $staff->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Are you sure you want to delete 
                                                    <strong>{{ $staff->firstname }} {{ $staff->lastname }}</strong>?
                                                    <br>
                                                    <span class="text-danger fw-bold">This action cannot be undone!</span>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>

                                                    <form id="delete-form-{{ $staff->id }}" 
                                                          action="{{ route('weo_staff_management.destroy', $staff->id) }}" 
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa fa-trash"></i> Confirm
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @include('dashboard.weo_staff_management.edit')

                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div><!-- end card-body -->

                </div><!-- end card -->
            </div>

        </div>
    </div>
</div>

@endsection





