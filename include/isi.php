<?php
$page =  $_GET['page'];
$aksi =  $_GET['aksi'];
$alert = $_GET['msg'];



switch ($page) {
    case 'Admin':
        if (!$_SESSION['admin']) {
?>
            <script type="text/javascript">
                window.location.href = '?page';
            </script>
        <?php
        }
        switch ($aksi) {
            case 'tambah';
                include 'page/Admin/tambah.php';
                break;
            case 'detail':
                include 'page/Admin/detail.php';
                break;
            case 'edit':
                include 'page/Admin/edit.php';
                break;
            default:
                include 'page/Admin/index.php';
                break;
        }
        break;
    case 'Anggota':
        if (!$_SESSION['anggota']) {
        ?>
            <script type="text/javascript">
                window.location.href = '?page';
            </script>
            <?php
        }
        switch ($aksi) {
            default:
                include 'page/Anggota/index.php';
                break;
        }
        break;
    case 'Logout':
        include 'logout.php';
        break;
    default:
        switch ($aksi) {
            default:
                if ($alert == 'berhasil') {
            ?>
                    <div class='alert alert-success'>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Selamat Datang <?= $sql['nama_user']; ?>
                    </div>
<?php
                    include 'page/home.php';
                } else {
                    include 'page/home.php';
                }
                break;
        }
        break;
}
