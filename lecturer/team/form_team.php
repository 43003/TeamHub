      <?php include '../../connection/common.php'; ?>
      <script src="assets/js/plugins/datatables.js"></script>
      <script>

      function do_save(){
        var team = $("#team").val();
        var ids = $("#ids").val();
        var studentID = $("#studentID").val();

        if(team.trim() == ''){
          Swal.fire({
            title: "Warning!",
            text: "Please select team to join!",
            icon: "warning"
          });
        } else {
          var fd = new FormData();

          fd.append('team',team);
          fd.append('ids',ids);
          fd.append('studentID',studentID);

          $.ajax({
            url: 'lecturer/team/team_sql.php?pro=JOIN',
            type: 'POST',
            data: fd,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
              if(data == 'OK') {
                Swal.fire({
                  title: "Good job!",
                  text: "Student successfully join the team!",
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
      $student=isset($_GET["student"])?$_GET["student"]:"";
      ?>
      <div class="modal-header">
        <label class="modal-title fs-5">Team Detail</label>
      </div>
      <div class="modal-body">
        <input type="hidden" name="ids" id="ids" value="<?=$ids?>">
        <input type="hidden" name="studentID" id="studentID" value="<?=$student?>">
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Teams: </label>
            </div>
          </div>
          <div class="col-md">
            <div class="input-group input-group-outline my-3">
              <select class="form-control" name="team" id="team">
                <option value="">Please Select</option>
                <?php
                $sqlT="SELECT * FROM `team` WHERE course_ID=".tosql($ids);
                $rsT=$conn->query($sqlT);
                while (!$rsT->EOF) {
                ?>
                <option value="<?=$rsT->fields['team_ID']?>"><?=$rsT->fields['team_name']?></option>
                <?php
                  $rsT->movenext();
                }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-dark btn-submit" onclick="do_save()">Join</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>