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

    $data_tiket = select("SELECT t.id_tiket, c.nama_konser, k.harga,  k.nama_kategori
    FROM tiket t JOIN kategori k ON t.id_kategori = k.id_kategori 
    JOIN konser c ON t.id_konser = c.id_konser");

    // Check apakah tomboh tambah ditekan
    if (isset ($_POST ['tambah'])) {
        if (create_data_tiket($_POST) > 0) {
            echo"<script>
                alert ('Data tiket berhasil ditambahkan');
                document.location.href = 'tiket.php';
                </script>"
            ;
        } else {
            echo"<script>
                alert ('Data tiket berhasil ditambahkan');
                document.location.href = 'tiket.php';
                </script>"
            ;
        }
    }
?>

    <div class="container mt-5">
        <h1><i class="fas fa-ticket-alt"></i> TABEL DATA TIKET</h1>
        <hr>

        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#tambahtiket">
            <i class="fas fa-plus-circle"></i> Tambah
        </button>

        <table class="table table-bordered table-striped mt-3" id="example">
            <thead>
                <tr>
                    <th>Kode Tiket</th>
                    <th>Kategori Tiket</th>
                    <th>Nama Konser</th>
                    <th>Harga Tiket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_tiket as $tiket) : ?>
                <tr>
                    <td><?= $tiket['id_tiket']; ?></td>
                    <td><?= $tiket['nama_kategori']; ?></td>
                    <td><?= $tiket['nama_konser']; ?></td>
                    <td>Rp. <?= number_format($tiket['harga'],2,',','.'); ?></td>
                    <td width="20%" class="text-center">
                        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" 
                            data-bs-target="#ubahtiket<?= $tiket['id_tiket']; ?>">
                            <i class="far fa-edit"></i> Ubah
                        </button>

                        <button type="button" class="btn btn-danger mb-1" 
                        data-bs-toggle="modal" data-bs-target="#hapustiket<?= $tiket['id_tiket']; ?>">
                        <i class="far fa-trash-alt"></i> Hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<!-- Tambah data tiket -->
<div class="modal fade" id="tambahtiket" data-bs-backdrop="static" data-bs-keyboard="false" 
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah data tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="id_tiket" class="form-label">Kode Tiket</label>
                        <input type="text" class="form-control" id="id_tiket" name="id_tiket" placeholder="Masukan Nomor Tiket..." required>
                    </div>

                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori Tiket</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <?php 
                                // Ambil id_kategori dari tabel kategori
                                $result = $db -> query("SELECT id_kategori, nama_kategori FROM kategori");
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<option value='{$row['id_kategori']}'> {$row['nama_kategori']} </option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_konser" class="form-label">Nama Konser</label>
                        <select class="form-control" id="id_konser" name="id_konser" required>
                            <?php
                                // Ambil nama konser dari tabel konser
                                $result = $db -> query("SELECT id_konser, nama_konser FROM konser");
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<option value='{$row['id_konser']}'> {$row['nama_konser']} </option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Harga Tiket</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <?php 
                                // Ambil Harga dari tabel kategori
                                $result = $db -> query("SELECT id_kategori, harga FROM kategori");
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<option value='{$row['id_kategori']}'> {$row['harga']} </option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ubah data tiket -->
<?php foreach ($data_tiket as $tiket) : ?>
<div class="modal fade" id="ubahtiket<?= $tiket['id_tiket']; ?>" data-bs-backdrop="static" 
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah data tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>DATA TIKET TIDAK DAPAT DIUBAH!</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ubah</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Hapus data tiket -->
<?php foreach ($data_tiket as $tiket) : ?>
<div class="modal fade" id="hapustiket<?= $tiket['id_tiket']; ?>" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus data tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data tiket: <?= $tiket['nama_konser']; ?> ?</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapus-tiket.php?id_tiket=<?= $tiket['id_tiket']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php 
    include 'layout/footer.php';
?>