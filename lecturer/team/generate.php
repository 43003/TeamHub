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
                      List of Assessment 
                      [<?=dlookup("course","course_code"," course_ID=".tosql($cid))?> - <?=dlookup("course","course_name"," course_ID=".tosql($cid))?>]
                    </h6>
                  </div>
                  <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"  data-bs-toggle="modal" data-bs-target="#myModalLg" onclick="do_form('')">
                      <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Assessment
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <div class="table-responsive">
                  <table class="table" id="datatable-basic">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-35">Title</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-15">Type</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-15">Document</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">Date</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-10">Action</th>
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
                        <td class="text-sm font-weight-normal">sdasdasdassd</td>
                        <td class="text-sm font-weight-normal">
                          Start Date <br>
                          <b>[2011/04/25]</b> <br>
                          <br>
                          End Date <br>
                          <b>[2011/04/25]</b> <br>
                        </td>
                        <td class="text-sm font-weight-normal">                        
                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#myModalLg" onclick="do_form('<?=$rs->fields['course_ID']?>')">
                            <i class="material-icons text-sm me-2">edit</i>Edit
                          </a>
                          <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;" onclick="do_delete('<?=$rs->fields['course_ID']?>')">
                            <i class="material-icons text-sm me-2">delete</i>Delete
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
        </script>