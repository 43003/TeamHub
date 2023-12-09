        <script>
        function do_form(ids){
          $('#myModalLg .modal-content').load('lecturer/course/form.php')
        }
        </script>

        <?php
        $sql="SELECT * FROM `course` WHERE `is_deleted`=0 AND `lecturer_ID`=".tosql($_SESSION['SESS_UID']);
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
                  <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"  data-bs-toggle="modal" data-bs-target="#myModalLg" onclick="do_form('')">
                      <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Course
                    </a>
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
                      <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
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