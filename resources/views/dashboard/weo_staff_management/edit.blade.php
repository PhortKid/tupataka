<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $staff->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header ">
                <h5 class="modal-title">Edit WEO Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('weo_staff_management.update', $staff->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control" value="{{ $staff->firstname }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middlename" class="form-control" value="{{ $staff->middlename }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="{{ $staff->lastname }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" value="{{ $staff->phone_number }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $staff->email }}">
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn bg-gradient-warning">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>
