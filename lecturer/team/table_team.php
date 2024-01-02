        <?php include 'connection/common.php'; ?>
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

        function do_join(ids,student){
          $('#myModal .modal-content').load('lecturer/team/form_team.php?ids='+ids+'&student='+student);
        }
        </script>
        <?php
        // $conn->debug=true;
        $cid=isset($_REQUEST["cid"])?$_REQUEST["cid"]:"";
        
        // Student not in team
        $sqlStudent="SELECT * FROM `student_course` WHERE `team_ID` IS NULL AND `status`<>2 AND `course_ID`=".tosql($cid);
        $rsStudent=$conn->query($sqlStudent);
        $countStudent = $rsStudent->recordcount();

        // Student in team
        $sqlTeam="SELECT * FROM `team` WHERE `course_ID`=".tosql($cid);
        $rsTeam=$conn->query($sqlTeam);
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">
                      List of Teams 
                      [<?=dlookup("course","course_code"," course_ID=".tosql($cid))?> - <?=dlookup("course","course_name"," course_ID=".tosql($cid))?>]
                    </h6>
                  </div>
                  <?php if ($countStudent > 0) { ?>
                  <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="javascript:;" onclick="do_create('<?=$cid?>')">
                      <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Create Team
                    </a>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <div class="row">
                  <input type="hidden" name="ids" id="ids" value="<?=$cid?>">
                  <table class="table" id="dt_student">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7 w-100" colspan="4">Student Not In Team</th>
                      </tr>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-15"></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-25">Matric No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-40">Student Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bil=0;
                      while(!$rsStudent->EOF){
                      ?>
                      <tr>
                        <td class="text-sm font-weight-normal">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="student[]" id="student" value="<?=$rsStudent->fields["student_ID"]?>">
                          </div>
                        </td>
                        <td class="text-sm font-weight-normal"><?=$rsStudent->fields["student_ID"]?></td>
                        <td class="text-sm font-weight-normal"><?=dlookup("student","student_name","student_ID=".tosql($rsStudent->fields["student_ID"]))?></td>
                        <td class="text-sm font-weight-normal">
                          <a class="btn bg-gradient-dark mb-0" href="javascript:;"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="do_join('<?=$cid?>','<?=$rsStudent->fields['student_ID']?>')">
                            <i class="material-icons text-sm">input</i>&nbsp;&nbsp;Join Team
                          </a>
                        </td>
                      </tr>
                      <?php
                        $rsStudent->movenext();
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="row">
                  <table class="table" id="dt_team">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7 w-100" colspan="3">Student In Team</th>
                      </tr>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-15"></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-35">Matric No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-50">Student Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bil=0;
                      while(!$rsTeam->EOF){
                      ?>
                      <tr>
                        <td class="text-sm font-weight-normal" rowspan="<?=dlookup_cnt("student_course","team_ID","team_ID=".tosql($rsTeam->fields["team_ID"]))?>"><?=$rsTeam->fields["team_name"]?></td>
                        <?php
                        $rsST = $conn->query("SELECT * FROM `student_course` WHERE `team_ID`=".tosql($rsTeam->fields["team_ID"]));
                        $bil=0;
                        while (!$rsST->EOF) {
                          if ($bil==0) {
                        ?>
                        <td class="text-sm font-weight-normal"><?=$rsST->fields["student_ID"]?></td>
                        <td class="text-sm font-weight-normal"><?=dlookup("student","student_name","student_ID=".tosql($rsST->fields["student_ID"]))?></td>
                      </tr>
                        <?php
                          } else {
                        ?>
                      <tr>
                        <td class="text-sm font-weight-normal"><?=$rsST->fields["student_ID"]?></td>
                        <td class="text-sm font-weight-normal"><?=dlookup("student","student_name","student_ID=".tosql($rsST->fields["student_ID"]))?></td>
                        <?php
                          }
                          $bil++;
                          $rsST->movenext();
                        }
                        ?>
                      </tr>
                      <?php
                        $rsTeam->movenext();
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
        const dt_student = new simpleDatatables.DataTable("#dt_student", {
          perPageSelect: false,
          sortable: false,
          searchable: false,
          fixedHeight: false,
          fixedColumns: false,
          paging: false,
        });

        const dt_team = new simpleDatatables.DataTable("#dt_team", {
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