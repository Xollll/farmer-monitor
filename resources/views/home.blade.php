<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Farmer Monitor System</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css', true) }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ secure_asset('css/sb-admin-2.min.css') }}">



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="icon-with-image">
                        <img src="{{ asset('/img/leave.png', true) }}" alt="leave logo" style="width: 65px; height: 60px">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3">F M S</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->name }}
                                </span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg', true) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Moisture Level</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area" style="height: 500px;">
                                        <canvas id="myChart" style="width: 400px"></canvas>
                                        <script>
                                            const ctx = document.getElementById('myChart');
                                            const myChart = new Chart(ctx, {
                                                type: 'line',
                                                data: {
                                                    labels: {!! json_encode($labels) !!},
                                                    datasets: [{
                                                        label: 'Moisture Level (%)',
                                                        data: {!! json_encode($data) !!},
                                                        borderColor: 'rgba(75, 192, 192, 1)',
                                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                        borderWidth: 2,
                                                        fill: false,
                                                        tension: 0.4
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true,
                                                            title: {
                                                                display: true,
                                                                text: 'Moisture Level (%)'
                                                            }
                                                        },
                                                        x: {
                                                            title: {
                                                                display: true,
                                                                text: 'Time'
                                                            }
                                                        }
                                                    }
                                                }
                                            });

                                            function fetchDashData() {
                                                fetch('/chart-data')
                                                    .then(response => {
                                                        if (!response.ok) {
                                                            throw new Error('Network response was not ok');
                                                        }
                                                        return response.json();
                                                    })
                                                    .then(data => {
                                                        myChart.data.labels = data.labels;
                                                        myChart.data.datasets[0].data = data.data;
                                                        myChart.update();
                                                    })
                                                    .catch(error => console.error('Error fetching chart data:', error));
                                            }

                                            setInterval(fetchDashData, 5000);
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">pH Level</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="PhChart"></canvas>

                                        <script>
                                            const phLevel = {!! json_encode($PHData) !!};
                                            const data = {
                                                datasets: [{
                                                    label: 'pH Level',
                                                    data: [phLevel, 14 - phLevel],
                                                    backgroundColor: [
                                                        'rgba(75, 192, 192, 0.2)',
                                                        'rgba(220, 220, 220, 0.2)'
                                                    ],
                                                    borderColor: [
                                                        'rgba(75, 192, 192, 1)',
                                                        'rgba(220, 220, 220, 1)'
                                                    ],
                                                    borderWidth: 1,
                                                    cutout: '90%',
                                                    circumference: 180,
                                                    rotation: 270
                                                }]
                                            };

                                            const doughnutPointer = {
                                                id: 'doughnutPointer',
                                                afterDatasetsDraw(chart) {
                                                    const { ctx } = chart;
                                                    ctx.save();
                                                    const xCenter = chart.getDatasetMeta(0).data[0].x;
                                                    const yCenter = chart.getDatasetMeta(0).data[0].y;
                                                    ctx.font = 'bold 30px sans-serif';
                                                    ctx.fillStyle = 'black';
                                                    ctx.textAlign = 'center';
                                                    ctx.baseline = 'middle';
                                                    ctx.fillText(phLevel.toFixed(1), xCenter, yCenter);
                                                    ctx.restore();
                                                }
                                            };

                                            const config = {
                                                type: 'doughnut',
                                                data: data,
                                                options: {
                                                    plugins: {
                                                        legend: { display: false },
                                                        tooltip: { enabled: false },
                                                        doughnutPointer: { pointerValue: phLevel }
                                                    },
                                                    maintainAspectRatio: false,
                                                },
                                                plugins: [doughnutPointer]
                                            };

                                            const PhChart = new Chart(
                                                document.getElementById('PhChart'),
                                                config
                                            );
                                        </script>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-8 col-lg-7">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <div class="chart-pie pt-4 pb-2">
                                                <canvas id="PhChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2024</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="https://code.jquery.com/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js', true) }}"></script>

    </div>
</body>

</html>
