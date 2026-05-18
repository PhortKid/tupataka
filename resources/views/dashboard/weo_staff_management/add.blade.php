<div class="modal fade" id="disablebackdrop" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header  text-white">
                <h5 class="modal-title">Add WEO Staff</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('weo_staff_management.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control" placeholder="Enter firstname" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middlename" class="form-control" placeholder="Enter middlename">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control" placeholder="Enter lastname" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="07..." required>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn bg-gradient-dark">Save Staff</button>
                </div>

            </form>
        </div>
    </div>
</div>
