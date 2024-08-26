<?php 
    include 'config/app.php';

    // Menerima id_pelanggan yang dipilih
    $id_pelanggan = (int)$_GET['id_pelanggan'];

    if (delete_data_pelanggan($id_pelanggan) > 0) {
        echo "<script>
            alert ('Data pelanggan berhasil dihapus');
            document.location.href = 'pelanggan.php';
            </script>"
        ;
    } else {
        echo "<script>
            alert ('Data pelanggan gagal dihapus');
            document.location.href = 'pelanggan.php';
            </script>"
        ;
    }
?>