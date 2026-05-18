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
            <a class="nav-link" href="/district_management">District</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ward_management">Ward</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#" data-bs-toggle="tab">Street</a>
          </li>
        </ul>

        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Streets</h5>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addStreetModal">
              <i class="fa fa-plus"></i> Add Street
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
                    <th>Street/Road</th>
                    <th>Ward</th>
                    <th>District</th>
                    <th>Region</th>
                    <th>Description</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($streets as $street)
                  <tr>
                    <td>{{ $street->name }}</td>
                    <td>{{ $street->ward ? $street->ward->name : '' }}</td>
                    <td>{{ $street->district ? $street->district->name : '' }}</td>
                    <td>{{ $street->region ? $street->region->name : '' }}</td>
                    <td>{{ $street->description }}</td>
                    <td class="text-end">

                      {{-- EDIT --}}
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editStreet{{ $street->id }}">
                        <i class="fa fa-edit"></i>
                      </button>

                      {{-- DELETE --}}
                      <form action="{{ route('street_management.destroy', $street->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this street?')" class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>

                    </td>
                  </tr>

                  {{-- EDIT MODAL --}}
                  <div class="modal fade" id="editStreet{{ $street->id }}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{ route('street_management.update', $street->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                          <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Street</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Region</label>
                              <select class="form-select region-edit-select" name="region_id" data-street-id="{{ $street->id }}" required>
                                <option value="">Select Region</option>
                                @foreach($regions as $region)
                                  <option value="{{ $region->id }}" {{ $street->region_id == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">District</label>
                              <select class="form-select district-edit-select" name="district_id" id="districtEditSelect{{ $street->id }}" required>
                                <option value="">Select District</option>
                                @foreach($districts->where('region_id', $street->region_id) as $district)
                                  <option value="{{ $district->id }}" {{ $street->district_id == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Ward</label>
                              <select class="form-select ward-edit-select" name="ward_id" id="wardEditSelect{{ $street->id }}" required>
                                <option value="">Select Ward</option>
                                @foreach($wards->where('district_id', $street->district_id) as $ward)
                                  <option value="{{ $ward->id }}" {{ $street->ward_id == $ward->id ? 'selected' : '' }}>
                                    {{ $ward->name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Street Name</label>
                              <input type="text" class="form-control" name="name" value="{{ $street->name }}" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Description</label>
                              <input type="text" class="form-control" name="description" value="{{ $street->description }}">
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
        {{ $streets->links('pagination::bootstrap-5') }}
      </div>

{{-- ADD STREET MODAL --}}
<div class="modal fade" id="addStreetModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('street_management.store') }}" method="POST">
        @csrf

        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Add Street</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label">Region</label>
            <select class="form-select" name="region_id" id="regionSelect" required>
              <option value="">Select Region</option>
              @foreach($regions as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">District</label>
            <select class="form-select" name="district_id" id="districtSelect" required>
              <option value="">Select District</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Ward</label>
            <select class="form-select" name="ward_id" id="wardSelect" required>
              <option value="">Select Ward</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Street Name</label>
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

{{-- JS ORIGINAL YA STREET (Add & Edit modals) --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  var regionSelect = document.getElementById('regionSelect');
  var districtSelect = document.getElementById('districtSelect');
  var wardSelect = document.getElementById('wardSelect');

  // ADD MODAL: Dynamic districts & wards
  regionSelect.addEventListener('change', function() {
    var regionId = this.value;
    districtSelect.innerHTML = '<option value="">Loading...</option>';
    wardSelect.innerHTML = '<option value="">Select Ward</option>';
    if(regionId) {
      fetch('/api/districts/by-region/' + regionId)
        .then(response => response.json())
        .then(data => {
          let options = '<option value="">Select District</option>';
          data.forEach(district => options += `<option value="${district.id}">${district.name}</option>`);
          districtSelect.innerHTML = options;
        })
        .catch(() => districtSelect.innerHTML = '<option value="">Select District</option>');
    } else {
      districtSelect.innerHTML = '<option value="">Select District</option>';
    }
  });

  districtSelect.addEventListener('change', function() {
    var districtId = this.value;
    wardSelect.innerHTML = '<option value="">Loading...</option>';
    if(districtId) {
      fetch('/api/wards/by-district/' + districtId)
        .then(response => response.json())
        .then(data => {
          let options = '<option value="">Select Ward</option>';
          data.forEach(ward => options += `<option value="${ward.id}">${ward.name}</option>`);
          wardSelect.innerHTML = options;
        })
        .catch(() => wardSelect.innerHTML = '<option value="">Select Ward</option>');
    } else {
      wardSelect.innerHTML = '<option value="">Select Ward</option>';
    }
  });

  // EDIT MODALS: Dynamic districts & wards
  document.querySelectorAll('.region-edit-select').forEach(function(regionEditSelect) {
    regionEditSelect.addEventListener('change', function() {
      var regionId = this.value;
      var streetId = this.getAttribute('data-street-id');
      var districtEditSelect = document.getElementById('districtEditSelect' + streetId);
      districtEditSelect.innerHTML = '<option value="">Loading...</option>';
      if(regionId) {
        fetch('/api/districts/by-region/' + regionId)
          .then(response => response.json())
          .then(data => {
            let options = '<option value="">Select District</option>';
            data.forEach(district => options += `<option value="${district.id}">${district.name}</option>`);
            districtEditSelect.innerHTML = options;
          })
          .catch(() => districtEditSelect.innerHTML = '<option value="">Select District</option>');
      } else {
        districtEditSelect.innerHTML = '<option value="">Select District</option>';
      }
    });
  });

  document.querySelectorAll('.district-edit-select').forEach(function(districtEditSelect) {
    districtEditSelect.addEventListener('change', function() {
      var districtId = this.value;
      var streetId = this.closest('form').querySelector('.region-edit-select').getAttribute('data-street-id');
      var wardEditSelect = document.getElementById('wardEditSelect' + streetId);
      wardEditSelect.innerHTML = '<option value="">Loading...</option>';
      if(districtId) {
        fetch('/api/wards/by-district/' + districtId)
          .then(response => response.json())
          .then(data => {
            let options = '<option value="">Select Ward</option>';
            data.forEach(ward => options += `<option value="${ward.id}">${ward.name}</option>`);
            wardEditSelect.innerHTML = options;
          })
          .catch(() => wardEditSelect.innerHTML = '<option value="">Select Ward</option>');
      } else {
        wardEditSelect.innerHTML = '<option value="">Select Ward</option>';
      }
    });
  });

});
</script>

@endsection
