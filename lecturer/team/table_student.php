        <?php include 'connection/common.php'; ?>
        <script src="assets/js/plugins/datatables.js"></script>
        <script>
        function do_generate(ids) {
          $('#myModalLg .modal-content').load('lecturer/team/form_student.php?ids='+ids)
        }
        </script>

        <?php
        // $conn->debug=true;
        $cid=isset($_REQUEST["cid"])?$_REQUEST["cid"]:"";
        $sql="SELECT * FROM `student_course` A, `student` B WHERE A.`student_ID`=B.`student_ID` AND A.`status`<>2 AND A.`course_ID`=".tosql($cid);
        $rs=$conn->query($sql);
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">
                      List of Student 
                      [<?=dlookup("course","course_code"," course_ID=".tosql($cid))?> - <?=dlookup("course","course_name"," course_ID=".tosql($cid))?>]
                    </h6>
                  </div>
                  <?php 
                  $countTeam = dlookup_cnt("student_course", "team_ID","team_ID IS NOT NULL");
                  if ($countTeam == 0) { 
                  ?>
                  <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"  data-bs-toggle="modal" data-bs-target="#myModalLg" onclick="do_generate('<?=$rs->fields['course_ID']?>')">
                      <i class="material-icons text-sm">autorenew</i>&nbsp;&nbsp;Generate Team
                    </a>
                  </div>
                  <?php 
                  } 
                  ?>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <div class="table-responsive">
                  <table class="table" id="datatable-basic">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-35">Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">Matric No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-10">Course <br>[Class]</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-10">Join Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bil=0;
                      while(!$rs->EOF){
                      ?>
                      <tr>
                        <td class="text-sm font-weight-normal"><?=++$bil?></td>
                        <td class="text-sm font-weight-normal">
                          <?php if ($rs->fields['status'] == 0) { ?>
                          <span class="badge bg-gradient-success">New</span>&nbsp; 
                          <?php } ?>
                          <?=$rs->fields["student_name"]?>
                        </td>
                        <td class="text-sm font-weight-normal"><?=$rs->fields["student_ID"]?></td>
                        <td class="text-sm font-weight-normal"><?=$rs->fields["course"]?> <br>[<?=$rs->fields["class"]?>]</td>
                        <td class="text-sm font-weight-normal">
                          <b><?=DisplayDate($rs->fields["join_date"])?></b>
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
        });

        $.ajax({
          url: 'lecturer/team/team_sql.php?pro=STATUS',
          type: 'POST',
          data: {ids:<?=$cid?>},
          success: function(data) {
            console.log(data);
          }
        });
        </script>