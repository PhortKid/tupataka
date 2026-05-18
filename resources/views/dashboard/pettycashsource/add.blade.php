<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Petty Cash Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('pettycashsource.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-dark">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>
