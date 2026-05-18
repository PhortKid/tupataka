<!-- Disabled Backdrop Modal -->
<div class="modal fade" id="disablebackdrop" tabindex="-1" data--backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Users</h5>
          
            </div>
            <div class="modal-body">
                <form action="{{ route('users_management.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter firstname" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter lastname" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="07..." required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role_id" id="role" class="form-control">
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                             @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data--dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
