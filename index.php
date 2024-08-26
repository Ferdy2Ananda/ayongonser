<?php 

    session_start();
    
    // Membatasi halaman sebelum Log In
    if (!isset($_SESSION["login"])) {
        echo "<script>
                alert('diharap Log In dulu...');
                document.location.href = 'login.php';
            </script>";
        exit;
    }

    include 'layout/header.php';
    
    $data_artis = select("SELECT * FROM artis ORDER BY id_artis DESC");

    // Check apakah tombol tambah ditekan
    if (isset ($_POST['tambah'])) {
        if (create_data_artis($_POST) > 0) {
            echo "<script>
                alert ('Data artis berhasil ditambahkan');
                document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>
                alert ('Data artis gagal ditambahkan');
                document.location.href = 'index.php';
                </script>";
        }
    }

    // Check apakah tombol ubah ditekan
    if (isset ($_POST['ubah'])) {
        if (update_data_artis($_POST) > 0) {
            echo "<script>
                alert ('Data artis berhasil di ubah');
                document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>
                alert ('Data artis gagal di ubah');
                document.location.href = 'index.php';
                </script>";
        }
    }
?>

<div class="container mt-5">
    <h1><i class="far fa-star"></i> TABEL DATA ARTIS</h1>
    <hr>

    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus-circle"></i> Tambah
    </button>

    <table class="table table-bordered table-striped mt-3" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Artis</th>
                <th>Jenis Kelamin</th>
                <th>Kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_artis as $artis) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $artis['nama_artis']; ?></td>
                <td><?= $artis['jk_artis']; ?></td>
                <td><?= $artis['kontak']; ?></td>
                <td width="20%" class="text-center">
                    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" 
                    data-bs-target="#modalUbah<?= $artis['id_artis']; ?>"><i class="far fa-edit">
                    </i> Ubah</button>
                    
                    <button type="button" class="btn btn-danger mb-1" 
                    data-bs-toggle="modal" data-bs-target="#modalHapus<?= $artis['id_artis']; ?>">
                    <i class="far fa-trash-alt"></i> Hapus</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Tambah data artis -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah data artis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama_artis" class="form-label">Nama Artis</label>
                        <input type="text" class="form-control" id="nama_artis" name="nama_artis" required>
                    </div>

                    <div>
                        <label for="jk_artis">Jenis Kelamin</label>
                        <select class="form-select mb-2" id="jk_artis" name="jk_artis" required>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Nomor telepon yang bisa dihubungi..." required>
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

<!-- Ubah data artis -->
<?php foreach ($data_artis as $artis) : ?>
<div class="modal fade" id="modalUbah<?= $artis['id_artis'];?>" data-bs-backdrop="static" 
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah data artis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_artis" value="<?= $artis['id_artis']; ?>">

                    <div class="mb-3">
                        <label for="nama_artis" class="form-label">Nama Artis</label>
                        <input type="text" class="form-control" id="nama_artis" name="nama_artis" 
                        value="<?= $artis ['nama_artis']?>" required>
                    </div>

                    <div>
                        <label for="jk_artis">Jenis Kelamin</label>
                        <select class="form-select mb-2" id="jk_artis" name="jk_artis" required>
                            <?php $jk_artis = $artis['jk_artis']; ?>
                            <option value="Laki - Laki"<?= $jk_artis == 'Laki - Laki' ? 'selected' : null ?>>Laki - Laki</option>
                            <option value="Perempuan"<?= $jk_artis == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="kontak" name="kontak"
                        value="<?= $artis ['kontak'];?>" required>
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

<!-- Hapus data artis -->
<?php foreach ($data_artis as $artis) : ?>
<div class="modal fade" id="modalHapus<?= $artis['id_artis']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus data artis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data artis: <?= $artis['nama_artis']; ?>?</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapus-artis.php?id_artis=<?= $artis['id_artis']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php
    include 'layout/footer.php';
?>
