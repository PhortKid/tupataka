<!-- Disabled Backdrop Modal -->
<div class="modal fade" id="disablebackdrop" tabindex="-1" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Staff</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('staff.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="firstname" class="form-label">FirstName</label>
                        <input type="text" class="form-control"  name="firstname" required autocomplete="off">
                    </div>

                     <div class="mb-3">
                        <label for="middlename" class="form-label">MiddleName</label>
                        <input type="text" class="form-control"  name="middlename"  autocomplete="off">
                    </div>

                     <div class="mb-3">
                        <label for="name" class="form-label">LastName</label>
                        <input type="text" class="form-control"  name="lastname" required autocomplete="off">
                    </div>

                     <div class="mb-3">
                        <label for="name" class="form-label">Date Of Birth</label>
                        <input type="date" class="form-control"  name="dob" required autocomplete="off">
                    </div>
                       
                    <div class="mb-3">
                        <label for="name" class="form-label">Designation</label>
                        <select name="designation_id" class="form-control">
                            @foreach($designations as $designation)
                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                            @endforeach
                        </select>
                    </div>

                     <div class="mb-3">
                        <label for="name" class="form-label">Email Adress</label>
                        <input type="email" class="form-control"  name="email_address" required autocomplete="off">
                    </div>
                     <div class="mb-3">
                        <label for="name" class="form-label">Phone1</label>
                        <input type="text" class="form-control"  name="phone1" required autocomplete="off">
                    </div>
                     <div class="mb-3">
                        <label for="name" class="form-label">Phone2</label>
                        <input type="text" class="form-control"  name="phone2"  autocomplete="off">
                    </div>

                    <div class="mb-4">
                     <label for="rate" class="block">Gender</label>
                       <select class="form-control" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                       </select>    
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nida</label>
                        <input type="text" class="form-control"  name="nida"  autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nssf Refference</label>
                        <input type="text" class="form-control"  name="nssf_refference"  autocomplete="off">
                    </div>

                      <div class="mb-3">
                        <label for="name" class="form-label">TIN Refference</label>
                        <input type="text" class="form-control"  name="tin_refference"  autocomplete="off">
                    </div>

                     <div class="mb-3">
                        <label for="name" class="form-label">Residential Address</label>
                        <input type="text" class="form-control"  name="residential_address"  autocomplete="off">
                    </div>

                      <div class="mb-3">
                        <label for="name" class="form-label">Permanent Resident</label>
                        <input type="text" class="form-control"  name="permanent_address"  autocomplete="off">
                    </div>

                       <div class="mb-3">
                        <label for="name" class="form-label">Contact Person Name</label>
                        <input type="text" class="form-control"  name="contact_person_name"  autocomplete="off">
                    </div>

                       <div class="mb-3">
                        <label for="name" class="form-label">Contact Person Mobile</label>
                        <input type="text" class="form-control"  name="contact_person_mobile"  autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Contact Person Address</label>
                        <input type="text" class="form-control"  name="contact_person_address"  autocomplete="off">
                    </div>
              
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
