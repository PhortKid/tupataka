@extends('layout.app')

@section('content')

<div class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Location</h4>
      </div>

      <div class="card-body">

        {{-- NAV PILLS --}}
        <ul class="nav nav-pills mb-4">
          <li class="nav-item">
            <a class="nav-link" href="/region_management">Region</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#" data-bs-toggle="tab">District</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ward_management">Ward</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/street_management">Street</a>
          </li>
        </ul>

        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Districts</h5>

            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addDistrictModal">
              <i class="fa fa-plus"></i> Add District
            </button>
          </div>

          <div class="card-body">

            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>District</th>
                    <th>Region</th>
                    <th>Description</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($districts as $district)
                  <tr>
                    <td>{{ $district->name }}</td>
                    <td>{{ $district->region ? $district->region->name : '' }}</td>
                    <td>{{ $district->description }}</td>

                    <td class="text-end">

                      {{-- EDIT --}}
                      <button class="btn btn-warning btn-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#editDistrict{{ $district->id }}">
                        <i class="fa fa-edit"></i>
                      </button>

                      {{-- DELETE --}}
                      <form action="{{ route('district_management.destroy', $district->id) }}"
                            method="POST"
                            class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Delete this district?')"
                                class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>

                    </td>
                  </tr>

                  {{-- EDIT MODAL --}}
                  <div class="modal fade" id="editDistrict{{ $district->id }}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <form action="{{ route('district_management.update', $district->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                          <div class="modal-header">
                            <h5 class="modal-title">Edit District</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">

                            <div class="mb-3">
                              <label class="form-label">District</label>
                              <input type="text" class="form-control" name="name" value="{{ $district->name }}" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Description</label>
                              <input type="text" class="form-control" name="description" value="{{ $district->description }}">
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Region</label>
                              <select class="form-select" name="region_id" required>
                                @foreach($regions as $region)
                                  <option value="{{ $region->id }}"
                                    {{ $district->region_id == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                  </option>
                                @endforeach
                              </select>
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
<div class="mt-3">
        {{ $districts->links('pagination::bootstrap-5') }}
      </div>

{{-- ADD DISTRICT MODAL --}}
<div class="modal fade" id="addDistrictModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('district_management.store') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add District</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label">Select Region</label>
            <select class="form-select" name="region_id" required>
              @foreach($regions as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">District Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" name="description">
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





<script>
<!-- No JS needed for fetching, everything is handled by blade/controller -->

function showDistrictModal() {
    // Fetch regions for select options
    fetch('/api/regions')
        .then(res => res.json())
        .then(regions => {
            let regionSelect = document.querySelector('#districtModal select[name="region_id"]');
            regionSelect.innerHTML = regions.map(r => `<option value="${r.id}">${r.name}</option>`).join('');
        });
    $('#districtModal').modal('show');
}

function editDistrict(id) {
    fetch(`/api/districts/${id}`)
        .then(res => res.json())
        .then(data => {
            document.querySelector('#districtModal input[name="name"]').value = data.name;
            document.querySelector('#districtModal input[name="description"]').value = data.description;
         //   document.querySelector('#districtModal select[name="status"]').value = data.status;
            document.querySelector('#districtModal select[name="region_id"]').value = data.region_id;
            $('#districtModal').modal('show');
        });
}

function deleteDistrict(id) {
    if(confirm('Are you sure you want to delete this district?')) {
        fetch(`/api/districts/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) fetchDistricts();
        });
    }
}
</script>
@endsection

