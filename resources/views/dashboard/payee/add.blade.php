<div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Payee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('payee.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">TIN</label>
                        <input type="text" class="form-control" name="tin" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mobile</label>
                        <input type="text" class="form-control" name="mobile" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required autocomplete="off">
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
