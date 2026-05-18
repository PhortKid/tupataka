@extends('layout.app')

@section('content')

<div class="content">
  <div class="container-fluid">
      <a href="#" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                <i class="bi bi-plus"></i> Add
              </a>
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header  text-white d-flex align-items-center">
            
            <h4 class="m-0">Fuel Stations</h4>
          </div>

          <div class="card-body">

           

            @include('dashboard.fuel_station.add')

            <table class="table table-flush" id="datatable-search">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Tin</th>
                  <th>Address</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>

              <tbody>
                @foreach($fuel_stations as $fuel_station)
                <tr>
                  <td>{{ $fuel_station->name }}</td>
                  <td>{{ $fuel_station->tin }}</td>
                  <td>{{ $fuel_station->address }}</td>
                  <td class="text-end">

                    <!-- Edit Button -->
                    <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#editCustomerBill{{$fuel_station->id}}">
                      <i class="fa fa-pencil"></i>
                    </a>

                    <!-- Delete Button -->
                    <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal{{$fuel_station->id}}">
                      <i class="fa fa-trash"></i>
                    </a>

                    <form id="delete-form-{{ $fuel_station->id }}" action="{{ route('fuel_station.destroy', $fuel_station->id) }}" method="POST" style="display:none;">
                      @csrf
                      @method('DELETE')
                    </form>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $fuel_station->id }}" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            Are you sure you want to delete this Fuel Station? This action cannot be undone.
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                              Cancel
                            </button>

                            <button type="button" class="btn btn-danger"
                              onclick="document.getElementById('delete-form-{{ $fuel_station->id }}').submit();">
                              <i class="fa fa-trash"></i> Confirm
                            </button>
                          </div>

                        </div>
                      </div>
                    </div>

                  </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editCustomerBill{{ $fuel_station->id }}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <form action="{{ route('fuel_station.update', $fuel_station->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                          <h5 class="modal-title">Edit Fuel Station</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                          <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $fuel_station->name }}" required>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Tin</label>
                            <input type="text" class="form-control" name="tin" value="{{ $fuel_station->tin }}">
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ $fuel_station->address }}">
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
