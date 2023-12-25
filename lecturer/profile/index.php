            <script>
            </script>
            <div class="row">
              <div class="col-4">
                <div class="card h-100">
                  <div class="card-header">
                    <h5>Profile Image</h5>
                  </div>
                  <div class="card-body pt-0">
                    
                  </div>
                  <div class="card-footer">
                    <div class="w-100">
                      <div class="d-flex justify-content-end mt-4" bis_skin_checked="1">
                        <button type="button" name="button" class="btn bg-gradient-dark m-0 ms-2">Upload Picture</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-8">
                <div class="card h-100">
                  <div class="card-header">
                    <h5>Profile Information</h5>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row mb-4">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <label class="form-label">Full Name </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="input-group input-group-outline">
                          <input id="full_name" name="full_name" type="text" class="form-control" value="" style="text-transform: uppercase;">
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <label class="form-label">Mobile </label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <input id="mobile_phone" name="mobile_phone" type="text" class="form-control phone" value="">
                        </div>
                      </div>
                    </div> 
                    <div class="row mb-4">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <label class="form-label">Email </label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="input-group input-group-outline">
                          <input id="email" name="email" type="text" class="form-control" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <label class="form-label">Office Location </label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <input id="office_location" name="office_location" type="text" class="form-control" value="" style="text-transform: uppercase;">
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <label class="form-label">About Yourself </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div id="editor"></div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="w-100">
                      <div class="d-flex justify-content-end mt-4" bis_skin_checked="1">
                        <button type="button" name="button" class="btn bg-gradient-dark m-0 ms-2">Save Changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
              $('.phone').mask('000-000000000');
              var quill = new Quill('#editor', {
                theme: 'snow' // Specify theme in configuration
              });
            </script>