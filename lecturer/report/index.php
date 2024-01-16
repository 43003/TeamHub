               <?php include 'connection/common.php'; ?>
               <script src="assets/js/plugins/datatables.js"></script>
               <div class="row mt-4">
                  <div class="col-12">
                     <div class="card z-index-2 mt-4">
                        <div class="card-header p-3 pt-2">
                           <div class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 me-3 float-start">
                              <i class="material-icons opacity-10">summarize</i>
                           </div>
                           <h6 class="mb-0">Student Report</h6>
                           <p class="mb-0 text-sm">Total Student Change Team / Total Team Disband</p>
                        </div>
                        <div class="card-body p-3 pt-0">
                           <div class="chart">
                              <canvas id="student_bar_chart" class="chart-canvas" height="300"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <script src="assets/js/plugins/chartjs.min.js"></script>
               <script>
               // Bar chart horizontal
               var student_bar_chart = document.getElementById("student_bar_chart").getContext("2d");
               <?php
               $rsC = $conn->query('SELECT * FROM `course` WHERE `lecturer_ID`='.tosql($_SESSION['SESS_UID']));
               
               $tsc='';
               $ttd='';
               $course_name='';
               $bil=0;
               while (!$rsC->EOF) {

                  $rsSC = $conn->query("SELECT A.`student_ID` FROM `history` A, `team` B WHERE A.team_ID=B.team_ID AND B.course_ID=".tosql($rsC->fields['course_ID']));
                  $rsTD = $conn->query("SELECT `team_ID` FROM `team` WHERE `course_ID`=".tosql($rsC->fields['course_ID'])." AND `team_status`='1'");

                  if ($bil > 0) {
                     $tsc .= "','".$rsSC->recordcount();
                     $ttd .= "','".$rsTD->recordcount();
                     $course_name .= "','".$rsC->fields['course_code']." ".$rsC->fields['course_name'];
                  } else {
                     $tsc .= $rsSC->recordcount();
                     $ttd .= $rsTD->recordcount();
                     $course_name .= $rsC->fields['course_code']." ".$rsC->fields['course_name'];

                  }
                  $bil++;
                  $rsC->movenext();
               }
               ?>
               new Chart(student_bar_chart, {
                  type: "bar",
                  data: {
                     labels: ['<?=$course_name?>'],
                     datasets: [
                        {
                           label: "Total Student Change",
                           weight: 5,
                           borderWidth: 0,
                           borderRadius: 4,
                           backgroundColor: '#00A9FF',
                           data: ['<?=$tsc?>'],
                           fill: false
                        },
                        {
                           label: "Total Team Disband",
                           weight: 5,
                           borderWidth: 0,
                           borderRadius: 4,
                           backgroundColor: '#FFD95A',
                           data: ['<?=$ttd?>'],
                           fill: false
                        },
                     ],
                  },
                  options: {
                     indexAxis: 'y',
                     responsive: true,
                     maintainAspectRatio: false,
                     plugins: {
                        legend: {
                           position: 'top',
                        }
                     },
                     scales: {
                        y: {
                           grid: {
                              drawBorder: false,
                              display: true,
                              drawOnChartArea: true,
                              drawTicks: false,
                              borderDash: [5, 5],
                              color: '#c1c4ce5c'
                           },
                           ticks: {
                              display: true,
                              padding: 10,
                              color: '#9ca2b7',
                              font: {
                                 size: 14,
                                 weight: 300,
                                 family: "Roboto",
                                 style: 'normal',
                                 lineHeight: 2
                              },
                           }
                        },
                        x: {
                           grid: {
                              drawBorder: false,
                              display: false,
                              drawOnChartArea: true,
                              drawTicks: true,
                              color: '#c1c4ce5c'
                           },
                           ticks: {
                              display: true,
                              color: '#9ca2b7',
                              padding: 10,
                              font: {
                                 size: 14,
                                 weight: 300,
                                 family: "Roboto",
                                 style: 'normal',
                                 lineHeight: 2
                              },
                           }
                        },
                     },
                  },
               });
               </script>
               