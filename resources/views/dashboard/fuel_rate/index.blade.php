@extends('layout.app')

@section('content')

<div class="content">
  <div class="container-fluid">
        <a href="#" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                <i class="bi bi-plus-lg"></i> Add
              </a>
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header  text-white d-flex align-items-center">
            <i class="bi bi-fuel-pump fs-3 me-2"></i>
            <h4 class="m-0">Fuel Rates</h4>
          </div>

          <div class="card-body">

          

            @include('dashboard.fuel_rate.add')

            <table class="table table-flush" id="datatable-search">
              <thead class="thead-light">
                <tr>
                  <th>Fuel Type</th>
                  <th>Fuel Rate</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>

              <tbody>
                @foreach($fuel_rates as $fuel_rate)
                <tr>
                  <td>{{ $fuel_rate->type }}</td>
                  <td>{{ $fuel_rate->rate }}</td>

                  <td class="text-end">

                    <!-- Edit Button -->
                    <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#editCustomerBill{{$fuel_rate->id}}">
                      <i class="fa fa-pencil"></i>
                    </a>

                    <!-- Delete Button -->
                    <a href="#" class=" text-secondary " data-bs-toggle="modal" data-bs-target="#deleteModal{{$fuel_rate->id}}">
                      <i class="fa fa-trash"></i>
                    </a>

                    <form id="delete-form-{{ $fuel_rate->id }}" action="{{ route('fuel_rate.destroy', $fuel_rate->id) }}" method="POST" style="display:none;">
                      @csrf
                      @method('DELETE')
                    </form>

                    <!-- DELETE MODAL -->
                    <div class="modal fade" id="deleteModal{{ $fuel_rate->id }}" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            Are you sure you want to delete this Fuel Rate? This action cannot be undone.
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger"
                              onclick="document.getElementById('delete-form-{{ $fuel_rate->id }}').submit();">
                              <i class="bi bi-trash"></i> Confirm
                            </button>
                          </div>

                        </div>
                      </div>
                    </div>

                  </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="editCustomerBill{{ $fuel_rate->id }}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <form action="{{ route('fuel_rate.update', $fuel_rate->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                          <h5 class="modal-title">Edit Fuel Rate</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                          <div class="mb-3">
                            <label class="form-label">Fuel Type</label>
                            <select name="type" class="form-control">
                              <option value="LAKES" {{ $fuel_rate->type == 'LAKES' ? 'selected' : '' }}>LAKES</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Rate</label>
                            <input type="text" class="form-control" name="rate" value="{{ $fuel_rate->rate }}">
                          </div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn bg-gradient-dark">Update</button>
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
