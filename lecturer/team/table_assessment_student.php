<?php include 'connection/common.php'; ?>
        <?php $aid=isset($_REQUEST["aid"])?$_REQUEST["aid"]:""; ?>
        <script src="assets/js/plugins/datatables.js"></script>
        <?php
        // $conn->debug=true;
        $sql="SELECT A.status, A.date_submit, C.student_name, C.student_ID 
        FROM `task_assign` A, `student_course` B, `student` C 
        WHERE A.student_course_ID=B.student_course_ID AND B.student_ID=C.student_ID AND `assessment_ID`=".tosql($aid);
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
                      [<?=dlookup("assessment","title"," assessment_ID=".tosql($aid))?>]
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
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-40">Student Name</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-30">Matric No</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10">Status</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10">Date Submit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bil=0;
                      while(!$rs->EOF){
                      ?>
                      <tr>
                        <td class="text-sm text-center font-weight-normal"><?=++$bil?></td>
                        <td class="text-sm font-weight-normal"><?=$rs->fields['student_name']?></td>
                        <td class="text-sm font-weight-normal"><?=$rs->fields['student_ID']?></td>
                        <td class="text-sm font-weight-normal">
                          <?php if($rs->fields['status'] == 1) { ?>
                          <span class="badge bg-gradient-success">Submited</span>
                          <?php } else { ?>
                          <span class="badge bg-gradient-secondary">Not Yet Submit</span>
                          <?php } ?>
                        </td>
                        <td class="text-sm font-weight-normal">
                        <?=$rs->fields['date_submit']??'-'?>
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
          paging: true,
        });
        </script>