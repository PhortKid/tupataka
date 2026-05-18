<!-- Edit Region Modal -->
<div class="modal fade" id="editRegion{{ $region->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('region_management.update', $region->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Region</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name{{ $region->id }}">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $region->name }}" required>
          </div>
          <div class="form-group">
            <label for="description{{ $region->id }}">Description</label>
            <input type="text" class="form-control" name="description" value="{{ $region->description }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
