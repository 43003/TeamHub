        <script>
        function do_modal(ids,team){
          $('#myModalLg .modal-content').load('student/team/modal.php?ids='+ids+"&team="+team)
        }

        function do_delete(ids){
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, do it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'student/team/team_sql.php?pro=DELETE',
                type: 'POST',
                data: {ids:ids},
                success: function(data) {
                  if(data == 'OK') {
                    Swal.fire({
                      title: "Success!",
                      text: "You have successfully drop this course.",
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
                    <div class="ms-auto text-end">
                      <?php if (!empty($rs->fields["team_ID"])) { ?>
                      <div class="row">
                        <a class="btn btn-link text-info px-3 mb-0" href="javascript:;"  data-bs-toggle="modal" data-bs-target="#myModalLg" onclick="do_modal('<?=$rs->fields['course_ID']?>','<?=$rs->fields['team_ID']?>')">
                          <i class="material-icons text-sm me-2">visibility</i>View Team Members
                        </a>
                      </div>
                      <?php } ?>
                      <div class="row">
                        <a class="btn btn-link text-danger px-3 mb-0" href="javascript:;" onclick="do_delete('<?=$rs->fields['course_ID']?>')">
                          <i class="material-icons text-sm me-2">delete</i>Drop Course
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