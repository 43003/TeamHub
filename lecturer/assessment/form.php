      <?php include '../../connection/common.php'; ?>
      <script>
      function upperCase(evt){
        evt.value=evt.value.toUpperCase();
      }

      function do_save(){
        var ids = $('#ids').val();
        var course = $('#course').val();
        var assessment_type = $('#assessment_type').val();
        var assessment_title = $('#assessment_title').val();
        var assessment_document = $('#assessment_document')[0].files[0];
        var assessment_document_value = $('#assessment_document').val(); 
        var date_start = $('#date_start').val();
        var date_end = $('#date_end').val();
        // console.log(assessment_document_value);

        var fd = new FormData();
        fd.append('ids',ids);
        fd.append('course',course);
        fd.append('assessment_type',assessment_type);
        fd.append('assessment_title',assessment_title);
        fd.append('assessment_document',assessment_document);
        fd.append('date_start',date_start);
        fd.append('date_end',date_end);
        
        if(assessment_type.trim()=='' || assessment_title.trim()=='' || assessment_document_value.trim()=='' || date_start.trim()=='' || date_end.trim()==''){
          Swal.fire({
            title: "Warning!",
            text: "Please fill all the information!",
            icon: "warning"
          });
        } else {
          $.ajax({
            url: 'lecturer/assessment/assessment_sql.php?pro=SAVE',
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
      $course=isset($_GET["course"])?$_GET["course"]:"";
      // $conn->debug=true;
      $sql="SELECT * FROM assessment WHERE assessment_ID=".tosql($ids);
      $rs = $conn->query($sql);

      $category=$rs->fields['category'];
      $title=$rs->fields['title'];
      $start_date=$rs->fields['start_date'];
      $due_date=$rs->fields['due_date'];
      ?>
      <div class="modal-header">
        <label class="modal-title fs-5">Assessment Detail</label>
      </div>
      <div class="modal-body">
        <input type="hidden" name="ids" id="ids" value="<?=$ids?>">
        <input type="hidden" name="course" id="course" value="<?=$course?>">
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
                <option value="<?=$rsT->fields['assessment_type_ID']?>" <?php if ($category == $rsT->fields['assessment_type_ID']) print 'selected' ?>>
                  <?=$rsT->fields['type_name']?>
                </option>
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
              <input id="assessment_title" name="assessment_title" type="text" class="form-control" value="<?=$title?>" onkeyup="upperCase(this)">
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
              <input type="file" class="form-control" name="assessment_document" id="assessment_document" value="">
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
              <input class="form-control datetimepicker" type="text" name="date_start" id="date_start" data-input value="">
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
              <input class="form-control datetimepicker" type="text" name="date_end" id="date_end" data-input value="">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-dark btn-submit" onclick="do_save()">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      <script>
        $("#date_start").flatpickr({
          allowInput: false,
          enableTime: true,
          dateFormat: "Y-m-d H:i",
          minuteIncrement: 1,
          defaultDate: '<?=$start_date?>'
        });
        
        $("#date_end").flatpickr({
          allowInput: false,
          enableTime: true,
          dateFormat: "Y-m-d H:i",
          minuteIncrement: 1,
          defaultDate: '<?=$due_date?>'
        });
      </script>