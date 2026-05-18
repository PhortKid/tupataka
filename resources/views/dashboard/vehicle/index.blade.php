@extends('layout.app')
@section('content')

<div class="container-fluid">
    <div class="card shadow-sm mt-3">
        <div class="card-header  ">
            <h4 class="card-title mb-0">Vehicle Management</h4>
        </div>

        <div class="card-body">
            <div class="row">

                <!-- Left Menu -->
                <div class="col-md-2 mb-3">
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Vehicle</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vehicle_service_category">Service Category</a>
                        </li>
                    </ul>
                </div>

                <!-- Right Content -->
                <div class="col-md-10">
                    <div class="tab-content">

                        <!-- Vehicles TAB -->
                        <div class="tab-pane fade show active" id="tab1">

                            <button class="btn  mb-3 bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                                <i class="fas fa-plus"></i> Add Vehicle
                            </button>

                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Plate No</th>
                                            <th>Type</th>
                                            <th>Capacity</th>
                                            <th>Availability</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $vehicle->plate_number }}</td>
                                            <td>{{ $vehicle->type }}</td>
                                            <td>{{ $vehicle->capacity }}</td>
                                            <td>
                                                <span class="badge {{ $vehicle->status == '1' ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $vehicle->status == '1' ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>

                                            <td>
                                                <!-- Edit -->
                                                <a href="#" class=" me-3" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editVehicleModal{{ $vehicle->id }}">
                                                    <i class="fas fa-edit text-secondary"></i>
                                                </a>

                                                <!-- Delete -->
                                                <a href="#" class="text-secondary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteVehicleModal{{ $vehicle->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- EDIT MODAL -->
                                        <div class="modal fade" id="editVehicleModal{{ $vehicle->id }}">
                                            <div class="modal-dialog">
                                                <form method="POST" action="{{ route('vehicle.update', $vehicle->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Vehicle</h5>
                                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Plate Number</label>
                                                                <input type="text" name="plate_number" class="form-control" 
                                                                    value="{{ $vehicle->plate_number }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Type</label>
                                                                <input type="text" name="type" class="form-control" 
                                                                    value="{{ $vehicle->type }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Capacity</label>
                                                                <input type="text" name="capacity" class="form-control" 
                                                                    value="{{ $vehicle->capacity }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Availability</label>
                                                                <input type="text" name="availability_status" class="form-control" 
                                                                    value="{{ $vehicle->availability_status }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <!-- DELETE MODAL -->
                                        <div class="modal fade" id="deleteVehicleModal{{ $vehicle->id }}">
                                            <div class="modal-dialog">
                                                <form method="POST" action="{{ route('vehicle.destroy', $vehicle->id) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete Vehicle</h5>
                                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Are you sure you want to delete this vehicle?
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div> <!-- End Vehicles TAB -->

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- ADD VEHICLE MODAL -->
<div class="modal fade" id="addVehicleModal">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('vehicle.store') }}">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Vehicle</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Plate Number</label>
                        <input type="text" name="plate_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Capacity</label>
                        <input type="text" name="capacity" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Availability</label>
                        <input type="text" name="availability_status" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Add</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
