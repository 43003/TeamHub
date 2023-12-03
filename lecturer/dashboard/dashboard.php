            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card h-100">
                            <div class="d-flex">
                                <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                                    <i class="material-icons opacity-10" aria-hidden="true">groups</i>
                                </div>
                                <h6 class="mt-3 mb-2 ms-3 ">Students</h6>
                            </div>
                            <div class="card-body pb-0 p-3 mt-4">
                                <div class="row">
                                    <div class="col-7 text-start">
                                        <div class="chart">
                                            <canvas id="chart-pie" class="chart-canvas" height="200"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-5 my-auto">
                                        <span class="badge badge-md badge-dot me-4 d-block text-start">
                                            <i class="bg-info"></i>
                                            <span class="text-dark text-xs">Facebook</span>
                                        </span>
                                        <span class="badge badge-md badge-dot me-4 d-block text-start">
                                            <i class="bg-primary"></i>
                                            <span class="text-dark text-xs">Direct</span>
                                        </span>
                                        <span class="badge badge-md badge-dot me-4 d-block text-start">
                                            <i class="bg-dark"></i>
                                            <span class="text-dark text-xs">Organic</span>
                                        </span>
                                        <span class="badge badge-md badge-dot me-4 d-block text-start">
                                            <i class="bg-secondary"></i>
                                            <span class="text-dark text-xs">Referral</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pt-0 pb-0 p-3 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="table-responsive">
                                        <table class="table align-items-center ">
                                            <tbody>
                                                <tr>
                                                    <td class="w-30">
                                                        <div class="ms-4">
                                                            <p class="text-xs font-weight-bold mb-0 ">Course:</p>
                                                            <h6 class="text-sm font-weight-normal mb-0 ">DITU 2231 - Projek Diploma</h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0 ">Total Students:</p>
                                                            <h6 class="text-sm font-weight-normal mb-0 ">2500</h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
                        <div class="card h-100">
                            <div class="d-flex">
                                <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                                    <i class="material-icons opacity-10" aria-hidden="true">analytics</i>
                                </div>
                                <h6 class="mt-3 mb-2 ms-3 ">Assessment</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="350"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
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
                </div>