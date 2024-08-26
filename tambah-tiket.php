<?php 
    include 'layout/header.php';

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
        <h1>TAMBAH DATA TIKET</h1>
        <hr>
        
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

            <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
        </form>
    </div>

<?php 
    include 'layout/footer.php';
?>