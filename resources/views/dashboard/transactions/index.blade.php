@extends('layout.app')

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="card shadow-sm">
      <div class="card-header  text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">TCB Collection Receipts</h4>

        <form method="GET" action="{{ route('transactions.index') }}" class="row g-2">
          <div class="col-auto">
            <input type="date" name="start_date" class="form-control form-control-sm"
              value="{{ $start }}">
          </div>
          <div class="col-auto">
            <input type="date" name="end_date" class="form-control form-control-sm"
              value="{{ $end }}">
          </div>
          <div class="col-auto">
            <button class="btn btn-lg btn-light">Filter</button>
          </div>
        </form>
      </div>

      <div class="card-body">

        <p class="text-muted mb-3">
          Showing transactions from  
          <strong>{{ $start }}</strong> to <strong>{{ $end }}</strong>
        </p>

        <div class="table-responsive">
          <table class="table table-striped table-bordered align-middle">
            <thead class="thead-light">
              <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Reference</th>
                <th>Control No#</th>
                <th>Amount</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>

            <tbody>
              @foreach($transactions as $tx)
              <tr>
                <td>{{ \Carbon\Carbon::parse($tx->transaction_date)->setTimezone('Africa/Nairobi')->format('Y-m-d H:i:s') }}</td>
                <td>{{ $tx->customer->name ?? 'Unknown' }}</td>
                <td>{{ $tx->transaction_id }}</td>
                <td>{{ $tx->reference }}</td>
                <td>{{ number_format($tx->amount) }} {{ $tx->currency }}</td>
                <td>
                    @if($tx->status==0)
                      <span class="badge bg-success">Success</span>
                    @else
                      <span class="badge bg-danger">Failed</span>
                    @endif
                </td>
                <td class="text-end">
                <!--  <button class="btn btn-sm btn-info" >
                    
                  </button>-->
                  <i class="fa fa-eye text-info" data-bs-toggle="modal" data-bs-target="#view{{ $tx->id }}"></i>
                </td>
              </tr>

              <!-- MODAL -->
              <div class="modal fade" id="view{{ $tx->id }}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Transaction Descriptions</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <pre>{{ $tx->description }}</pre>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>

      </div> <!-- card-body -->
    </div> <!-- card -->

  </div>
</div>
@endsection
