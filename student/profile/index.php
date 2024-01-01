            <?php
            // $conn->debug=true;
            $rsp = $conn->query("SELECT * FROM student WHERE student_ID=".tosql($_SESSION["SESS_UID"]));
            ?>
            <div class="row">
              <div class="col-4">
                <div class="card h-100">
                  <div class="card-header">
                    <h5>Profile Image</h5>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new img-thumbnail" style="width: 320px; height: 320px;">
                          <img src="assets/img/profile_picture.png"  alt="profile_picture">
                        </div>
                        <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 320px; max-height: 320px;"></div>
                        <div class="mt-3">
                          <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                          <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div>
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
                          <input id="full_name" name="full_name" type="text" class="form-control" value="<?=$rsp->fields["student_name"];?>" style="text-transform: uppercase;">
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <label class="form-label">Course </label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <input id="course" name="course" type="text" class="form-control" value="<?=$rsp->fields["course"];?>" style="text-transform: uppercase;">
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <label class="form-label">Class </label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="input-group input-group-outline">
                          <input id="class" name="class" type="text" class="form-control" value="<?=$rsp->fields["class"];?>" style="text-transform: uppercase;">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="w-100">
                      <div class="d-flex justify-content-end mt-4" bis_skin_checked="1">
                        <button type="button" name="button" class="btn bg-gradient-dark m-0 ms-2" onclick="do_save_info()">Save Changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
            $('.m_phone').mask('000-000000000');
            $('.o_phone').mask('00-0000000');
            var quill = new Quill('#editor', {
              theme: 'snow' // Specify theme in configuration
            });
              
            function do_save_info(){

              // Insert quill to input
              $("#description").val(quill.root.innerHTML);

              var lecturer_name = $('#full_name').val();
              var mobile_phone = $('#mobile_phone').val();
              var office_phone = $('#office_phone').val();
              var office_location = $('#office_location').val();
              var description = $('#description').val();

              if (lecturer_name.trim() == '' || mobile_phone.trim() == '' || office_phone.trim() == '' || office_location.trim() == '' || quill.getLength() == 1) {
                Swal.fire({
                  title: "Warning!",
                  text: "Please fill the profile information form!",
                  icon: "warning"
                });
              } else {
                var fd = new FormData();
                
                fd.append("lecturer_name",lecturer_name);
                fd.append("mobile_phone",mobile_phone);
                fd.append("office_phone",office_phone);
                fd.append("office_location",office_location);
                fd.append("description",description);
                
                $.ajax({
                  url: 'lecturer/profile/profile_sql.php?pro=INFO',
                  type: 'POST',
                  processData: false,
                  contentType: false,
                  cache: false,
                  data: fd,
                  success: function(data){
                    if(data == 'OK') {
                      Swal.fire({
                        title: "Good job!",
                        text: "You data has been save!",
                        icon: "success"
                      }).then(function(){
                        window.location.reload();
                      });
                    } else {
                      Swal.fire({
                        title: "Error!",
                        text: "There is an error in the server side!",
                        icon: "error"
                      });
                      // $('.btn-sign-in').prop("disabled",false);
                    }
                  }
                })
              }
            }
            </script>