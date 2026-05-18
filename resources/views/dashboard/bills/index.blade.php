@extends('layout.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Verified Customer</h5>
                    </div>

                    <div class="card-content ">
                     <div class="d-flex justify-content-end gap-2 mb-3 pe-2">


                        <a class="btn btn-outline-success btn-sm px-3" data-bs-toggle="modal"
                           data-bs-target="#addIndividualBillModal">
                            <i class="fa-solid fa-user-plus"></i> Add Individual Bill
                        </a>
                        
                        <a class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal"
                           data-bs-target="#addBulkBillModal">
                            <i class="fa-solid fa-users"></i> Add Bulk Bill
                        </a>



                        </div>


                        <!-- Individual Bill Modal -->
                        <div class="modal fade" id="addIndividualBillModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('bills.individual') }}" method="POST">
                                        @csrf

                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Individual Bill</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">Customer</label>
                                                <select name="customer_id" class="form-select" required
                                                    id="customerSelect">
                                                    <option value="">Select Customer</option>
                                                    @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        data-amount="{{ $customer->businessActivity->bill_amount }}">
                                                        {{ $customer->name }} ({{ $customer->businessActivity->name }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Amount</label>
                                                <input type="number" step="0.01" name="amount" id="billAmount"
                                                    class="form-control" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Date</label>
                                                <input type="date" name="date" class="form-control" required>
                                            </div>

                                        </div> <!-- end modal-body -->

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-sm">Add Bill</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- Bulk Bill Modal -->
                        <div class="modal fade" id="addBulkBillModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('bills.bulk') }}" method="POST">
                                        @csrf

                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Bulk Bill</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">Date</label>
                                                <input type="date" name="date" class="form-control" required>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Bulk Bill</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Table displaying customers --}}
                        <div class="material-datatables">
                            <table class="table table-flush" id="datatable-search">
                                <thead>
                                    <tr>
                                        <th>CUSTOMER</th>
                                        <th>CONTROL NO#</th>
                                        <th>NO OF BILLS</th>
                                        <th>TOTAL BILLED</th>
                                        <th>TOTAL PAID</th>
                                        <th>BALANCE</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                    @php
                                    $total_billed = $customer->bills->sum('amount');
                                    $total_paid = $customer->payments->sum('amount');
                                    $balance = $total_paid - $total_billed;
                                    @endphp

                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->control_number }}</td>
                                        <td>{{ $customer->bills->count() }}</td>
                                        <td>{{ number_format($total_billed) }} TZS</td>
                                        <td>{{ number_format($total_paid) }} TZS</td>
                                        <td>{{ number_format($balance) }} TZS</td>

                                        <td class="text-center">
                                            <a href="#" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#addIndividualBillModal">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div><!-- end card-content -->
                </div><!-- end card -->
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('customerSelect').addEventListener('change', function() {
    const amount = this.options[this.selectedIndex].dataset.amount || 0;
    document.getElementById('billAmount').value = amount;
});
</script>

@endsection