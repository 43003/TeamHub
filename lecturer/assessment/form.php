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
        var status = $('#status:checked').val();
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
        <label class="modal-title fs-5">Assessment Detail</label>
      </div>
      <div class="modal-body">
        <input type="hidden" name="ids" id="ids" value="<?=$ids?>">
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Type: </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group input-group-outline my-3">
              <select class="form-control assessment_type" name="assessment_type" id="assessment_type">
                <option value="">Please Select</option>
                <?php
                $sqlT="SELECT * FROM assessment_type";
                $rsT=$conn->query($sqlT);
                while (!$rsT->EOF) {
                ?>
                <option value="<?=$rsT->fields['assessment_type_ID']?>"><?=$rsT->fields['type_name']?></option>
                <?php
                  $rsT->movenext();
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Title: </label>
            </div>
          </div>
          <div class="col-md-10">
            <div class="input-group input-group-outline my-3">
              <input id="assessment_title" name="assessment_title" type="text" class="form-control" value="" onkeyup="upperCase(this)">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Document: </label>
            </div>
          </div>
          <div class="col-md-10">
            <div class="input-group input-group-outline my-3">
              <input type="file" class="form-control" name="assessment_document" id="assessment_document">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Date Start: </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="input-group input-group-outline my-3">
              <input class="form-control datetimepicker" type="text" name="date_start" id="date_start" data-input>
            </div>
          </div>
        </div><div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Date End: </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="input-group input-group-outline my-3">
              <input class="form-control datetimepicker" type="text" name="date_end" id="date_end" data-input>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-dark btn-submit" onclick="do_save()">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      <script>
        $(".datetimepicker").flatpickr({
          allowInput: false,
          enableTime: true,
          dateFormat: "Y-m-d H:i",
        });
      </script>