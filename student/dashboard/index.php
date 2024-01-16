               <?php include 'connection/common.php'; ?>
               <script>
               function do_confirm(ids) {
                  Swal.fire({
                     title: "Are you sure?",
                     text: "You won't be able to revert this!",
                     icon: "warning",
                     showCancelButton: true,
                     confirmButtonColor: "#3085d6",
                     cancelButtonColor: "#d33",
                     confirmButtonText: "Yes, confirm it!"
                  }).then((result) => {
                     if (result.isConfirmed) {
                     $.ajax({
                        url: 'student/dashboard/dashboard_sql.php?pro=CONFIRM',
                        type: 'POST',
                        data: {ids:ids},
                        success: function(data) {
                           if(data == 'OK') {
                           Swal.fire({
                              title: "Confirmed!",
                              text: "Your data has been update.",
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
               <div class="row">
                  <div class="col">
                     <div class="card h-100">                        
                        <div class="card-body">
                        <?php
                           $rsp = $conn->query("SELECT * FROM student WHERE student_ID=".tosql($_SESSION["SESS_UID"]));
                        ?>
                           <div class="row">
                              <div class="col-02 col-md-6 col-xl-3 position-relative">
                                 <div class="card card-plain">
                                    <div class="card-body mx-auto">
                                       <div class="col-auto">
                                          <?php if(!empty($rsp->fields['pic'])) { ?>
                                          <img src="uploads/student/<?=$rsp->fields['pic']?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <hr class="vertical dark">
                              </div>
                              <div class="col-02 col-md-6 col-xl-9 position-relative">
                                 <div class="card card-plain h-100">
                                    <div class="card-header pb-0 p-3">
                                       <div class="row">
                                          <div class="col-auto my-auto">
                                             <div class="h-100">
                                                <h5 class="mb-2">
                                                   <?=$_SESSION['SESS_NAME'];?>
                                                </h5>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body p-3">
                                       <ul class="list-group">
                                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Matric No.:</strong> &nbsp; <?=$rsp->fields["student_ID"];?></li>
                                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Course:</strong> &nbsp; <?=$rsp->fields["course"];?></li>
                                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Class:</strong> &nbsp; <?=$rsp->fields["class"];?></li>
                                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?=$rsp->fields["email"];?></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mt-6">
                  <div class="col-6">
                     <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                           <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 float-start">
                              <i class="material-icons opacity-10">notifications</i>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <h6 class="mb-0">Notification</h6>
                              </div>
                              <div class="col-md-6 d-flex justify-content-end align-items-center">
                                 <small><?=DisplayDateE(now(),"ENG")?></small>
                              </div>
                           </div>
                        </div>
                        <div class="card-body p-3 pt-4">

                           <?php $noti = $conn->query("SELECT A.task_assign_ID, A.status, B.title, B.start_date, B.due_date, D.course_code, D.course_name
                           FROM `task_assign` A, `assessment` B, `student_course` C, `course` D
                           WHERE A.assessment_ID=B.assessment_ID AND A.student_course_ID=C.student_course_ID AND B.course_ID=D.course_ID
                           AND C.student_ID=".tosql($_SESSION["SESS_UID"])) ?>

                           <ul class="list-group list-group-flush" data-toggle="checklist">
                              <?php while (!$noti->EOF) { ?>
                              <li class="list-group-item border-0 flex-column align-items-start ps-0 py-0 mb-3">
                                 <div class="checklist-item checklist-item-info ps-2 ms-3">
                                    <div class="d-flex align-items-center">
                                       <h6 class="mb-0 text-dark text-sm"><?=$noti->fields['course_code']?> <?=$noti->fields['course_name']?> </h6>
                                    </div>
                                    <div class="d-flex align-items-center mt-3 ps-1">
                                       <div>
                                          <p class="mb-0 text-secondary">Date</p>
                                          <span class="text-xs"><?=DisplayDateE($noti->fields['start_date'],"ENG")?> - <?=DisplayDateE($noti->fields['due_date'],"ENG")?></span>
                                       </div>
                                       <div class="ms-auto">
                                          <p class="mb-0 text-secondary">Assessment</p>
                                          <span class="text-xs"><?=$noti->fields['title']?></span>
                                       </div>
                                       <div class="mx-auto">
                                          <?php if($noti->fields['status'] != 1) { ?>
                                          <span class="text-xs badge bg-gradient-info" onclick="do_confirm('<?=$noti->fields['task_assign_ID']?>')">Confirm?</span>
                                          <?php } else { ?>
                                          <span class="text-xs badge bg-gradient-success">Complete</span>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <hr class="horizontal dark mt-4 mb-0">
                              </li>
                              <?php $noti->movenext(); } ?>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="card h-100">
                        <div class="card-body p-3">
                           <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
                        </div>
                     </div>
                  </div>
                  <script>
                     
                  <?php $event = $conn->query("SELECT B.title, B.start_date, B.due_date 
                  FROM `task_assign` A, `assessment` B, `student_course` C 
                  WHERE A.assessment_ID=B.assessment_ID AND A.student_course_ID=C.student_course_ID 
                  AND C.student_ID=".tosql($_SESSION["SESS_UID"])) ?>

                  var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
                     contentHeight: 'auto',
                     initialView: "dayGridMonth",
                     headerToolbar: {
                        start: 'title', // will normally be on the left. if RTL, will be on the right
                        center: '',
                        end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
                     },
                     selectable: false,
                     editable: false,
                     events: [
                     <?php 
                        while(!$event->EOF) { 
                           print "{title: '".$event->fields['title']."', start: '".$event->fields['start_date']."', end: '".$event->fields['due_date']."', className: 'bg-gradient-warning'},"; 
                           $event->movenext();
                        } 
                     ?>
                     ],
                     views: {
                        month: {
                           titleFormat: {
                              month: "long",
                              year: "numeric"
                           }
                        }
                     },
                  });

                  calendar.render();
                  </script>
               </div>