<?php 

    session_start();
    
    include 'layout/header.php';

    $data_pelanggan = select("SELECT * FROM pelanggan");

    // Check apakah tomboh tambah ditekan
    if (isset ($_POST ['tambah'])) {
        if (create_data_pelanggan($_POST) > 0) {
            echo"<script>
                alert ('Data pelanggan berhasil ditambahkan');
                document.location.href = 'pelanggan.php';
                </script>";
        } else {
            echo"<script>
                alert ('Data pelanggan gagal ditambahkan');
                document.location.href = 'pelanggan.php';
                </script>";
        }
    }

    // Check apakah tomboh ubah ditekan
    if (isset ($_POST ['ubah'])) {
        if (update_data_pelanggan($_POST) > 0) {
            echo"<script>
                alert ('Data pelanggan berhasil diubah');
                document.location.href = 'pelanggan.php';
                </script>"
            ;
        } else {
            echo"<script>
                alert ('Data pelanggan berhasil diubah');
                document.location.href = 'pelanggan.php';
                </script>"
            ;
        }
    }
?>

<div class="container mt-5">
        <h1><i class="fas fa-users"></i> TABEL DATA PELANGGAN</h1>
        <hr>

        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#tambahpelanggan">
        <i class="fas fa-plus-circle"></i> Tambah
    </button>

        <table class="table table-bordered table-striped mt-3" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_pelanggan as $pelanggan) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $pelanggan ['nama']; ?></td>
                    <td><?= $pelanggan ['email']; ?></td>
                    <td>Password Ter-enkripsi</td>
                    <td width="20%" class="text-center">
                        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" 
                            data-bs-target="#ubahpelanggan<?= $pelanggan['id_pelanggan']; ?>">
                            <i class="far fa-edit"></i> Ubah
                        </button>

                        <button type="button" class="btn btn-danger mb-1" 
                            data-bs-toggle="modal" data-bs-target="#hapuspelanggan<?= $pelanggan['id_pelanggan']; ?>">
                            <i class="far fa-trash-alt"></i> Hapus
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<!-- Tambah data pelanggan -->
<div class="modal fade" id="tambahpelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah data pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Pelanggan..." required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email..." required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi..." required>
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

<!-- Ubah data pelanggan -->
<?php foreach ($data_pelanggan as $pelanggan) : ?>
<div class="modal fade" id="ubahpelanggan<?= $pelanggan['id_pelanggan']; ?>" data-bs-backdrop="static" 
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah data pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan']; ?>">

                    <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                        value="<?= $pelanggan['nama']  ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" 
                        value="<?= $pelanggan['email']  ?>" required>
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

<!-- Hapus data pelanggan -->
<?php foreach ($data_pelanggan as $pelanggan) : ?>
<div class="modal fade" id="hapuspelanggan<?= $pelanggan['id_pelanggan']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus data pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data pelanggan: <?= $pelanggan['nama']; ?> ?</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapus-pelanggan.php?id_pelanggan=<?= $pelanggan['id_pelanggan']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php 
    include 'layout/footer.php';
?>