<?php
    include 'layout/header.php';
?>

    <div class="container mt-5">
        <h1>TAMBAH DATA KATEGORI</h1>
        <hr>
        
        <form action="" method="post">
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Jenis Kategori</label>
                <input type="text" class="form-control" id="nama_artis" name="nama_artis" placeholder="Masukan Nama..." required>
            </div>

            

            <div class="mb-3">
                <label for="kontak" class="form-label">Jumlah Kategori</label>
                <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Nomor telepon yang bisa dihubungi..." required>
            </div>

            <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
        </form>
    </div>

<?php
    include 'layout/footer.php';
?>