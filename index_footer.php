    
          <footer class="footer py-4">
            <div class="container-fluid">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                  <div class="copyright text-center text-sm text-muted text-lg-start">
                    TeamHub © <script> document.write(new Date().getFullYear()) </script>
                  </div>
                </div>
              </div>
            </div>
          </footer>
      </div>
    </main>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModalLg" tabindex="-1" role="dialog" aria-labelledby="myModalLg" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
        </div>
      </div>
    </div>
  </form>
  <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
  </script>
  <script src="assets/js/material-dashboard.min.js?v=3.0.6"></script>
  
  <?php 
  // $conn->debug=true;
  // $rs = $conn->query("SELECT * FROM information_schema.`processlist` WHERE TIME>=300");
  // while(!$rs->EOF){
  //   $process_id=$rs->fields['ID'];
  //   print "<br>".$rs->fields['ID'].":".$rs->fields['TIME'];
  //   $conn->execute("KILL $process_id");
  //   $rs->movenext();
  // }
  // $conn->close(); 
  ?>   
</body>
</html>