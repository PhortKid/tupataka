<!-- Disabled Backdrop Modal -->
<div class="modal fade" id="disablebackdrop" tabindex="-1" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Regular Customer Bill</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('regular_customer_bill_management.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="firstname" name="name" required autocomplete="off">
                    </div>

                     <div class="mb-4">
                        <label for="rate" class="block">Rate</label>
                        <input type="text" class="form-control" name="rate"  class="border rounded w-full p-2">
                    </div>
              
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
