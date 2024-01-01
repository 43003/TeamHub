      <?php include '../../connection/common.php'; ?>
      <script>
      function upperCase(evt){
        evt.value=evt.value.toUpperCase();
      }

      function do_save(){
        var ids = $('#ids').val();
        var course_code = $('#course_code').val();
        var course_name = $('#course_name').val();
        var description = $('#description').val();
        var status = $('input[name=status]:checked').val();
        // console.log(status);

        var fd = new FormData();
        fd.append('ids',ids);
        fd.append('course_code',course_code);
        fd.append('course_name',course_name);
        fd.append('description',description);
        fd.append('status',status);
        
        if(course_code=='' && course_name=='' && description==''){
          Swal.fire({
            title: "Warning!",
            text: "Please fill all the information!",
            icon: "warning"
          });
        } else {
          $.ajax({
            url: 'lecturer/course/course_sql.php?pro=SAVE',
            type: 'POST',
            beforeSend: function () {
              // $('.btn-submit').prop("disabled",true);
            },
            data: fd,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
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
          });
        }
      }
      </script>
      <?php
      $ids=isset($_GET["ids"])?$_GET["ids"]:"";
      // $conn->debug=true;
      $sql="SELECT * FROM course WHERE course_ID=".tosql($ids);
      $rs = $conn->query($sql);

      $course_code=$rs->fields['course_code'];
      $course_name=$rs->fields['course_name'];
      $course_description=$rs->fields['course_description'];
      $course_status=$rs->fields['course_status'];
      ?>
      <div class="modal-header">
        <label class="modal-title fs-5">Course Detail</label>
      </div>
      <div class="modal-body">
        <input type="hidden" name="ids" id="ids" value="<?=$ids?>">
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Course Code: </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group input-group-outline my-3">
              <input id="course_code" name="course_code" type="text" class="form-control" value="<?=$course_code;?>" onkeyup="upperCase(this)">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Course Name: </label>
            </div>
          </div>
          <div class="col-md-10">
            <div class="input-group input-group-outline my-3">
              <input id="course_name" name="course_name" type="text" class="form-control" value="<?=$course_name;?>" onkeyup="upperCase(this)">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Course Description: </label>
            </div>
          </div>
          <div class="col-md-10">
            <div class="input-group input-group-outline my-3">
              <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?=$course_description;?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Status: </label>
            </div>
          </div>
          <div class="col-md">
            <div class="input-group input-group-outline my-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active" value="0" <?php if($course_status=='' || $course_status=='0') print 'checked';?>>
                <label class="custom-control-label" for="active">Active</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="1" <?php if($course_status=='1') print 'checked';?>>
                <label class="custom-control-label" for="inactive">Inactive</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-dark btn-submit" onclick="do_save()">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>