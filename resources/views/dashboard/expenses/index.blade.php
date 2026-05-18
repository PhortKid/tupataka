@extends('layout.app')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4 fw-bold">Expenses</h3>

    {{-- Add Expense Button --}}
    <div class="text-end mb-3">
        <button class="btn bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
            <i class="bi bi-plus-circle"></i> Add Expense
        </button>
    </div>

    {{-- Add Expense Modal --}}
    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">

                <div class="modal-header  text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-cash-coin me-2"></i> Add New Expense
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">

                    <form action="{{ route('expenses.store') }}" method="POST">
                        @csrf

                        {{-- BASIC INFO --}}
                        <div class="row g-3 mb-4">

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Date</label>
                                <input type="date" name="expense_date" class="form-control form-control-lg rounded-3" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Payee</label>
                                <select name="payee_id" class="form-select form-select-lg rounded-3" required>
                                    <option value="">-- Select Payee --</option>
                                    @foreach($payees as $payee)
                                        <option value="{{ $payee->id }}">{{ $payee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        {{-- ITEMS --}}
                        <h5 class="fw-bold mb-3">Expense Items</h5>

                        <table class="table table-bordered align-middle" id="itemsTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="25%">Category</th>
                                    <th width="15%">Amount</th>
                                    <th>Description</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>

                            <tbody id="itemsBody">
                                <tr>
                                    <td>
                                        <select name="items[category][]" class="form-select" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="number" name="items[amount][]" class="form-control" required>
                                    </td>

                                    <td>
                                        <input type="text" name="items[description][]" class="form-control">
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-danger btn-sm removeRow">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-outline-secondary btn-sm mb-4" id="addRow">
                            <i class="bi bi-plus-circle"></i> Add Item
                        </button>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4 rounded-3">
                                <i class="bi bi-check2-circle me-2"></i> Save Expense
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    {{-- Expenses Table (Normal table, no DataTable) --}}
    <div class="card  shadow-sm">
        <div class="card-header  text-white d-flex align-items-center">
            
            <h5 class="mb-0">Expenses List</h5>
        </div>

        <div class="card-body">
            <table class="table table-flush" id="datatable-search">
                <thead class="thead-light">
                  <tr>
                    <th>Voucher No</th>
                    <th>Date</th>
                    <th>Payee</th>
                    <th>Items</th>
                    <th>Total</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($expenses as $exp)
                    <tr>
                      <td>{{ $exp->voucher_no }}</td>
                      <td>{{ $exp->expense_date }}</td>
                      <td>{{ $exp->payee->name ?? '-' }}</td>
                      <td>
                        <ul class="mb-0 ps-3">
                          @foreach($exp->children as $item)
                            <li>{{ $item->category->name ?? 'N/A' }} - {{ number_format($item->amount, 2) }} ({{ $item->description }})</li>
                          @endforeach
                        </ul>
                      </td>
                      <td>{{ number_format($exp->children->sum('amount'), 2) }}</td>
                    </tr>
                  @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

{{-- JS --}}
<script>
$(document).ready(function() {

    var categories = @json($categories);

    // Add Row
    $('#addRow').click(function() {
        let options = '<option value="">-- Select Category --</option>';
        categories.forEach(cat => {
            options += `<option value="${cat.id}">${cat.name}</option>`;
        });

        let row = `
        <tr>
            <td><select name="items[category][]" class="form-select" required>${options}</select></td>
            <td><input type="number" name="items[amount][]" class="form-control" required></td>
            <td><input type="text" name="items[description][]" class="form-control"></td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-danger btn-sm removeRow">
                    <i class="bi bi-x-lg"></i>
                </button>
            </td>
        </tr>`;

        $('#itemsBody').append(row);
    });

    // Remove Row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
    });

});
</script>

@endsection
