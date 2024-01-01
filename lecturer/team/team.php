        <script src="assets/js/plugins/datatables.js"></script>
        <?php
        // $conn->debug=true;
        $cid=isset($_REQUEST["cid"])?$_REQUEST["cid"]:"";
        $sql="SELECT * FROM `student_course` A, `team` B WHERE A.`team_ID`=B.`team_ID` AND A.`status`<>2 AND A.`course_ID`=".tosql($cid);
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
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <div class="table-responsive">
                  <table class="table" id="datatable-basic">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-15">Group Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-35">Matric No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-50">Student Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- <?php
                      $bil=0;
                      while(!$rs->EOF){
                      ?>
                      <tr>
                        <td class="text-sm font-weight-normal" rowspan="3"></td>
                        <td class="text-sm font-weight-normal">
                          <?php if ($rs->fields['status'] == 0) { ?>
                          <span class="badge bg-gradient-success">New</span>&nbsp; 
                          <?php } ?>
                          <?=$rs->fields["student_name"]?>
                        </td>
                        <td class="text-sm font-weight-normal"><?=$rs->fields["course"]?> <br>[<?=$rs->fields["class"]?>]</td>
                        <td class="text-sm font-weight-normal">
                          <b><?=DisplayDate($rs->fields["join_date"])?></b>
                        </td>
                      </tr>
                      <?php
                        $rs->movenext();
                      }
                      ?> -->
                      <tr>
                        <td rowspan="4">Group A</td>
                        <td>B032020014</td>
                        <td>Eidlan</td>
                      </tr>
                      <tr>
                        <td>D032110082</td>
                        <td>Auni</td>
                      </tr>
                      <tr>
                        <td>B032020014</td>
                        <td>Khairul</td>
                      </tr>
                      <tr>
                        <td>D032110082</td>
                        <td>Nur</td>
                      </tr>
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