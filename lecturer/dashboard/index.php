               <?php include 'connection/common.php'; ?>
               <script src="assets/js/plugins/datatables.js"></script>
               <div class="row">
                  <div class="col">
                     <div class="card h-100">                        
                        <div class="card-body">
                           <div class="row">
                              <div class="col-12 col-md-6 col-xl-3 position-relative">
                                 <div class="card card-plain">
                                    <div class="card-body mx-auto">
                                       
                                    </div>
                                 </div>
                                 <hr class="vertical dark">
                              </div>
                              <div class="col-12 col-md-6 col-xl-9 position-relative">
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
                                          $rsp = $conn->query("SELECT * FROM lecturer WHERE lecturer_ID=".tosql($_SESSION["SESS_UID"]));
                                       ?>
                                       <h6 class="mb-2">Description</h6>
                                       <p class="text-sm">
                                          <?=$rsp->fields["description"];?>
                                       </p>
                                       <ul class="list-group">
                                          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?=$rsp->fields["lecturer_name"];?></li>
                                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Phone:</strong> &nbsp; <?=$rsp->fields["mobile_phone"];?> (Mobile) | <?=$rsp->fields["office_phone"];?> (Office)</li>
                                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?=$rsp->fields["email"];?></li>
                                       <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Office Location:</strong> &nbsp; <?=$rsp->fields["office_location"];?></li>
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
                     <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                           <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 me-3 float-start">
                              <i class="material-icons opacity-10">groups</i>
                           </div>
                           <div class="d-block d-md-flex">
                              <div class="me-auto">
                                 <h6 class="mb-0">Students</h6>
                                 <p class="mb-0 text-sm">Total Student by Course</p>
                              </div>
                           </div>
                        </div>
                        <div class="card-body pb-0 p-3 mt-4">
                           <div class="row">
                              <div class="col-md-3 text-start">
                                 <div class="chart">
                                    <canvas id="student_chart" class="chart-canvas" height="200"></canvas>
                                 </div>
                              </div>
                              <div class="col-md-1 my-auto">
                                 <?php 
                                 $sqlC = "SELECT * FROM course WHERE is_deleted='0' AND course_status='0' AND lecturer_ID=".tosql($_SESSION['SESS_UID']);
                                 $rsC = $conn->query($sqlC);
                                 $colours = ['#17c1e8', '#e91e63', '#3A416F', '#a8b8d8'];
                                 $bil=0;
                                 while(!$rsC->EOF){
                                 ?>
                                 <span class="badge badge-md badge-dot me-4 d-block text-start">
                                    <i style="background-color: <?=$colours[$bil];?>"></i>
                                    <span class="text-dark text-xs"><?=$rsC->fields['course_code']?></span>
                                 </span>
                                 <?php
                                    $bil++;
                                    $rsC->movenext();
                                 }
                                 ?>
                              </div>
                              <div class="col-md-8 my-auto">
                                 <div class="table-responsive">
                                    <table class="table" id="dt_chart">
                                       <thead class="thead-light">
                                          <tr>
                                             <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 w-65">Course</th>
                                             <th class="text-uppercase text-secondary text-sm text-center font-weight-bolder opacity-7 w-35">Total Students</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       <?php 
                                          $sqlCN = "SELECT * FROM course WHERE is_deleted='0' AND course_status='0' AND lecturer_ID=".tosql($_SESSION['SESS_UID']);
                                          $rsCN = $conn->query($sqlCN);
                                          $bil=0;
                                          while(!$rsCN->EOF){
                                             $sqlST = "SELECT COUNT(*) AS total_student FROM student_course WHERE course_ID=".tosql($rsCN->fields['course_ID']);
                                             $rsST = $conn->query($sqlST);
                                          ?>
                                          <tr>
                                             <td>
                                                <h6 class="text-sm font-weight-normal mb-0 "><?=$rsCN->fields['course_code']?> - <?=$rsCN->fields['course_name']?></h6>
                                             </td>
                                             <td class="w-30">
                                                <div class="text-center">
                                                   <h6 class="text-sm font-weight-normal mb-0 "><?=$rsST->fields['total_student']?></h6>
                                                </div>
                                             </td>
                                          </tr>
                                          <?php
                                             $bil++;
                                             $rsCN->movenext();
                                          }
                                          ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
                     <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                           <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 me-3 float-start">
                              <i class="material-icons opacity-10">analytics</i>
                           </div>
                           <div class="d-block d-md-flex">
                              <div class="me-auto">
                                 <h6 class="mb-0">Assessment</h6>
                                 <p class="mb-0 text-sm">Submit / Unsubmited Assessment</p>
                              </div>
                           </div>
                        </div>
                        <div class="card-body p-3">
                           <div class="chart">
                              <canvas id="chart-line" class="chart-canvas" height="350"></canvas>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  <script src="assets/js/plugins/chartjs.min.js"></script>
                  <script>
                  const dt_chart = new simpleDatatables.DataTable("#dt_chart", {
                     perPageSelect: false,
                     sortable: false,
                     searchable: false,
                     fixedHeight: false,
                     fixedColumns: false,
                     paging: false,
                  });
                  var chart_student = document.getElementById("student_chart").getContext("2d");
                  
                  <?php                  
                  $sqlDC = "SELECT * FROM course WHERE is_deleted='0' AND course_status='0' AND lecturer_ID=".tosql($_SESSION['SESS_UID']);
                  $rsDC = $conn->query($sqlDC);
                  // $conn->debug=true;
                  $data_course="";
                  $data_student="";
                  $bills=0;
                  while (!$rsDC->EOF) {
                     $sqlDS = "SELECT COUNT(*) AS total_student FROM student_course WHERE course_ID=".tosql($rsDC->fields['course_ID']);
                     $rsDS = $conn->query($sqlDS);
                     
                     if($bills > 0){
                        $data_course.="','".$rsDC->fields['course_code'];
                        $data_student.="','".$rsDS->fields['total_student'];
                     } else {
                        $data_course.=$rsDC->fields['course_code'];
                        $data_student.=$rsDS->fields['total_student'];
                     }
                     $bills++;
                     $rsDC->movenext();
                  }
                  ?>
                  // Pie chart
                  new Chart(chart_student, {
                     type: "pie",
                     data: {
                        labels: ['<?=$data_course?>'],
                        datasets: [{
                           label: "Total Student by Course",
                           weight: 9,
                           cutout: 0,
                           tension: 1,
                           pointRadius: 23,
                           borderWidth: 1,
                           backgroundColor: ['#17c1e8', '#e91e63', '#3A416F', '#a8b8d8'],
                           data: ['<?=$data_student?>'],
                           fill: true
                        }],
                     },
                     options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                           legend: {
                              display: false,
                           }
                        },
                        interaction: {
                           intersect: false,
                           mode: 'index',
                        },
                        scales: {
                           y: {
                                 grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    color: '#c1c4ce5c'
                                 },
                                 ticks: {
                                    display: false
                                 }
                           },
                           x: {
                              grid: {
                                 drawBorder: false,
                                 display: false,
                                 drawOnChartArea: false,
                                 drawTicks: false,
                                 color: '#c1c4ce5c'
                              },
                              ticks: {
                                 display: false,
                              }
                           },
                        },
                     },
                  });
                  </script>
               </div>