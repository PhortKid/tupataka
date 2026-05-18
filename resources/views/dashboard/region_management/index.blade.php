@extends('layout.app')

@section('content')

<div class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Location</h4>
      </div>

      <div class="card-body">

        {{-- NAV PILLS BS5 --}}
        <ul class="nav nav-pills mb-4">
          <li class="nav-item">
            <a class="nav-link active" href="#pill1" data-bs-toggle="tab">Region</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/district_management">District</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ward_management">Ward</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/street_management">Street</a>
          </li>
        </ul>

        <div class="tab-content">

          {{-- REGION TAB --}}
          <div class="tab-pane fade show active" id="pill1">

            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Regions</h5>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addRegionModal">
                  <i class="fa fa-plus"></i> Add Region
                </button>
              </div>

              <div class="card-body">

                @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive mt-3">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Region</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($regions as $region)
                        <tr>
                          <td>{{ $region->name }}</td>
                          <td>{{ $region->description }}</td>
                          
                          <td class="text-end">
                            {{-- EDIT BUTTON --}}
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRegion{{ $region->id }}">
                              <i class="fa fa-edit"></i>
                            </button>

                            {{-- DELETE --}}
                            <form action="{{ route('region_management.destroy', $region->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fa fa-trash"></i>
                              </button>
                            </form>
                          </td>
                        </tr>

                        @include('dashboard.region_management.edit_modal')
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

  </div>
</div>

{{-- ADD REGION MODAL --}}
<div class="modal fade" id="addRegionModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Region</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('region_management.store') }}" method="POST">
        @csrf
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" name="description" class="form-control">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection
