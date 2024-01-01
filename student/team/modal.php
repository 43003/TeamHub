      <?php include '../../connection/common.php'; ?>
      <script>
      </script>
      <?php
      $team_id=isset($_GET["team_id"])?$_GET["team_id"]:"";
      $course_id=isset($_GET["course_id"])?$_GET["course_id"]:"";
      // $conn->debug=true;
      $sql="SELECT * FROM `student_course` WHERE team_ID=".tosql($ids)." AND course_ID".tosql($ids);
      $rs = $conn->query($sql);
      ?>
      <div class="modal-header">
        <label class="modal-title fs-5">Team Information</label>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>