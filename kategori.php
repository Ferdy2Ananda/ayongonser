<?php

    session_start();

    // Membatasi halaman sebelum Log In
    if (!isset($_SESSION["login"])) {
        echo"<script>
                alert('diharap Log In dulu...');
                document.location.href = 'login.php';
            </script>";
        exit;
    }
    
    include 'layout/header.php';

    $data_kategori = select("SELECT * FROM kategori");
?>

    <div class="container mt-5">
        <h1><i class="fas fa-list-ul"></i> TABEL DATA KATEGORI</h1>
        <hr>

        <a href="tambah-kategori.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah</a>

        <table class="table table-bordered table-striped mt-3" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Kategori</th>
                    <th>Harga</th>
                    <th>Jumlah Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_kategori as $kategori) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $kategori ['nama_kategori']; ?></td>
                    <td><?= $kategori ['harga']; ?></td>
                    <td><?= $kategori ['jum_kategori']; ?></td>
                    <td width="20%" class="text-center">
                        <a href="ubah-artis.php?id_artis=<?= $artis['id_artis']; ?>"
                        class="btn btn-primary"><i class="far fa-edit"></i> Ubah</a> 
                        <a href="hapus-artis.php?id_artis=<?= $artis['id_artis']; ?>"
                        class="btn btn-danger" onclick="return confirm ('Apakah anda yakin data akan di hapus ?')">
                            <i class="far fa-trash-alt"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php
    include 'layout/footer.php';
?>