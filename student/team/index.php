        <script>
        function do_form(team,course){
          $('#myModalLg .modal-content').load('student/team/modal.php?team_id='+team+"&course_id="+course)
        }
        </script>

        <?php
        // $conn->debug=true;

        $sql="SELECT A.course_ID, A.team_ID, b.lecturer_ID, B.course_code, B.course_name, B.course_description 
        FROM `student_course` A, `course` B 
        WHERE  A.`course_ID`=B.`course_ID` AND A.`status`<>2 AND A.`student_ID`=".tosql($_SESSION['SESS_UID']);

        $rs=$conn->query($sql);
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">List of Courses</h6>
                  </div>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <ul class="list-group">
                  <?php
                  if (!$rs->EOF) {
                    while(!$rs->EOF) {
                  ?>
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3"><?=$rs->fields['course_code'];?> <?=$rs->fields['course_name'];?></h6>
                      <span class="mb-2">Lecturer: <b><?=dlookup("lecturer","lecturer_name","lecturer_ID=".tosql($rs->fields["lecturer_ID"]))?></b></span>
                      <span class="mb-2">Description: <?=$rs->fields['course_description'];?></span>
                    </div>
                    <?php if (!empty($rs->fields["team_ID"])) { ?>
                    <div class="ms-auto text-end">
                      <div class="row">
                        <a class="btn btn-link text-info px-3 mb-0" href="javascript:;"  data-bs-toggle="modal" data-bs-target="#myModalLg" onclick="do_modal('<?=$rs->fields['course_ID']?>','<?=$rs->fields['team_ID']?>')">
                          <i class="material-icons text-sm me-2">visibility</i>View Team Members
                        </a>
                      </div>
                    </div>
                    <?php } ?>
                  </li>
                  <?php
                      $rs->movenext();
                    }
                  } else{ ?>
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="col text-center">
                      <h6 class="mb-3">NO DATA OF COURSES</h6>
                    </div>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>