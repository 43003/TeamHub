        <script>
        function do_search(evt){
          var value = evt.value.toLowerCase().trim();
          $("#courses li").each(function () {
            if ($(this).find('.title').text().toLowerCase().search(value) > -1) {
              $(this).removeClass("d-none");
            } else {
              $(this).addClass("d-none");
            }
          });   
        }

        function do_enroll(ids){
          Swal.fire({
            title: "Are you sure?",
            text: "You will join this course",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, enroll it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'student/course/course_sql.php?pro=ENROLL',
                type: 'POST',
                beforeSend: function () {
                  // $('.btn-submit').prop("disabled",true);
                },
                data: {ids:ids},
                success: function(data) {
                  if(data == 'OK') {
                    Swal.fire({
                      title: "Enrolled!",
                      text: "Your has enrolled to this course.",
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
        $sql="SELECT * FROM `course` WHERE `is_deleted`=0 AND `course_status`=0 AND `course_ID` NOT IN (SELECT `course_ID` FROM `student_course` WHERE `student_ID`=".tosql($_SESSION["SESS_UID"]).")";
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
                    <div class="input-group input-group-outline">
                      <label class="form-label">Search here</label>
                      <input id="search" name="search" type="text" class="form-control" oninput="do_search(this)">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <ul class="list-group" id="courses">
                  <?php
                  if (!$rs->EOF) {
                    while(!$rs->EOF) {
                  ?>
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 title"><?=$rs->fields['course_code'];?> <?=$rs->fields['course_name'];?></h6>
                      <span class="mb-2">Lecturer: <b><?=dlookup("lecturer","lecturer_name","lecturer_ID=".tosql($rs->fields["lecturer_ID"]))?></b></span>
                      <span class="mb-2">Description: <?=$rs->fields['course_description'];?></span>
                    </div>
                    <div class="ms-auto text-end">
                      <div class="row">
                        <a class="btn btn-link text-info px-3 mb-0" onclick="do_enroll('<?=$rs->fields['course_ID']?>')">
                          <i class="material-icons text-sm me-2">add</i>Enroll
                        </a>
                      </div>
                    </div>
                  </li>
                  <?php
                      $rs->movenext();
                    }
                  } else { 
                  ?>
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="col text-center">
                      <h6 class="mb-3">NO DATA OF COURSES</h6>
                    </div>
                  </li>
                  <?php 
                  } 
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>