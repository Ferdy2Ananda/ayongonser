<?php 
    include 'config/app.php';

    // Menerima id_lokasi yang dipilih
    $id_lokasi = (int)$_GET['id_lokasi'];

    if (delete_data_lokasi($id_lokasi) > 0) {
        echo "<script>
            alert ('Data lokasi berhasil dihapus');
            document.location.href = 'lokasi.php';
            </script>"
        ;
    } else {
        echo "<script>
            alert ('Data lokasi gagal dihapus');
            document.location.href = 'lokasi.php';
            </script>"
        ;
    }
?>