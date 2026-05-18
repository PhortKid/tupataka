<!-- Disabled Backdrop Modal -->
<div class="modal fade" id="disablebackdrop" tabindex="-1" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Petty Cash Received</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pettycash_received.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="date_received" class="form-label">Date Received</label>
                        <input type="date" class="form-control" name="date_received" required>
                    </div>

                    <div class="mb-3">
                        <label for="cash_source_id" class="form-label">Cash Source</label>
                        <select class="form-control" name="cash_source_id" required>
                            <option value="">-- Select Source --</option>
                            @foreach($sources as $source)
                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control" name="amount" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
              
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
