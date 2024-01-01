               <?php include 'connection/common.php'; ?>
               <div class="row">
                  <div class="col">
                     <div class="card h-100">                        
                        <div class="card-body">
                           <div class="row">
                              <div class="col-02 col-md-6 col-xl-3 position-relative">
                                 <div class="card card-plain">
                                    <div class="card-body mx-auto">
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
                                       <?php
                                          $rsp = $conn->query("SELECT * FROM student WHERE student_ID=".tosql($_SESSION["SESS_UID"]));
                                       ?>
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
                  <div class="col">
                     <div class="card card-calendar">
                        <div class="card-body p-3">
                           <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
                        </div>
                     </div>
                  </div>
                  <script>
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
                     events: [{
                        title: 'Call with Dave',
                        start: '2024-01-18',
                        end: '2024-01-18',
                        className: 'bg-gradient-danger'
                     },
                     {
                        title: 'Lunch meeting',
                        start: '2024-01-21',
                        end: '2024-01-22',
                        className: 'bg-gradient-warning'
                     },
                     {
                        title: 'All day conference',
                        start: '2024-01-29',
                        end: '2024-01-29',
                        className: 'bg-gradient-success'
                     },],
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