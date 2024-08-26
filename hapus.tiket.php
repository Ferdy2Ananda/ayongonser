<?php 
    include 'config/app.php';

    // Menerima id_tiket yang dipilih
    $id_tiket = (int)$_GET['id_tiket'];

    if (delete_data_tiket($id_tiket) > 0) {
        echo "<script>
            alert ('Data artis berhasil dihapus');
            document.location.href = 'tiket.php';
            </script>"
        ;
    } else {
        echo "<script>
            alert ('Data artis gagal dihapus');
            document.location.href = 'tiket.php';
            </script>"
        ;
    }
?>