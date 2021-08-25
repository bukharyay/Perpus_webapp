<?php
error_reporting(E_ALL * (E_NOTICE | E_WARNING));
include 'include/koneksi.php';
session_start();

if ($_SESSION['admin'] || $_SESSION['anggota']) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        $title = $_GET['page'];
        if ($title == null) {
            $title = 'Home';
        } elseif ($title == 'Admin') {
            $title = 'User Management';
        } elseif ($title == 'Anggota') {
            $title = 'Profile';
        }
        var_dump($title);
        ?>
        <title><?= $title; ?></title>
        <!-- Custom fonts for this template-->
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="assets/css/admin.min.css" rel="stylesheet">
        <link href="assets/css/all.min.css" rel="stylesheet">
        <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>
    <style>
        @font-face {
            font-family: Quicksand-Medium;
            src: url('./assets/font/Quicksand-Medium.ttf');
        }

        * {
            font-family: Quicksand-Medium, sans-serif;
        }

        a {
            text-decoration: none;
        }
    </style>

    <body id="page-top">
        <?php
        if ($_SESSION['admin']) {
            $user = $_SESSION['admin'];
        } else if ($_SESSION['anggota']) {
            $user = $_SESSION['anggota'];
        }

        $sql = $koneksi->query("SELECT * FROM `tb_user` WHERE `tb_user`.`id_user` = '$user'")->fetch_assoc();

        ?>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon ">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3"> SysPerpus </div>
                </a>


                <!-- Heading -->
                <div class="sidebar-heading">
                    Dashboard
                </div>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item <?= $title == 'Home' ? 'active' : ''; ?>">
                    <a class="nav-link" href="?page">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Beranda</span></a>
                </li>

                <?php
                if ($_SESSION['admin']) {
                ?>
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Admin
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item <?= $title == 'User Management' ? 'active' : ''; ?>">
                        <a class="nav-link" href="?page=Admin">
                            <i class="fas fa-fw fa-user-cog"></i>
                            <span>User Management</span></a>
                    </li>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datamaster" aria-expanded="true" aria-controls="datamaster">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>Data Master</span>
                        </a>
                        <div id="datamaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-gray-dark py-1 collapse-inner rounded">
                                <a class="nav-link" href="?page=Anggota"><span>Anggota</span></a>
                                <hr class="sidebar-divider">
                                <a class="nav-link" href="?page=Data Buku"><span>Data Buku</span></a>

                            </div>
                        </div>
                    </li>



                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datatransaksi" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-wrench"></i>
                            <span>Data Transaksi</span>
                        </a>
                        <div id="datatransaksi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                            <div class="bg-gray-dark py-1 collapse-inner rounded">
                                <a class="nav-link" href=""><span>Transakasi Peminjaman</span></a>
                                <hr class="sidebar-divider">
                                <a class="nav-link" href=""><span>Transaksi Pengembalian</span></a>

                            </div>
                        </div>
                    </li>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Laporan Transaksi</span>
                        </a>
                        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-gray-dark py-1 collapse-inner rounded">
                                <a class="nav-link" href=""><span>Data Transaksi</span></a>
                            </div>
                        </div>
                    </li>
                <?php
                } else if ($_SESSION['anggota']) {
                ?>
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Anggota
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item <?= $title == 'Profile' ? 'active' : ''; ?>">
                        <a class="nav-link" href="?page=Anggota">
                            <i class="fas fa-fw fa-user-tie"></i>
                            <span>Profile</span></a>
                    </li>
                <?php
                }
                ?>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>


            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <div class="sidebar-brand-text mx-3"> Sistem Informasi Perpustakaan </div>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>



                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $sql['nama_user']; ?></span>
                                    <!-- <img class="img-profile rounded-circle" src="img/undraw_profile.svg"> -->
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                </a>
                                <!-- Dropdown - User Information -->

                            </li>


                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                </a>
                            </li> -->

                            <li class="nav-item no-arrow">
                                <a class="nav-link" href="?page=Logout" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout</span>
                                    <i class="fas fa-sign-out-alt  fa-sm fa-fw mr-2 text-gray-400"></i>

                                </a>


                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->

                    <!-- End of Main Content -->
                    <div class="container-fluid">

                        <?php if ($_GET['berhasil']) {
                        ?>
                            <div class='alert alert-success'>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Selemat Datang <?= $sql['nama_user']; ?>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- ======================================== AMBIL DATA ======================================== -->
                        <?php include 'include/isi.php'; ?>
                        <!-- ======================================== END AMBIL DATA ======================================== -->




                        <p>Pembagian Level Menggunakan Session</p>
                        <p>SESSION AKTIF = <?php var_dump($_SESSION); ?></p>

                        <!-- Footer -->
                        <footer class="sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Copyright &copy; Your Website 2021</span>
                                </div>
                            </div>
                        </footer>


                    </div>
                    <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="login.html">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap core JavaScript-->

                <script src="assets/vendor/jquery/jquery.min.js"></script>
                <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
                <script src="assets/js/all.min.js"></script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#example').DataTable();
                    });
                </script>

                <!-- Core plugin JavaScript-->
                <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="assets/js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <!-- <script src="assets/vendor/chart.js/Chart.min.js"></script> -->

                <!-- Page level custom scripts -->
                <!-- <script src="assets/js/demo/chart-area-demo.js"></script> -->
                <!-- <script src="assets/js/demo/chart-pie-demo.js"></script> -->

    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
