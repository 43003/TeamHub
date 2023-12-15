        <script src="assets/js/plugins/datatables.js"></script>
        <script>
        function do_form(ids){
          $('#myModalLg .modal-content').load('lecturer/assessment/form.php?ids='+ids)
        }

        function do_delete(ids){
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'lecturer/assessment/assessment_sql.php?pro=DEL',
                type: 'POST',
                beforeSend: function () {
                  // $('.btn-submit').prop("disabled",true);
                },
                data: {ids:ids},
                success: function(data) {
                  if(data == 'OK') {
                    Swal.fire({
                      title: "Deleted!",
                      text: "Your data has been deleted.",
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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Document</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                      </tr>
                    </thead>
                    <tbody>
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
                      <td class="text-sm font-weight-normal"></td>
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
          fixedHeight: true,
        });
        </script>