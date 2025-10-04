<?php

session_start();
include 'config.php';


if (isset($_POST['daftar'])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password_sebelum = mysqli_real_escape_string($conn, $_POST["password"]);

    // cek username admin sudah ada atau belum
    $prosescek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($prosescek) > 0) {
        echo "<script>alert('Username Sudah Digunakan!');history.go(-1) </script>";
        exit;
    }
    // enkripsi password
    $password = password_hash($password_sebelum, PASSWORD_DEFAULT);

    $res = mysqli_query($conn, "INSERT INTO user VALUES(NULL, '1', '$username','$password')");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Berhasil Daftar!');
                window.location.href='login.php'
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Futsal</title>
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>


<body>
    <div class="wrapper">

        <div class="main">


            <main class="content" style="background-image: url('img/bg-index.jpeg'); background-size: cover;">
                <div class="container-fluid p-0">

                    <div class="row card border p-5"
                        style="margin: 100px 350px 50px 350px; box-shadow: 4px 4px 4px gray">
                        <h1 class="px-2 text-center">Sistem Pemesanan Lapangan Fustal</h1>
                        <div class="d-flex justify-content-center">
                            <h1 class="px-5 mt-3">DAFTAR AKUN</h1>
                        </div>
                        <br>
                        <form action="" method="POST">
                            <input name="username" type="text" placeholder="Username" class="form-control mb-4"
                                required>
                            <input name="password" type="password" placeholder="Password" class="form-control mb-4"
                                required>
                            <center>
                                <button name="daftar" type="submit" class="btn btn-success w-50">Daftar</button>
                        </form>
                        &nbsp;&nbsp;&nbsp;<a href="login.php">Login</a>
                        </center>
                    </div>


                </div>
            </main>
        </div>
    </div>

</body>

</html>