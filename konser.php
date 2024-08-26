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

    // Ambil data dari tabel konser dengan join ke tabel artis dan lokasi
    $data_konser = select("SELECT k.id_konser, k.nama_konser, a.nama_artis, l.lokasi_konser, k.tanggal, k.jam_konser
    FROM konser k JOIN artis a ON k.id_artis = a.id_artis JOIN lokasi l ON k.id_lokasi = l.id_lokasi");

    // Check apakah tomboh tambah data ditekan
    if (isset ($_POST ['tambah'])) {
        if (create_data_konser($_POST) > 0) {
        echo"<script>
        alert ('Data konser berhasil ditambahkan');
        document.location.href = 'konser.php';
        </script>";
    } else {
        echo"<script>
        alert ('Data konser berhasil ditambahkan');
        document.location.href = 'konser.php';
        </script>";
        }
    }

    // Check apakah tomboh ubah ditekan
    if (isset ($_POST ['ubah'])) {
        if (update_data_konser($_POST) > 0) {
            echo"<script>
                alert ('Data konser berhasil diubah');
                document.location.href = 'konser.php';
                </script>"
            ;
        } else {
            echo"<script>
                alert ('Data konser gagal diubah');
                document.location.href = 'konser.php';
                </script>"
            ;
        }
    }
?>

<div class="container mt-5">
    <h1><i class="far fa-building"></i> TABEL DATA KONSER</h1>
    <hr>

    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#tambahkonser">
        <i class="fas fa-plus-circle"></i> Tambah
    </button>

    <table class="table table-bordered table-striped mt-3" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Konser</th>
                <th>Nama Artis</th>
                <th>Lokasi Konser</th>
                <th>Tanggal</th>
                <th>Jam Konser</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_konser as $konser) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $konser['nama_konser']; ?></td>
                <td><?= $konser['nama_artis']; ?></td>
                <td><?= $konser['lokasi_konser']; ?></td>
                <td><?= $konser['tanggal']; ?></td>
                <td><?= $konser['jam_konser']; ?></td>
                <td width="20%" class="text-center">
                    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" 
                        data-bs-target="#ubahkonser<?= $konser['id_konser']; ?>">
                        <i class="far fa-edit"></i> Ubah
                    </button>

                    <button type="button" class="btn btn-danger mb-1" 
                    data-bs-toggle="modal" data-bs-target="#hapuskonser<?= $konser['id_konser']; ?>">
                    <i class="far fa-trash-alt"></i> Hapus</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Tambah data konser -->
<div class="modal fade" id="tambahkonser" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah data konser</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama_konser" class="form-label">Nama Konser</label>
                        <input type="text" class="form-control" id="nama_konser" name="nama_konser" placeholder="Masukan Nama..." required>
                    </div>

                    <div class="mb-3">
                        <label for="id_artis" class="form-label">Artis</label>
                        <select class="form-control" id="id_artis" name="id_artis" required>
                            <?php
                                // Ambil daftar artis dari database
                                $result = $db -> query("SELECT id_artis, nama_artis FROM artis");
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<option value='{$row['id_artis']}'> {$row['nama_artis']} </option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_lokasi" class="form-label">Lokasi</label>
                        <select class="form-control" id="id_lokasi" name="id_lokasi" required>
                            <?php
                                // Ambil daftar lokasi dari database
                                $result = $db -> query("SELECT id_lokasi, lokasi_konser FROM lokasi");
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<option value='{$row['id_lokasi']}'> {$row['lokasi_konser']} </option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>

                    <div class="mb-3">
                        <label for="jam_konser" class="form-label">Jam Konser</label>
                        <input type="time" class="form-control" id="jam_konser" name="jam_konser" required>
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

<!-- Ubah data konser -->
<?php foreach ($data_konser as $konser) : ?>
<div class="modal fade" id="ubahkonser<?= $konser['id_konser']; ?>" data-bs-backdrop="static" 
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah data konser</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" method="post">
                    <!-- Tambahkan input hidden untuk id_konser -->
                    <input type="hidden" name="id_konser" value="<?= $konser['id_konser']; ?>">

                    <div class="mb-3">
                        <label for="nama_konser" class="form-label">Nama Konser</label>
                        <input type="text" class="form-control" id="nama_konser" name="nama_konser"
                        value="<?= $konser['nama_konser']  ?>" placeholder="Nama Konser..." required>
                    </div>

                    <div class="mb-3">
                        <label for="id_artis" class="form-label">Artis</label>
                        <select class="form-control" id="id_artis" name="id_artis" required>
                            <?php
                                // Ambil daftar database artis
                                $result = $db -> query("SELECT id_artis, nama_artis FROM artis");
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<option value='{$row['id_artis']}'> {$row['nama_artis']} </option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_lokasi" class="form-label">Lokasi</label>
                        <select class="form-control" id="id_lokasi" name="id_lokasi" required>
                            <?php
                                // Ambil daftar database lokasi
                                $result = $db -> query("SELECT id_lokasi, lokasi_konser FROM lokasi");
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<option value='{$row['id_lokasi']}'> {$row['lokasi_konser']} </option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" 
                        value="<?= $konser['tanggal']  ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="jam_konser" class="form-label">Jam Konser</label>
                        <input type="time" class="form-control" id="jam_konser" name="jam_konser" 
                        value="<?= $konser['jam_konser']  ?>" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Hapus data konser -->
<?php foreach ($data_konser as $konser) : ?>
<div class="modal fade" id="hapuskonser<?= $konser['id_konser']; ?>" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus data konser</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>Yakin ingin menghapus data konser: <?= $konser['nama_konser']; ?> ?</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapus-konser.php?id_konser=<?= $konser['id_konser']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php
    include 'layout/footer.php';
?>