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

    $data_lokasi = select("SELECT * FROM lokasi");

    // Check apakah tomboh tambah ditekan
    if (isset ($_POST ['tambah'])) {
        if (create_data_lokasi($_POST) > 0) {
            echo"<script>
                alert ('Data lokasi berhasil ditambahkan');
                document.location.href = 'lokasi.php';
                </script>"
            ;
        } else {
            echo"<script>
                alert ('Data lokasi berhasil ditambahkan');
                document.location.href = 'lokasi.php';
                </script>"
            ;
        }
    }

    // Check apakah tomboh ubah ditekan
    if (isset ($_POST ['ubah'])) {
        if (update_data_lokasi($_POST) > 0) {
            echo"<script>
                alert ('Data lokasi berhasil diubah');
                document.location.href = 'lokasi.php';
                </script>"
            ;
        } else {
            echo"<script>
                alert ('Data lokasi gagal diubah');
                document.location.href = 'lokasi.php';
                </script>"
            ;
        }
    }
?>

    <div class="container mt-5">
        <h1><i class="far fa-compass"></i> TABEL DATA LOKASI</h1>
        <hr>

        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" 
         data-bs-target="#tambahlokasi"><i class="fas fa-plus-circle"></i> Tambah
        </button>

        <table class="table table-bordered table-striped mt-3" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lokasi Konser</th>
                    <th>kapasitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_lokasi as $lokasi) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $lokasi ['lokasi_konser']; ?></td>
                    <td><?= $lokasi ['kapasitas']; ?></td>
                    <td width="20%" class="text-center">
                        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" 
                            data-bs-target="#ubahlokasi<?= $lokasi['id_lokasi']; ?>">
                            <i class="far fa-edit"></i> Ubah
                        </button>

                        <button type="button" class="btn btn-danger mb-1" 
                        data-bs-toggle="modal" data-bs-target="#hapuslokasi<?= $lokasi['id_lokasi']; ?>">
                        <i class="far fa-trash-alt"></i> Hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<!-- Tambah data lokasi -->
<div class="modal fade" id="tambahlokasi" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah data lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="lokasi_konser" class="form-label">Lokasi Konser</label>
                        <input type="text" class="form-control" id="lokasi_konser" name="lokasi_konser" placeholder="Lokasi Konser..." required>
                    </div>

                    <div class="mb-3">
                        <label for="kapasitas" class="form-label">Kapasitas Konser</label>
                        <input type="text" class="form-control" id="kapasitas" name="kapasitas" placeholder="Kapasitas Konser..." required>
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

<!-- Ubah data lokasi -->
<?php foreach ($data_lokasi as $lokasi) : ?>
<div class="modal fade" id="ubahlokasi<?= $lokasi['id_lokasi']; ?>" data-bs-backdrop="static" 
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah data lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <!-- Tambahkan input hidden untuk id_lokasi -->
                    <input type="hidden" name="id_lokasi" value="<?= $lokasi['id_lokasi']; ?>">

                    <div class="mb-3">
                        <label for="lokasi_konser" class="form-label">Lokasi Konser</label>
                        <input type="text" class="form-control" id="lokasi_konser" name="lokasi_konser"
                        value="<?= $lokasi['lokasi_konser']  ?>" placeholder="Lokasi Konser..." required>
                    </div>

                    <div class="mb-3">
                        <label for="kapasitas" class="form-label">Kapasitas Konser</label>
                        <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                        value="<?= $lokasi['kapasitas']  ?>" placeholder="Kapasitas Konser..." required>
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

<!-- Hapus data lokasi -->
<?php foreach ($data_lokasi as $lokasi) : ?>
<div class="modal fade" id="hapuslokasi<?= $lokasi['id_lokasi']; ?>" data-bs-backdrop="static" 
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus data lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data lokasi: <?= $lokasi['lokasi_konser']; ?>?</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapus-lokasi.php?id_lokasi=<?= $lokasi['id_lokasi']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php 
    include 'layout/footer.php';
?>