<?php 
    $db = mysqli_connect('localhost', 'root', '', 'konser_2');

    // Cek Koneksi
    if ($db -> connect_error) {
        die ("connection failed: ".$db -> connect_error);
    }
 ?>