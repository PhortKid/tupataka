@extends('layout.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        
      
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header ">
                        
                        <h4 class="mb-0">Business Activities</h4>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            
                               <button class="btn bg-gradient-success btn-sm text-right" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="fa fa-plus"></i>  Add Bussiness Activity
                            </button>
        
                            </div>
                       

                        @include('dashboard.business_activities.add')

                        <table class="table table-flush" id="datatable-search">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Payment Type</th>
                                    <th>Bill Amount</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($business_activities as $business_activitity)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $business_activitity->name }}</td>
                                    <td>{{ $business_activitity->description }}</td>
                                    <td>{{ $business_activitity->payment_type }}</td>
                                    <td>{{ number_format($business_activitity->bill_amount,2) }}</td>

                                    <td class="text-end">

                                        {{-- Edit --}}
                                        <a class="text-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $business_activitity->id }}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <a class="text-seconndary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $business_activitity->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                        {{-- Hidden Delete Form --}}
                                        <form id="delete-form-{{ $business_activitity->id }}"
                                              action="{{ route('business_activity.destroy', $business_activitity->id) }}"
                                              method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        {{-- Delete Modal --}}
                                        <div class="modal fade" id="deleteModal{{ $business_activitity->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete this Business Activity?
                                                        <strong>This action cannot be undone!</strong>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            Cancel
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                                onclick="document.getElementById('delete-form-{{ $business_activitity->id }}').submit();">
                                                            <i class="fa fa-trash"></i> Confirm
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editModal{{ $business_activitity->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form action="{{ route('business_activity.update', $business_activitity->id) }}"
                                                  method="POST">

                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Business Activity</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control"
                                                               name="name" value="{{ $business_activitity->name }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Description</label>
                                                        <textarea class="form-control" name="description">
                                                            {{ $business_activitity->description }}
                                                        </textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Payment Type</label>
                                                        <select name="payment_type" class="form-control">
                                                            <option value="Daily"
                                                                {{ $business_activitity->payment_type == 'Daily' ? 'selected' : '' }}>
                                                                Daily
                                                            </option>
                                                            <option value="Monthly"
                                                                {{ $business_activitity->payment_type == 'Monthly' ? 'selected' : '' }}>
                                                                Monthly
                                                            </option>
                                                            <option value="Custom"
                                                                {{ $business_activitity->payment_type == 'Custom' ? 'selected' : '' }}>
                                                                Custom
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Bill Amount</label>
                                                        <input type="text" class="form-control"
                                                               name="bill_amount"
                                                               value="{{ $business_activitity->bill_amount }}" required>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
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
