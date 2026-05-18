<!-- Edit User Modal (Bootstrap 3 version) -->
<div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel{{ $user->id }}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="editUserLabel{{ $user->id }}">Edit User</h4>
      </div>

      <div class="modal-body">
        <form action="{{ route('users_management.update', $user->id) }}" method="post">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" required>
          </div>

          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
          </div>

          <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}" required>
          </div>

          <div class="form-group">
            <label for="role">Role</label>
            <select name="role_id" class="form-control">
              @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save Changes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
