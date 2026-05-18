@extends('layout.app')

@section('content')
<div class="content">
    <div class="container-fluid">
         <a href="#" class="btn bg-gradient-dark"
                               data-bs-toggle="modal" data-bs-target="#addTruckServiceModal">
                                <i class="bi bi-plus"></i> Add Truck Service
                            </a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header " >
                        
                    </div>

                    <div class="card-body">

                        

                        {{-- Add Modal --}}
                        <div class="modal fade" id="addTruckServiceModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('truck_services.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Truck Service</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label>Service Date</label>
                                                <input type="date" name="service_date"
                                                       class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Truck</label>
                                                <select name="truck_id" class="form-control" required>
                                                    <option value="">-- Select Truck --</option>
                                                    @foreach($trucks as $truck)
                                                        <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label>Service Category</label>
                                                <select name="service_category_id" class="form-control" required>
                                                    <option value="">-- Select Category --</option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->service_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label>Next Service Reading (KM)</label>
                                                <input type="number" name="next_service_reading"
                                                       class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Service Cost</label>
                                                <input type="number" step="0.01"
                                                       name="service_cost" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Remarks</label>
                                                <textarea name="remarks" class="form-control"></textarea>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn bg-gradient-dark">Save</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Truck</th>
                                        <th>Category</th>
                                        <th>Next Reading</th>
                                        <th>Cost</th>
                                        <th>Remarks</th>
                                        <th>Created By</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($services as $service)
                                    <tr>
                                        <td>{{ $service->service_date }}</td>
                                        <td>{{ $service->truck->plate_number ?? 'N/A' }}</td>
                                        <td>{{ $service->serviceCategory->service_name ?? 'N/A' }}</td>
                                        <td>{{ $service->next_service_reading ?? '-' }}</td>
                                        <td>{{ $service->service_cost }}</td>
                                        <td>{{ $service->remarks ?? '-' }}</td>
                                        <td>{{ $service->creator->name ?? 'System' }}</td>

                                        <td class="text-end">

                                            <!-- Delete -->
                                            <a href="#" class="btn btn-sm btn-danger"
                                               data-bs-toggle="modal"
                                               data-bs-target="#deleteModal{{ $service->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                            <form id="delete-form-{{ $service->id }}"
                                                  action="{{ route('truck_services.destroy', $service->id) }}"
                                                  method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $service->id }}"
                                                 tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Are you sure you want to delete this service record?
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>

                                                            <button type="button" class="btn btn-danger"
                                                                    onclick="document.getElementById('delete-form-{{ $service->id }}').submit();">
                                                                <i class="fa fa-trash"></i> Confirm
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
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
