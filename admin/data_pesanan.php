<?php
session_start();
include '../config.php';

// Variabel untuk pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Halaman saat ini

// Query untuk mendapatkan jumlah total data
$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesanan"));

// Menghitung total halaman
$total_pages = ceil($total_rows / $limit);

// Membatasi query berdasarkan halaman saat ini
$offset = ($page - 1) * $limit;
$pembelian = mysqli_query($conn, "SELECT * FROM pesanan LIMIT $offset, $limit");

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $pembelian = mysqli_query($conn, "SELECT * FROM pesanan 
    WHERE
    nama_pelanggan LIKE '%$keyword%' OR
    tanggal LIKE '%$keyword%' OR
    waktu_awal LIKE '%$keyword%' OR
    waktu_akhir LIKE '%$keyword%' OR
    nominal LIKE '%$keyword%' 
    ");
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
            <?php include 'navbar.php' ?>
            <main class="content p-4">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-5">
                                    <h1 class="mb-2">Data Pesanan</h1>
                                    <form action="" method="POST" class="d-flex my-2">
                                        <a href="tambah_pesanan.php" class="btn btn-primary me-3">Tambah Pesanan</a>
                                        <input type="text" name="keyword" placeholder="Cari Pesanan..."
                                            class="form-control w-100">
                                        <button name="search" type="submit" class="btn btn-success">Cari</button>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover text-dark text-center">
                                            <thead>
                                                <tr class="table table-primary">
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal</th>
                                                    <th>Waktu Awal</th>
                                                    <th>Waktu Akhir</th>
                                                    <th>Nominal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pembelian as $td) : ?>
                                                <tr>
                                                    <td><?= $td['nama_pelanggan'] ?></td>
                                                    <td><?= date('d F Y', strtotime($td['tanggal'])) ?></td>
                                                    <td><?= date('H:i', strtotime($td['waktu_awal'])) ?></td>
                                                    <td><?= date('H:i', strtotime($td['waktu_akhir'])) ?></td>
                                                    <td><?= number_format($td['nominal'], 0); ?></td>
                                                    <td>
                                                        <a href="edit_pesanan.php?id_pesanan=<?= $td['id_pesanan']; ?>"
                                                            class="btn btn-warning mb-2">Edit </a> <br>
                                                        <a href="hapus_pesanan.php?id_pesanan=<?= $td['id_pesanan']; ?>"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Yakin ingin hapus pesanan ini?')">Hapus</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav>
                                        <ul class="pagination justify-content-center mt-4">
                                            <?php if ($page > 1) : ?>
                                            <li class="page-item">
                                                <a class="page-link btn btn-info"
                                                    href="?page=<?= ($page - 1) ?>">Sebelumnya</a>
                                            </li>
                                            <?php endif; ?>
                                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                            <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                                                <a class="page-link btn btn-info" href="?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                            <?php endfor; ?>
                                            <?php if ($page < $total_pages) : ?>
                                            <li class="page-item">
                                                <a class="page-link btn btn-info"
                                                    href="?page=<?= ($page + 1) ?>">Selanjutnya</a>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>

</html>