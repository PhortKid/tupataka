@extends('layout.app')

@section('content')
<div class="container">
    <h3>Expenses</h3>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Expense Button --}}
    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#addExpenseModal">
        <i class="glyphicon glyphicon-plus"></i> Add Expense
    </button>

    {{-- Modal --}}
    <div class="modal fade" id="addExpenseModal" tabindex="-1" role="dialog" aria-labelledby="addExpenseModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="addExpenseModalLabel">Add New Expense</h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="expense_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payee</label>
                            <select name="payee_id" class="form-control" required>
                                <option value="">-- Select Payee --</option>
                                @foreach($payees as $payee)
                                    <option value="{{ $payee->id }}">{{ $payee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h4>Expense Items</h4>
                <table class="table table-bordered" id="itemsTable">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="itemsBody">
                        <tr>
                            <td>
                                <select name="items[category][]" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="items[amount][]" class="form-control" required></td>
                            <td><input type="text" name="items[description][]" class="form-control"></td>
                            <td><button type="button" class="btn btn-danger btn-xs removeRow">X</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" class="btn btn-default btn-xs" id="addRow">+ Add Item</button>
                <br><br>
                <button type="submit" class="btn btn-primary">Save Expense</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- List ya Expenses --}}
    <div class="panel panel-default" style="margin-top:20px;">
        <div class="panel-heading">Expense List</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
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
                                <ul style="padding-left: 18px;">
                                    @foreach($exp->children as $item)
                                        <li>
                                            {{ $item->category->name ?? 'N/A' }} - 
                                            {{ number_format($item->amount, 2) }}
                                            ({{ $item->description }})
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                {{ number_format($exp->children->sum('amount'), 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var categories = @json($categories);

    // Add new row
    $('#addRow').click(function() {
        var options = '<option value="">-- Select Category --</option>';
        categories.forEach(function(cat){
            options += '<option value="'+cat.id+'">'+cat.name+'</option>';
        });

        var row = '<tr>' +
                    '<td><select name="items[category][]" class="form-control" required>'+options+'</select></td>' +
                    '<td><input type="number" name="items[amount][]" class="form-control" required></td>' +
                    '<td><input type="text" name="items[description][]" class="form-control"></td>' +
                    '<td><button type="button" class="btn btn-danger btn-xs removeRow">X</button></td>' +
                  '</tr>';

        $('#itemsBody').append(row);
    });

    // Remove row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
    });
});
</script>
@endsection



{{-- 
<script>
document.getElementById('addRow').addEventListener('click', function () {
    var row = `
        <tr>
            <td>
                <select name="items[category][]" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="items[amount][]" class="form-control" required></td>
            <td><input type="text" name="items[description][]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-xs removeRow">X</button></td>
        </tr>
    `;
    document.querySelector('#itemsBody').insertAdjacentHTML('beforeend', row);
});

// delete row
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('removeRow')) {
        e.target.closest('tr').remove();
    }
});
</script>
--}}
