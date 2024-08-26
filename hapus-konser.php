<?php 
    include 'config/app.php';

    // Menerima id_konser yang dipilih
    $id_konser = (int)$_GET['id_konser'];

    if (delete_data_konser($id_konser) > 0) {
        echo "<script>
            alert ('Data konser berhasil dihapus');
            document.location.href = 'konser.php';
            </script>"
        ;
    } else {
        echo "<script>
            alert ('Data konser gagal dihapus');
            document.location.href = 'konser.php';
            </script>"
        ;
    }
?>