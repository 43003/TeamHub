        <script src="assets/js/plugins/datatables.js"></script>
        <script>
        </script>

        <?php
        // $conn->debug=true;
        $cid=isset($_REQUEST["cid"])?$_REQUEST["cid"]:"";
        $sql="SELECT * FROM `student_course` A, `student` B WHERE A.`status`=0 AND A.`course_ID`=".tosql($cid);
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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-45">Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">Course <br>[Class]</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-10">Join Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while(!$rs->EOF){
                      ?>
                      <tr>
                        <td class="text-sm font-weight-normal">1</td>
                        <td class="text-sm font-weight-normal">Assignment 1</td>
                        <td class="text-sm font-weight-normal">Assignment</td>
                        <td class="text-sm font-weight-normal">
                          Start Date <br>
                          <b>[2011/04/25]</b> <br>
                          <br>
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
          fixedHeight: true,
          fixedColumns: false,
        });
        </script>