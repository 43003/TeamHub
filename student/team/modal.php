      <?php include '../../connection/common.php'; ?>
      <?php 
      $ids=isset($_GET["ids"])?$_GET["ids"]:"";
      $team=isset($_GET["team"])?$_GET["team"]:"";
      ?>
      <script>
      function do_change() {
        $('.teams').css('display','');
        $('.change').css('display','none');
        $('.confirm').css('display','');
      }

      function do_confirm() {
        var ids = $('#ids').val();
        var team = $('#team').val();
        var team_id = $('#team_id').val();
        
        if(team_id.trim()==''){
          Swal.fire({
            title: "Warning!",
            text: "Please select new team!",
            icon: "warning"
          });
        } else {
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'student/team/team_sql.php?pro=CHANGE',
                type: 'POST',
                data: {ids: ids, team: team, team_id:team_id},
                success: function(data) {
                  if(data == 'OK') {
                    Swal.fire({
                      title: "Success!",
                      text: "Your team has been changed.",
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
          });
        }
      }
      </script>
      <?php
      // $conn->debug=true;
      $sql="SELECT * FROM `student_course` WHERE course_ID=".tosql($ids)." AND team_ID=".tosql($team);
      $rs = $conn->query($sql);
      ?>
      <div class="modal-header">
        <label class="modal-title fs-5">Team Information</label>
        <input type="hidden" name="ids" id="ids" value="<?=$ids?>">
        <input type="hidden" name="team" id="team" value="<?=$team?>">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-2">
            <p>Team Name: </p>
          </div>
          <div class="col-md-4">
              <p><?=dlookup("team","team_name","team_ID=".tosql($team))?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <p>Members: </p>
          </div>
          <div class="col-md">
            <?php
            while(!$rs->EOF){
            ?>
            <p>
              <b><?=$rs->fields["student_ID"]?></b> <?=dlookup("student","student_name","student_ID=".tosql($rs->fields["student_ID"])) ?>
              <?php if ($rs->fields['is_leader']=='Y') { ?>
              &nbsp;<span class="badge bg-gradient-success">Leader</span>
              <?php } ?>
            </p>
            <?php
              $rs->movenext();
            }
            ?>
          </div>
        </div>
        <div class="row teams" style="display: none;">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <p>New Team:</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group input-group-outline my-3">
              <select class="form-control" name="team_id" id="team_id">
                <option value="">Please Select</option>
                <?php
                $rsTeam = $conn->query("SELECT * FROM `team` WHERE `course_ID`=".tosql($ids)." AND `team_ID` NOT IN (".tosql($team).") AND `team_status`=0");
                while (!$rsTeam->EOF) {
                ?>
                <option value="<?=$rsTeam->fields['team_ID']?>">
                  <?=$rsTeam->fields['team_name']?>
                </option>
                <?php
                  $rsTeam->movenext(); 
                }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info change" onclick="do_change()">Change Team</button>
        <button type="button" class="btn btn-info confirm" style="display: none;" onclick="do_confirm()">Confirm Change</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>