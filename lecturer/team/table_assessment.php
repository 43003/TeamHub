<?php include 'connection/common.php'; ?>
        <?php $cid=isset($_REQUEST["cid"])?$_REQUEST["cid"]:""; ?>
        <script src="assets/js/plugins/datatables.js"></script>
        <?php
        // $conn->debug=true;
        $sql="SELECT * FROM `assessment` WHERE `is_deleted`=0 AND `course_ID`=".tosql($cid);
        $rs=$conn->query($sql);
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">
                      List of Assessment 
                      [<?=dlookup("course","course_code"," course_ID=".tosql($cid))?> - <?=dlookup("course","course_name"," course_ID=".tosql($cid))?>]
                    </h6>
                  </div>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <div class="table-responsive">
                  <input type="hidden" name="ids" id="ids" value="<?=$cid?>">
                  <table class="table" id="datatable-basic">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7 w-10">No</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-50">Assessment Name</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-20">Status</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10">Date</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bil=0;
                      while(!$rs->EOF){
                      ?>
                      <tr>
                        <td class="text-sm text-center font-weight-normal"><?=++$bil?></td>
                        <td class="text-sm font-weight-normal"><?=$rs->fields['title']?></td>
                        <td class="text-sm font-weight-normal">
                          <?php
                          // $conn->debug=true;
                          $totalStud = dlookup_cnt("task_assign", "student_course_ID", "assessment_ID=".tosql($rs->fields['assessment_ID']));
                          $cntStud = dlookup_cnt("task_assign", "status", "assessment_ID=".tosql($rs->fields['assessment_ID'])." AND status='1'");

                          ?>
                          <div class="progress-wrapper">
                            <div class="progress-info">
                              <div class="progress-percentage">
                                <span class="text-sm font-weight-normal"><?=($cntStud/$totalStud)*100?>%</span>
                              </div>
                            </div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="<?=($cntStud/$totalStud)*100?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=($cntStud/$totalStud)*100?>%;"></div>
                            </div>
                          </div>
                        </td>
                        <td class="text-sm font-weight-normal">
                          Start Date <br>
                          <b><?=$rs->fields['start_date']?></b> <br>
                          <br>
                          End Date <br>
                          <b><?=$rs->fields['due_date']?></b> <br>
                        </td>
                        <td class="text-sm font-weight-normal">
                          <a class="btn btn-link text-info px-3 mb-0" href="index.php?data=<?php print base64_encode($dir.'/team/table_assessment_student.php;Teams;Assessments Student List;;;;'); ?>&aid=<?=$rs->fields['assessment_ID']?>">
                            <i class="material-icons text-sm me-2">visibility</i>Show Student
                          </a>
                        </td>
                      </tr>
                      <?php
                        $rs->movenext();
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
          perPageSelect: false,
          sortable: false,
          searchable: false,
          fixedHeight: false,
          fixedColumns: false,
          paging: false,
        });
        </script>