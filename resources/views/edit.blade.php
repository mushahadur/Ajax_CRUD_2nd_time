<!-- Model Start -->

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-header">
        <h1 class="text-center text-primary" id="editModalLabel">Student Update Form</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="editForm">
            @csrf
            <input type="hidden" id="up_id"  />
            <div class="modal-body">
                <div class="errMessContainer"></div>
                
                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-3">Name</label>
                    <div class="col-md-9">
                        <input type="text" id="up_name" name="up_name" class="form-control" placeholder="Enter Name" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-3">Email</label>
                    <div class="col-md-9">
                        <input type="email" id="up_email"  name="up_email" class="form-control" placeholder="Enter Email" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-3">Image</label>
                    <div class="col-md-9">
                        <input type="file" id="up_image" name="up_image" class="form-control" />
                    </div>
                </div>
            </div>
        </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="editBtn" class="btn btn-success add_student">Update Student Info</button>
      </div>
</div>
<!-- Modal End -->
