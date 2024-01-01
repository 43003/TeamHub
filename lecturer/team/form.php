      <?php include '../../connection/common.php'; ?>
      <script>
      function do_type(type){
        if (type=='A'){
          $(".member").css("display","block");
        } else if (type=='M') {
          $(".member").css("display","none");
        }
      }

      function do_save(){

      }
      </script>
      <?php
      $ids=isset($_GET["ids"])?$_GET["ids"]:"";
      // $conn->debug=true;
      $sql="SELECT * FROM student_course WHERE course_ID=".tosql($ids)." AND status<>2";
      $rs = $conn->query($sql);
      ?>
      <div class="modal-header">
        <label class="modal-title fs-5">Team Detail</label>
      </div>
      <div class="modal-body">
        <input type="hidden" name="ids" id="ids" value="<?=$ids?>">
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Type: </label>
            </div>
          </div>
          <div class="col-md">
            <div class="input-group input-group-outline my-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="type_A" value="A" onchange="do_type('A')">
                <label class="custom-control-label" for="type_A">Automatic</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="type_M" value="M" onchange="do_type('M')">
                <label class="custom-control-label" for="type_M">Manual</label>
              </div>
            </div>
          </div>
        </div>
        <div class="member" style="display: none;">
          <div class="row">
            <div class="col-md-2">
              <div class="input-group input-group-inline my-3">
                <label class="form-label">Number of Member: </label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="input-group input-group-outline my-3">
                <input id="no_member" name="no_member" type="text" class="form-control no_member">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-dark btn-submit" onclick="do_save()">Generate</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      <script>
      $('.no_member').mask('0');
      </script>