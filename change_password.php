      <?php include 'connection/common.php'; ?>
      <script>
      function StrengthChecker(password){
        // We then change the badge's color and text based on the password strength
        var strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
        var mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))');

        if(strongPassword.test(password)) {
          $('.progress-bar').css('width','100%');
          $('.progress-bar').removeClass('bg-danger bg-warning').addClass('bg-success');
        } else if(mediumPassword.test(password)){
          $('.progress-bar').css('width','60%');
          $('.progress-bar').removeClass('bg-danger bg-success').addClass('bg-warning');
        } else{
          $('.progress-bar').css('width','30%');
          $('.progress-bar').removeClass('bg-warning bg-success').addClass('bg-danger');
        }
      }

      function checkPassword(evt){
        $('.progress-wrapper').css('display','block');
        console.log(evt.value);

        timeout = setTimeout(() => StrengthChecker(evt.value), 500);

        if(evt.value.length !== 0){
          $('.progress-wrapper').css('display','block');
        } else{
          $('.progress-wrapper').css('display','none');
        }
      }

      function do_save(){
        var strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
        var password = $('#password').val();
        var re_password = $('#re_password').val();
        // console.log(password);
        if(!strongPassword.test(password)){
          Swal.fire({
            title: "Warning!",
            text: "Please meet all password requirement!",
            icon: "warning"
          });
        } else if(password != re_password){
          Swal.fire({
            title: "Warning!",
            text: "Password do not match. Please enter it again!",
            icon: "warning"
          });
        } else {
          $.ajax({
            url: 'system_sql.php?pro=CHANGE',
            type: 'POST',
            // beforeSend: function () {
            //   $('.btn-sign-in').prop("disabled",true);
            // },
            data: {password: password},
            success: function(data) {
              if(data == 'OK') {
                Swal.fire({
                  title: "Good job!",
                  text: "You password has been change!",
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
              }
            }
          });
        }
      }
      </script>
      <div class="modal-header">
        <label class="modal-title fs-5">Change Password</label>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card border-radius-lg bg-gradient-dark">
            <div class="card-body ">
              <h6 class="mb-0 text-white">
                Password Requirements
              </h6>
              <ul class="text-white text-sm">
                <li>Minimum 8 characters</li>
                <li>One Capital Letter</li>
                <li>One Special Characters</li>
                <li>One Number</li>
              </ul>
            </div>
          </div>
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">New Password: </label>
            </div>
          </div>
          <div class="col-md-10">
            <div class="input-group input-group-outline my-3">
              <input id="password" name="password" type="password" class="form-control" value="" oninput="checkPassword(this)" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" >
            </div>
            <div class="progress-wrapper" style="display: none;">
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="input-group input-group-inline my-3">
              <label class="form-label">Confirm New Password: </label>
            </div>
          </div>
          <div class="col-md-10">
            <div class="input-group input-group-outline my-3">
              <input id="re_password" name="re_password" type="password" class="form-control" value="" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-dark btn-submit" onclick="do_save()">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>