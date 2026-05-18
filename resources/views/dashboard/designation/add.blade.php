<div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Designation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('designation.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-dark">Save changes</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
