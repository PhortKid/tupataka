<!-- Add Fuel Rate Modal -->
<div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Fuel Rate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('fuel_rate.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">Fuel Type</label>
            <select name="type" class="form-control">
              <option value="LAKES">LAKES</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Fuel Rate</label>
            <input type="number" class="form-control" name="rate">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-gradient-dark">Save Changes</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>
