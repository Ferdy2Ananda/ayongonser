<?php

    include 'config/app.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JQuery CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

    <title>Full CRUD PHP</title>
  </head>
  <body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="../tiket/index.php">ayoNgonser</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../tiket/index.php">Artis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../tiket/konser.php">Konser</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../tiket/lokasi.php">Lokasi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tiket/pelanggan.php">Pelanggan</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="../tiket/tiket.php">Tiket</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tiket/kategori.php">Kategori</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tiket/logout.php">Keluar</a>
                    </li>
                </ul>
            </div>

            <div>
                <a class="navbar-brand" href="../tiket/index.php"><?= $_SESSION['nama'] ?></a>
            </div>
        </div>
        </nav>
    </div>