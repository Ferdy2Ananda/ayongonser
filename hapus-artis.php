<?php 
    include 'config/app.php';

    // Menerima id_artis yang dipilih
    $id_artis = (int)$_GET['id_artis'];

    if (delete_data_artis($id_artis) > 0) {
        echo "<script>
            alert ('Data artis berhasil dihapus');
            document.location.href = 'index.php';
            </script>"
        ;
    } else {
        echo "<script>
            alert ('Data artis gagal dihapus');
            document.location.href = 'index.php';
            </script>"
        ;
    }
?>