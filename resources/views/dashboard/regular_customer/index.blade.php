@extends('layout.app')
@section('content')

<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-12">

      <div class="card">

        <div class="card-header">
          <h5 class="mb-0">Customers List</h5>
          
        </div>

        <div class="table-responsive">
          <table id="datatables" class="table table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Customer Info</th>
                <th>Phone</th>
                <th>House No</th>
                <th>Type</th>
                <th>Family</th>
               
              </tr>
            </thead>

            <tbody>
              @foreach($customers as $customer)
              <tr>
                <td>{{ $customer->reg_no }}</td>

                <!-- CUSTOMER NAME + LOCATION SUBTEXT -->
                <td>
                  <strong><a href="#" data-bs-toggle="modal"
                          data-bs-target="#viewCustomerModal{{ $customer->id }}">{{ $customer->firstname }} {{ $customer->middlename }} {{ $customer->lastname }}</a>
                          </strong><br>
                  <small class="text-muted">
                    {{ $customer->street->name ?? 'N/A' }},
                    {{ $customer->ward->name ?? 'N/A' }},
                    {{ $customer->district->name ?? 'N/A' }},
                    {{ $customer->region->name ?? 'N/A' }}
                  </small>
                </td>

                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->house_no }}</td>
                <td>{{ $customer->business_activity->name }}</td>
                <td>{{ $customer->idadi_kaya }}</td>

                
              </tr>

              <!-- View Details Modal -->
              <div class="modal fade" id="viewCustomerModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title">Customer Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                      <h6 class="mb-3 text-primary">Basic Info</h6>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <p><strong>Full Name:</strong> {{ $customer->firstname }} {{ $customer->middlename }} {{ $customer->lastname }}</p>
                        </div>

                        <div class="col-md-6">
                          <p><strong>Phone:</strong> {{ $customer->phone_number }}</p>
                        </div>

                        <div class="col-md-6">
                          <p><strong>House Number:</strong> {{ $customer->house_no }}</p>
                        </div>

                        <div class="col-md-6">
                          <p><strong>Type:</strong> {{ $customer->business_activity->name }}</p>
                        </div>
                      </div>

                      <hr>

                      <h6 class="mb-3 text-primary">Location Details</h6>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <p><strong>Street:</strong> {{ $customer->street->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-6">
                          <p><strong>Ward:</strong> {{ $customer->ward->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-6">
                          <p><strong>District:</strong> {{ $customer->district->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-6">
                          <p><strong>Region:</strong> {{ $customer->region->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-12">
                          <p><strong>GPS Coordinates:</strong> {{ $customer->gps_coordinates ?? 'N/A' }}</p>
                        </div>
                      </div>

                      @if(!empty($customer->gps_coordinates))
                      <hr>

                      <h6 class="mb-3 text-primary">Map Preview</h6>
                      <div style="height:350px;">
                        <iframe width="100%" height="100%" frameborder="0"
                          src="https://www.google.com/maps?q={{ $customer->gps_coordinates }}&t=k&z=17&output=embed">
                        </iframe>
                      </div>
                      @endif

                      <form action="{{ route('confirm.verified.customer') }}" method="POST" class="mt-3">
                        @csrf
                         <input type="hidden" name="name" value="{{ $customer->firstname }} {{ $customer->middlename }} {{ $customer->lastname }}">
                <input type="hidden" name="phone_number" value="{{ $customer->phone_number }}">
                <input type="hidden" name="customer_type" value="regular">
                <input type="hidden" name="business_activity_id" value="{{ $customer->business_activity_id }}">
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                        <button class="btn btn-outline-primary btn-sm mt-2">
                          <i class="fa fa-check"></i> Confirm
                        </button>
                      </form>

                    </div>

                  </div>
                </div>
              </div>

              @endforeach
            </tbody>

          </table>
        </div>
      </div>

      <div class="mt-3">
        {{ $customers->links('pagination::bootstrap-5') }}
      </div>

    </div>
  </div>
</div>

@endsection
