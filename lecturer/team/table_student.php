        <?php include 'connection/common.php'; ?>
        <?php $cid=isset($_REQUEST["cid"])?$_REQUEST["cid"]:""; ?>
        <script src="assets/js/plugins/datatables.js"></script>
        <script>
        function do_create(ids){
          if ($("#student:checked").length == 0) {
            Swal.fire({
              title: "Warning!",
              text: "Please tick atleast one student!",
              icon: "warning"
            });
          } else {
            var ids = $("#ids").val();

            var fd = new FormData();
            
            fd.append('ids',ids)
            $("#student:checked").each(function(){
              fd.append(this.name,this.value);
            });

            console.log(fd);

            $.ajax({
              url: 'lecturer/team/team_sql.php?pro=NEW',
              type: 'POST',
              data: fd,
              contentType: false,
              cache: false,
              processData:false,
              success: function(data) {
                if(data == 'OK') {
                  Swal.fire({
                    title: "Good Job!",
                    text: "Team have been created.",
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
        }
        
        function do_generate(ids) {
          Swal.fire({
            title: "Number of members",
            html: `
              <div class="input-group input-group-outline my-3">
                <input id="no_member" name="no_member" type="text" class="form-control">
              </div>
            `,
            preConfirm: async () => {
              return document.getElementById("no_member").value
            },
            showCancelButton: true,
            confirmButtonText: "Generate",
          }).then((result) => {
            $.ajax({
              url: 'lecturer/team/team_sql.php?pro=GENERATE',
              type: 'POST',
              data: {ids:ids, no_member: result.value},
              success: function(data) {
                if(data == 'OK') {
                  Swal.fire({
                    title: "Good Job!",
                    text: "Team have been created.",
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
          });
        }

        
        function do_join(ids,student){
          <?php $rsTeam = $conn->query("SELECT * FROM `team` WHERE `course_ID`=".tosql($cid)." AND `team_status`=0"); ?>
          Swal.fire({
            title: "Select Team",
            input: "select",
            inputOptions: {
              <?php while (!$rsTeam->EOF) { ?>
              <?=$rsTeam->fields['team_ID']?> : "<?=$rsTeam->fields['team_name']?>",
              <?php $rsTeam->movenext(); } ?>
            },
            inputPlaceholder: "Select a team",
            showCancelButton: true,
            confirmButtonText: "Join Team",
          }).then((result) => {
            $.ajax({
              url: 'lecturer/team/team_sql.php?pro=JOIN',
              type: 'POST',
              data: {ids:ids, student: student, team: result.value},
              success: function(data) {
                if(data == 'OK') {
                  Swal.fire({
                    title: "Good job!",
                    text: "Student successfully join the team!",
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
          });
        }
        </script>

        <?php
        // $conn->debug=true;
        $sql="SELECT * FROM `student_course` A, `student` B WHERE A.`student_ID`=B.`student_ID` AND A.`course_ID`=".tosql($cid);
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
                  <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="javascript:;" onclick="do_create('<?=$cid?>')">
                      <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Create Team
                    </a>
                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"  onclick="do_generate('<?=$rs->fields['course_ID']?>')">
                      <i class="material-icons text-sm">autorenew</i>&nbsp;&nbsp;Generate Team
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <div class="table-responsive">
                  <input type="hidden" name="ids" id="ids" value="<?=$cid?>">
                  <table class="table" id="datatable-basic">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7 w-5"></th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-15">Name</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10">Matric No</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10">Course [Class]</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10">Join Date</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bil=0;
                      while(!$rs->EOF){
                      ?>
                      <tr>
                        <td class="text-sm font-weight-normal">
                          <?php if (empty($rs->fields['team_ID'])) { ?>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="student[]" id="student" value="<?=$rs->fields["student_ID"]?>">
                          </div>
                          <?php } ?>
                        </td>
                        <td class="text-sm font-weight-normal">
                          <?php if ($rs->fields['status'] == 0) { ?>
                          <span class="badge bg-gradient-success">New</span>&nbsp; 
                          <?php } else if ($rs->fields['status'] == 2) { ?>
                          <span class="badge bg-gradient-danger">Drop</span>&nbsp; 
                          <?php } ?>
                          <?=$rs->fields["student_name"]?>
                        </td>
                        <td class="text-sm font-weight-normal"><?=$rs->fields["student_ID"]?></td>
                        <td class="text-sm font-weight-normal"><?=$rs->fields["course"]?> [<?=$rs->fields["class"]?>]</td>
                        <td class="text-sm font-weight-normal">
                          <b><?=DisplayDate($rs->fields["join_date"])?></b>
                        </td>
                        <td class="text-sm font-weight-normal">
                          <?php if ($rs->fields['status'] != 2 && empty($rs->fields['team_ID']) && dlookup_cnt("team","team_ID","course_ID=".tosql($cid)) > 0) { ?>
                          <a class="btn bg-gradient-dark mb-0" href="javascript:;" onclick="do_join('<?=$cid?>','<?=$rs->fields['student_ID']?>')">
                            <i class="material-icons text-sm">input</i>&nbsp;&nbsp;Join Team
                          </a>
                          <?php } ?>
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

        $.ajax({
          url: 'lecturer/team/team_sql.php?pro=STATUS',
          type: 'POST',
          data: {ids:<?=$cid?>},
          success: function(data) {
            console.log(data);
          }
        });
        </script>