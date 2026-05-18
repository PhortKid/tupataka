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
            <a class="nav-link active" href="#" data-bs-toggle="tab">Ward</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/street_management">Street</a>
          </li>
        </ul>

        {{-- WARD TABLE CARD --}}
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Wards</h5>

            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addWardModal">
              <i class="fa fa-plus"></i> Add Ward
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
                    <th>Ward</th>
                    <th>District</th>
                    <th>Weo Staff</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($wards as $ward)
                  <tr>
                    <td>{{ $ward->name }}</td>
                    <td>{{ $ward->district ? $ward->district->name : '' }}</td>
                    <td>{{ $ward->weoStaff->firstname }}</td>

                    <td class="text-end">

                      {{-- EDIT BUTTON --}}
                      <button class="btn btn-warning btn-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#editWard{{ $ward->id }}">
                        <i class="fa fa-edit"></i>
                      </button>

                      {{-- DELETE BUTTON --}}
                      <form action="{{ route('ward_management.destroy', $ward->id) }}"
                            method="POST"
                            class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Delete this ward?')"
                                class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>

                    </td>
                  </tr>

                  {{-- EDIT WARD MODAL --}}
                  <div class="modal fade" id="editWard{{ $ward->id }}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <form action="{{ route('ward_management.update', $ward->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                          <div class="modal-header">
                            <h5 class="modal-title">Edit Ward</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">

                            <div class="mb-3">
                              <label class="form-label">Ward</label>
                              <input type="text" class="form-control" name="name" value="{{ $ward->name }}" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Description</label>
                              <input type="text" class="form-control" name="description" value="{{ $ward->description }}">
                            </div>

                            <div class="mb-3">
                              <label class="form-label">District</label>
                              <select class="form-select" name="district_id" required>
                                @foreach($districts as $district)
                                  <option value="{{ $district->id }}"
                                    {{ $ward->district_id == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
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
        {{ $wards->links('pagination::bootstrap-5') }}
      </div>

{{-- ADD WARD MODAL --}}
<div class="modal fade" id="addWardModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('ward_management.store') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add Ward</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
                  <label class="form-label">Region</label>
                  <select class="form-select" id="regionSelect" name="region_id" required>
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
            <label class="form-label">Ward Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" name="description">
          </div>
          
           <div class="form-group">
                        <label>Assign WEO </label>
                        <select class="form-control" data-style="select-with-transition"  title="Choose WEO" name="weo_staff_id" required>
                          <option value="">Select WEO</option>
                          @foreach($weoStaff as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->firstname }} {{ $staff->lastname }}</option>
                          @endforeach
                        </select>
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

{{-- 🔥 ORIGINAL JS FROM YOUR WARD CODE (UNCHANGED) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const regionSelect = document.getElementById('regionSelect');
    const districtSelect = document.getElementById('districtSelect');

    regionSelect.addEventListener('change', function () {
        const regionId = this.value;
        districtSelect.innerHTML = '<option value="">Loading...</option>';

        if (!regionId) {
            districtSelect.innerHTML = '<option value="">Select District</option>';
            return;
        }

        fetch(`/api/districts/by-region/${regionId}`)
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">Select District</option>';
                data.forEach(d => {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });
                districtSelect.innerHTML = options;
            })
            .catch(() => {
                districtSelect.innerHTML = '<option value="">Select District</option>';
            });
    });
});
</script>


@endsection
