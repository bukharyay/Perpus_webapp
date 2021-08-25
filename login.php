<?php
// error_reporting(E_ALL * (E_NOTICE | E_WARNING));
include 'include/koneksi.php';
session_start();
if ($_SESSION['admin'] || $_SESSION['anggota']) {
?>
    <script type="text/javascript">
        window.location.href = 'index.php';
    </script>
<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body class="bg-perpus">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row card-login">
                                <!-- Foto -->
                                <div class="col p-1 card-foto">
                                    <img src="assets/image/g-perpus.jpeg" alt="">
                                </div>
                                <!-- Form Login -->
                                <div class="col p-1">
                                    <div class="card-form">
                                        <div class="text-center mb-4 ">
                                            <h1>Login Page</h1>
                                            <hr>
                                        </div>
                                        <?php
                                        if (isset($_GET['msga'])) {
                                        ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Maaf!</strong> User tidak ditemukan.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (isset($_GET['msgp'])) {
                                        ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Maaf!</strong> Username atau Password salah.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <form action="" method="post">
                                            <div class="form-group mb-3">
                                                <input type="text" name="username" id="username" class="form-control form-control-user" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Enter Email Address...">
                                            </div>
                                            <!-- <label>Username : </label><br> -->
                                            <!-- <input type="text" name="username" id="username" placeholder="Masukkan Username"><br> -->
                                            <!-- <label>Passsword : </label><br>/ -->
                                            <!-- <input type="text" name="password" id="password" placeholder="Masukkan Password"><br> -->
                                            <button class="btn d-block w-100 " style="background-color: #bd9a87; border: solid 1px #bd9a87; color: #fff; border-radius: 20px; padding: 0.6rem;" type="submit" name="submit">Submit</button>
                                            <!-- <button class="btn btn-secondary" type="submit" name="submit">Submit</button> -->
                                        </form>
                                        <p>Notice = Masih Debugging</p>
                                        <p>SESSION AKTIF = <?php var_dump($_SESSION); ?></p>

                                        <?php
                                        // $useras = $koneksi->query("SELECT * FROM `tb_user`")->fetch_assoc();
                                        // echo '<pre>';
                                        // var_dump($useras);
                                        // echo '</pre>';
                                        // die;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    </html>

    <?php
    $submit = isset($_POST['submit']);
    if ($submit) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);

        $user = $koneksi->query("SELECT * FROM `tb_user` WHERE `tb_user`.`username` = '$username'")->fetch_row();

        if ($user[2] == TRUE) {
            if ($user[3] == $password) {
                echo 'berhasil';

                if ($user[4] == 'admin') {
                    $_SESSION['admin'] = $user[0];
    ?>
                    <script type="text/javascript">
                        window.location.href = 'index.php?page&msg=berhasil';
                    </script>
                <?php
                } else {
                    $_SESSION['anggota'] = $user[0];

                ?>
                    <script type="text/javascript">
                        window.location.href = 'index.php?page&msg=berhasil';
                    </script>
                <?php
                }
            } else {
                ?>
                <script type="text/javascript">
                    window.location.href = 'login.php?msgp';
                </script>
            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                window.location.href = 'login.php?msga';
            </script>
<?php
        }
    }
}

?>