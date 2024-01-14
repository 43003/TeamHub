        <?php include 'connection/common.php'; ?>
        <script src="assets/js/plugins/datatables.js"></script>
        <script>
        function do_disband(ids,team) {
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, do it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'lecturer/team/team_sql.php?pro=DISBAND',
                type: 'POST',
                data: {ids:ids, team:team},
                success: function(data) {
                  if(data == 'OK') {
                    Swal.fire({
                      title: "Success!",
                      text: "This team has been disband.",
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
          });
        }

        function do_leader(ids,student,team) {
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, do it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'lecturer/team/team_sql.php?pro=LEADER',
                type: 'POST',
                data: {ids:ids, student:student, team:team},
                success: function(data) {
                  if(data == 'OK') {
                    Swal.fire({
                      title: "Success!",
                      text: "This student has become a leader for the team.",
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
          });                    
        }
        </script>
        <?php
        // $conn->debug=true;
        $cid=isset($_REQUEST["cid"])?$_REQUEST["cid"]:"";

        // Student in team
        $sqlTeam="SELECT * FROM `team` WHERE `course_ID`=".tosql($cid)." AND `team_status`=0";
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
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <div class="row">
                  <table class="table" id="dt_team">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7 w-100" colspan="4">Student In Team</th>
                      </tr>
                      <tr>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-15"></th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-35">Matric No</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-50">Student Name</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-50">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bil=0;
                      while(!$rsTeam->EOF){
                      ?>
                      <tr>
                        <td class="text-sm font-weight-normal text-center" rowspan="<?=dlookup_cnt("student_course","team_ID","team_ID=".tosql($rsTeam->fields["team_ID"])." AND status <> 2")?>">
                          <?=$rsTeam->fields["team_name"]?> <br><br>
                          <a class="btn bg-gradient-danger mb-0" href="javascript:;" onclick="do_disband('<?=$cid?>','<?=$rsTeam->fields['team_ID']?>')">
                            <i class="material-icons text-sm">delete</i>&nbsp;&nbsp;Disband Team
                          </a>
                        </td>
                        <?php
                        $rsST = $conn->query("SELECT * FROM `student_course` WHERE `team_ID`=".tosql($rsTeam->fields["team_ID"])." AND status <> 2");
                        $bil=0;
                        while (!$rsST->EOF) {
                          if ($bil==0) {
                        ?>
                        <td class="text-sm font-weight-normal"><?=$rsST->fields["student_ID"]?></td>
                        <td class="text-sm font-weight-normal">
                          <?=dlookup("student","student_name","student_ID=".tosql($rsST->fields["student_ID"]))?>
                          <?php if ($rsST->fields["is_leader"]=="Y") { ?>
                          &nbsp<span class="badge bg-gradient-success">Leader</span>
                          <?php } ?>
                        </td>
                        <td class="text-sm font-weight-normal">
                          <?php if (empty($rsST->fields["is_leader"])) { ?>
                          <a class="btn bg-gradient-info mb-0" href="javascript:;" onclick="do_leader('<?=$cid?>','<?=$rsST->fields['student_ID']?>','<?=$rsTeam->fields['team_ID']?>')">
                            <i class="material-icons text-sm">assignment_ind</i>&nbsp;&nbsp;Make As Leader
                          </a>
                          <?php } ?>
                        </td>
                      </tr>
                        <?php
                          } else {
                        ?>
                      <tr>
                        <td class="text-sm font-weight-normal"><?=$rsST->fields["student_ID"]?></td>
                        <td class="text-sm font-weight-normal">
                          <?=dlookup("student","student_name","student_ID=".tosql($rsST->fields["student_ID"]))?>
                          <?php if ($rsST->fields["is_leader"]=="Y") { ?>
                          &nbsp<span class="badge bg-gradient-success">Leader</span>
                          <?php } ?>
                        </td>
                        <td class="text-sm font-weight-normal">
                          <?php if (empty($rsST->fields["is_leader"])) { ?>
                          <a class="btn bg-gradient-info mb-0" href="javascript:;" onclick="do_leader('<?=$cid?>','<?=$rsST->fields['student_ID']?>','<?=$rsTeam->fields['team_ID']?>')">
                            <i class="material-icons text-sm">assignment_ind</i>&nbsp;&nbsp;Make As Leader
                          </a>
                          <?php } ?>
                        </td>
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
        const dt_team = new simpleDatatables.DataTable("#dt_team", {
          perPageSelect: false,
          sortable: false,
          searchable: false,
          fixedHeight: false,
          fixedColumns: false,
          paging: false,
        });
        </script>