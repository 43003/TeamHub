</main>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                </div>
            </div>
        </div>
      </form>
      <script src="assets/js/core/popper.min.js"></script>
      <script src="assets/js/core/bootstrap.min.js"></script>
      <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
      <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
      <script src="assets/js/plugins/dragula/dragula.min.js"></script>
      <script src="assets/js/plugins/jkanban/jkanban.js"></script>
      <script src="assets/js/plugins/chartjs.min.js"></script>
      <script>
         var ctx1 = document.getElementById("chart-line").getContext("2d");
         var ctx2 = document.getElementById("chart-pie").getContext("2d");
         
         // Line chart
         new Chart(ctx1, {
           type: "line",
           data: {
             labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
             datasets: [{
                 label: "Facebook Ads",
                 tension: 0,
                 pointRadius: 5,
                 pointBackgroundColor: "#e91e63",
                 pointBorderColor: "transparent",
                 borderColor: "#e91e63",
                 borderWidth: 4,
                 backgroundColor: "transparent",
                 fill: true,
                 data: [50, 100, 200, 190, 400, 350, 500, 450, 700],
                 maxBarThickness: 6
               },
               {
                 label: "Google Ads",
                 tension: 0,
                 borderWidth: 0,
                 pointRadius: 5,
                 pointBackgroundColor: "#3A416F",
                 pointBorderColor: "transparent",
                 borderColor: "#3A416F",
                 borderWidth: 4,
                 backgroundColor: "transparent",
                 fill: true,
                 data: [10, 30, 40, 120, 150, 220, 280, 250, 280],
                 maxBarThickness: 6
               }
             ],
           },
           options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
               legend: {
                 display: false,
               }
             },
             interaction: {
               intersect: false,
               mode: 'index',
             },
             scales: {
               y: {
                 grid: {
                   drawBorder: false,
                   display: true,
                   drawOnChartArea: true,
                   drawTicks: false,
                   borderDash: [5, 5],
                   color: '#c1c4ce5c'
                 },
                 ticks: {
                   display: true,
                   padding: 10,
                   color: '#9ca2b7',
                   font: {
                     size: 14,
                     weight: 300,
                     family: "Roboto",
                     style: 'normal',
                     lineHeight: 2
                   },
                 }
               },
               x: {
                 grid: {
                   drawBorder: false,
                   display: true,
                   drawOnChartArea: true,
                   drawTicks: true,
                   borderDash: [5, 5],
                   color: '#c1c4ce5c'
                 },
                 ticks: {
                   display: true,
                   color: '#9ca2b7',
                   padding: 10,
                   font: {
                     size: 14,
                     weight: 300,
                     family: "Roboto",
                     style: 'normal',
                     lineHeight: 2
                   },
                 }
               },
             },
           },
         });
         
         
         // Pie chart
         new Chart(ctx2, {
           type: "pie",
           data: {
             labels: ['Facebook', 'Direct', 'Organic', 'Referral'],
             datasets: [{
               label: "Projects",
               weight: 9,
               cutout: 0,
               tension: 0.9,
               pointRadius: 2,
               borderWidth: 1,
               backgroundColor: ['#17c1e8', '#e91e63', '#3A416F', '#a8b8d8'],
               data: [15, 20, 12, 60],
               fill: false
             }],
           },
           options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
               legend: {
                 display: false,
               }
             },
             interaction: {
               intersect: false,
               mode: 'index',
             },
             scales: {
               y: {
                 grid: {
                   drawBorder: false,
                   display: false,
                   drawOnChartArea: false,
                   drawTicks: false,
                   color: '#c1c4ce5c'
                 },
                 ticks: {
                   display: false
                 }
               },
               x: {
                 grid: {
                   drawBorder: false,
                   display: false,
                   drawOnChartArea: false,
                   drawTicks: false,
                   color: '#c1c4ce5c'
                 },
                 ticks: {
                   display: false,
                 }
               },
             },
           },
         });
      </script>
      <script>
         var win = navigator.platform.indexOf('Win') > -1;
         if (win && document.querySelector('#sidenav-scrollbar')) {
           var options = {
             damping: '0.5'
           }
           Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
         }
      </script>
      <script src="../../assets/js/material-dashboard.min.js?v=3.0.6"></script>
   </body>
</html>