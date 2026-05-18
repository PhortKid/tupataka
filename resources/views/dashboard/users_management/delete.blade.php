<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" aria-labelledby="deleteUserLabel{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel{{$user->id}}">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('users_management.destroy', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>