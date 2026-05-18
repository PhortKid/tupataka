@extends('layout.app')
@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Business Customers</h5>
          </div>

          <div class="card-body">

            <div class="table-responsive">
              <table id="datatables" class="table table-flush table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th>Business Info</th>
                    <th>TIN</th>
                    <th>Phone</th>
                    <th>Plot</th>
                    <th>Business</th>
                    <th>Coordinates</th>
                  
                  </tr>
                </thead>

                <tbody>
                  @foreach($customers as $customer)
                  <tr>
                    <td>{{ $customer->reg_no }}</td>

                    <!-- BUSINESS NAME + LOCATION SUBTEXT -->
                    <td>
                      <strong><a href="#" data-bs-toggle="modal"
                        data-bs-target="#viewCustomerModal{{ $customer->id }}">{{ $customer->company_or_institution_name }}</a></strong><br>
                      <small class="text-muted">
                        {{ $customer->street->name ?? 'N/A' }},
                        {{ $customer->ward->name ?? 'N/A' }},
                        {{ $customer->district->name ?? 'N/A' }},
                        {{ $customer->region->name ?? 'N/A' }}
                      </small>
                    </td>

                    <td>{{ $customer->tin }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>{{ $customer->house_no }}</td>
                    <td>{{ $customer->business_activity->name }}</td>

                    <td>
                      @if ($customer->gps_coordinates)
                      <button class="btn bg-gradient-dark btn-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#mapModal{{ $customer->id }}">
                        <i class="fa-solid  fa-map-location-dot"></i> View
                      </button>
                      @else
                        N/A
                      @endif
                    </td>

                   
                  </tr>

                  <!-- View Modal -->
                  <div class="modal fade"
                       id="viewCustomerModal{{ $customer->id }}"
                       tabindex="-1"
                       aria-hidden="true">

                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h5 class="modal-title">Customer Details</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                          <div class="row">

                            <div class="col-6">
                              <p><strong>Business:</strong> {{ $customer->company_or_institution_name }}</p>
                            </div>

                            <div class="col-6">
                              <p><strong>Phone:</strong> {{ $customer->phone_number }}</p>
                            </div>

                            <div class="col-6">
                              <p><strong>Plot:</strong> {{ $customer->house_no ?? 'N/A' }}</p>
                            </div>

                            <div class="col-6">
                              <p><strong>Street:</strong> {{ $customer->street->name ?? 'N/A' }}</p>
                            </div>

                            <div class="col-6">
                              <p><strong>Ward:</strong> {{ $customer->ward->name ?? 'N/A' }}</p>
                            </div>

                            <div class="col-6">
                              <p><strong>District:</strong> {{ $customer->district->name ?? 'N/A' }}</p>
                            </div>

                            <div class="col-6">
                              <p><strong>Region:</strong> {{ $customer->region->name ?? 'N/A' }}</p>
                            </div>

                            <div class="col-6">
                              <p><strong>Coordinates:</strong>
                                @if($customer->gps_coordinates)
                                <a href="https://www.google.com/maps?q={{ $customer->gps_coordinates }}" target="_blank">
                                  view
                                </a>
                                @else
                                  N/A
                                @endif
                              </p>
                            </div>

                            <div class="col-6">
                              <p><strong>Business:</strong> {{ $customer->business_activity->name }}</p>
                            </div>

                            <form action="{{ route('confirm.verified.customer') }}" method="POST">
                              @csrf
                              <input type="hidden" name="name"
                                  value="{{ $customer->company_or_institution_name }}">

                              <input type="hidden" name="phone_number"
                                  value="{{ $customer->phone_number }}">

                              <input type="hidden" name="customer_type" value="irregular">

                              <input type="hidden" name="business_activity_id"
                                  value="{{ $customer->business_activity_id }}">

                              <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                              <button type="submit" class="btn btn-outline-primary mt-3">
                                <i class="fa fa-check"></i> Confirm
                              </button>
                            </form>

                          </div>
                        </div>

                      </div>
                    </div>
                  </div>

                  <!-- Map Modal -->
                  <div class="modal fade" id="mapModal{{ $customer->id }}"
                    tabindex="-1" aria-hidden="true">

                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h5 class="modal-title">Customer Location</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body p-0" style="height:500px;">
                          <iframe width="100%" height="100%" frameborder="0"
                            src="https://www.google.com/maps?q={{ $customer->gps_coordinates }}&t=k&z=17&output=embed"
                            allowfullscreen></iframe>
                        </div>

                      </div>
                    </div>
                  </div>

                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="text-center mt-3">
          {{ $customers->links('pagination::bootstrap-5') }}
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
