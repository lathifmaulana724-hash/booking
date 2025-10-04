<?php

session_start();
include '../config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'link.php'; ?>
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
                                <div class="card-body text-center">
                                    <h2>Selamat Datang, Admin!</h2>
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