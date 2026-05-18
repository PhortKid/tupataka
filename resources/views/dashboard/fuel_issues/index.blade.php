@extends('layout.app')

@section('content')


<div class="content">
   
                         
                        
    <div class="container-fluid">
           <a href="#" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addFuelIssueModal">
                                <i class="bi bi-plus"></i> Add Fuel Issue
                            </a>
        <div class="row">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-header  text-white d-flex align-items-center">
                      
                        <h4 class="m-0">Fuel Issues</h4>
                    </div>

                    <div class="card-body">

                       

                        <!-- ADD MODAL -->
                        <div class="modal fade" id="addFuelIssueModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('fuel_issues.store') }}" method="POST">
                                        @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Fuel Issue</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">Issue Date</label>
                                                <input type="date" name="issue_date" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Fuel Type</label>
                                                <select name="fuel_type" class="form-control" required>
                                                    <option value="">-- Select Fuel --</option>
                                                    <option value="PETROL">Petrol</option>
                                                    <option value="DIESEL">Diesel</option>
                                                    <option value="KEROSENE">Kerosene</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Truck</label>
                                                <select name="truck_id" class="form-control" required>
                                                    <option value="">-- Select Truck --</option>
                                                    @foreach($trucks as $truck)
                                                        <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Quantity (Litres)</label>
                                                <input type="number" step="0.01" name="quantity" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Amount</label>
                                                <input type="number" step="0.01" name="amount" class="form-control" required>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn bg-gradient-dark">Save</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- TABLE -->
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Issue Date</th>
                                        <th>Fuel Type</th>
                                        <th>Truck</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Created By</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($fuelIssues as $fuel)
                                    <tr>
                                        <td>{{ $fuel->issue_date }}</td>
                                        <td>{{ $fuel->fuel_type }}</td>
                                        <td>{{ $fuel->truck->plate_number ?? 'N/A' }}</td>
                                        <td>{{ $fuel->quantity }}</td>
                                        <td>{{ $fuel->amount }}</td>
                                        <td>{{ $fuel->creator->name ?? 'System' }}</td>

                                        <td class="text-end">

                                            <!-- DELETE BTN -->
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $fuel->id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                            <form id="delete-form-{{ $fuel->id }}" action="{{ route('fuel_issues.destroy', $fuel->id) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <!-- DELETE MODAL -->
                                            <div class="modal fade" id="deleteModal{{ $fuel->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Are you sure you want to delete this fuel issue? This action cannot be undone.
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="document.getElementById('delete-form-{{ $fuel->id }}').submit();">
                                                                <i class="bi bi-trash"></i> Confirm
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
