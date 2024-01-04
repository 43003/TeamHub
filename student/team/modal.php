      <?php include '../../connection/common.php'; ?>
      <script>
      </script>
      <?php
      $ids=isset($_GET["ids"])?$_GET["ids"]:"";
      $team=isset($_GET["team"])?$_GET["team"]:"";
      // $conn->debug=true;
      $sql="SELECT * FROM `student_course` WHERE course_ID=".tosql($ids)." AND team_ID=".tosql($team);
      $rs = $conn->query($sql);
      ?>
      <div class="modal-header">
        <label class="modal-title fs-5">Team Information</label>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>