<?php

session_start();
include '../config.php';

if (isset($_POST['daftar'])) {
    $nama_pelanggan = mysqli_real_escape_string($conn, $_POST["nama_pelanggan"]);
    $tanggal = mysqli_real_escape_string($conn, $_POST["tanggal"]);
    $waktu_awal = mysqli_real_escape_string($conn, $_POST["waktu_awal"]);
    $waktu_akhir = mysqli_real_escape_string($conn, $_POST["waktu_akhir"]);
    $nominal = mysqli_real_escape_string($conn, $_POST["nominal"]);

    // Mengubah waktu mulai dan waktu akhir menjadi format yang dapat dibandingkan
    $waktu_awal_timestamp = strtotime($waktu_awal);
    $waktu_akhir_timestamp = strtotime($waktu_akhir);

    // Pengecekan jam awal lebih kecil dari jam akhir
    if ($waktu_awal_timestamp < $waktu_akhir_timestamp) {
        $res = mysqli_query($conn, "INSERT INTO pesanan VALUES(NULL,'$nama_pelanggan','$tanggal', '$waktu_awal', '$waktu_akhir', '$nominal')");
        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Berhasil Tambah Pesanan!');
                    window.location.href='data_pesanan.php'
                </script>
            ";
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo "
                <script>
                    alert('Waktu Invalid!');
                    history.go(-1);
                </script>
            ";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'link.php' ?>
</head>


<body>
    <div class="wrapper">

        <?php include 'sidebar.php' ?>

        <div class="main">
            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row card border p-5">

                        <div class="d-flex justify-content-center">
                            <h1 class="px-5 mt-3">Tambah Pesanan Lapangan Futsal</h1>
                        </div>
                        <br>
                        <form action="" method="POST">
                            <input name="nama_pelanggan" type="text" placeholder="Nama Pelanggan" class="form-control mb-4">
                            <small class="text-dark">Tanggal</small>
                            <input name="tanggal" type="date" placeholder="Tanggal" class="form-control mb-4">
                            <small class="text-dark">Waktu Mulai</small>
                            <input name="waktu_awal" type="time" placeholder="Waktu Awal" class="form-control mb-4">
                            <small class="text-dark">Waktu Akhir</small>
                            <input name="waktu_akhir" type="time" placeholder="Waktu Akhir" class="form-control mb-4">
                            <input name="nominal" type="number" placeholder="Nominal" class="form-control mb-4">
                            <center>
                                <button name="daftar" type="submit" class="btn btn-success w-100">Tambah</button>
                        </form>
                        <br><br>
                        <a href="data_pesanan.php">Kembali</a>
                        </center>
                    </div>


                </div>
            </main>
        </div>
    </div>

</body>

</html>