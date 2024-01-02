      <?php include '../../connection/common.php'; ?>
      <script src="assets/js/plugins/datatables.js"></script>
      <script>
      function do_save(){
        var no_member = $("#no_member").val();

        if(no_member.trim() == ''){
          Swal.fire({
            title: "Warning!",
            text: "Please fill all the details!",
            icon: "warning"
          });
        } else {
          var fd = new FormData();

          fd.append('no_member',no_member);
          var other_data = $('form').serializeArray();
          $.each(other_data,function(key,input){
            fd.append(input.name,input.value);
          });

          $.ajax({
            url: 'lecturer/team/team_sql.php?pro=GENERATE',
            type: 'POST',
            data: fd,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
              if(data == 'OK') {
                Swal.fire({
                  title: "Good job!",
                  text: "Team have been generated!",
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
      $sql="SELECT A.student_ID, B.student_name FROM student_course A, student B WHERE A.student_ID=B.student_ID AND A.course_ID=".tosql($ids)." AND A.status<>'2'";
      $rs = $conn->query($sql);
      ?>
      <div class="modal-header">
        <label class="modal-title fs-5">Team Detail</label>
      </div>
      <div class="modal-body">
        <input type="hidden" name="ids" id="ids" value="<?=$ids?>">
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Number of Member: </label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="input-group input-group-outline my-3">
              <input id="no_member" name="no_member" type="number" class="form-control" max="9" min="1">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Excluded Students (Optional): </label>
            </div>
          </div>
          <div class="col-md">
            <div class="table-responsive">
              <table class="table" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5"></th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-25">Matric No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-70">Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $bil=0;
                  while(!$rs->EOF){
                  ?>
                  <tr>
                    <td class="text-sm font-weight-normal">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="student[]" id="student" value="<?=$rs->fields["student_ID"]?>">
                      </div>
                    </td>
                    <td class="text-sm font-weight-normal"><?=$rs->fields["student_ID"]?></td>
                    <td class="text-sm font-weight-normal"><?=$rs->fields["student_name"]?></td>
                  </tr>
                  <?php
                    $rs->movenext();
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-dark btn-submit" onclick="do_save()">Generate</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>