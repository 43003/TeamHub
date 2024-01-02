        <?php
        // $conn->debug=true;
        $sql="SELECT * FROM `course` WHERE `is_deleted`=0 AND `course_status`=0  AND `lecturer_ID`=".tosql($_SESSION['SESS_UID']);
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
                      <span class="mb-2">Description: <?=$rs->fields['course_description'];?></span>
                      <?php
                      if($rs->fields['course_status']=='0'){
                        $status_txt="Active";
                        $status='success';
                      } else {
                        $status_txt="Inactive";
                        $status='danger';
                      }
                      ?>
                      <span class="mb-2">Status: <span class="badge badge-<?=$status;?>"><?=$status_txt?></span></span>
                    </div>
                    <div class="ms-auto text-end">
                      <div class="row">
                        <a class="btn btn-link text-info px-3 mb-0" href="index.php?data=<?php print base64_encode($dir.'/team/table_student.php;Teams;Student List;;;;'); ?>&cid=<?=$rs->fields['course_ID']?>">
                          <i class="material-icons text-sm me-2">visibility</i>View Students
                        </a>
                      </div>
                      <div class="row">
                        <a class="btn btn-link text-info px-3 mb-0" href="index.php?data=<?php print base64_encode($dir.'/team/table_team.php;Teams;Team List;;;;'); ?>&cid=<?=$rs->fields['course_ID']?>">
                          <i class="material-icons text-sm me-2">persons</i>View Teams
                        </a>
                      </div>
                      <div class="row">
                        <a class="btn btn-link text-info px-3 mb-0" href="index.php?data=<?php print base64_encode($dir.'/team/table_assessment.php;Teams;Assessment List;;;;'); ?>&cid=<?=$rs->fields['course_ID']?>">
                          <i class="material-icons text-sm me-2">description</i>View Assessment
                        </a>
                      </div>
                    </div>
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