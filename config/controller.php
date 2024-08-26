<?php

    // Fungsi menampilkan database
    function select($query) {
        global $db;

        $result = mysqli_query($db, $query);
        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    // Fungsi menambahkan data artis
    function create_data_artis($post) {
        global $db;

        $nama_artis = $post ['nama_artis'];
        $jk_artis = $post ['jk_artis'];
        $kontak = $post ['kontak'];

        // Query tambah data
        $query = "INSERT INTO artis VALUES (null, '$nama_artis','$jk_artis','$kontak')";
    
        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi update data artis
    function update_data_artis ($post) {
        global $db;

        $id_artis = $post ['id_artis'];
        $nama_artis = $post ['nama_artis'];
        $jk_artis = $post ['jk_artis'];
        $kontak = $post ['kontak'];

        // Query update data artis
        $query = "UPDATE artis SET nama_artis = '$nama_artis', jk_artis = '$jk_artis', kontak = '$kontak'
        WHERE id_artis = $id_artis";

        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi delete data artis
    function delete_data_artis ($id_artis) {
        global $db;

        // Query hapus data artis
        $query = "DELETE FROM artis WHERE id_artis = $id_artis";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    // fungsi menambahkan data konser
    function create_data_konser($post) {
        global $db;
    
        $nama_konser = $post['nama_konser'];
        $id_artis = $post['id_artis'];
        $id_lokasi = $post['id_lokasi'];
        $tanggal = $post['tanggal'];
        $jam_konser = $post['jam_konser'];
    
        // Query tambah data
        $query = "INSERT INTO konser VALUES (null, '$nama_konser', '$id_artis', '$id_lokasi', '$tanggal', '$jam_konser')";

        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi update data konser
    function update_data_konser ($post) {
        global $db;


        $id_konser = $post['id_konser'];
        $id_artis = $post['id_artis'];
        $id_lokasi = $post['id_lokasi'];
        $nama_konser = $post['nama_konser'];
        $tanggal = $post['tanggal'];
        $jam_konser = $post['jam_konser'];

        // Query update data konser
        $query = "UPDATE konser SET id_artis = '$id_artis', id_lokasi = '$id_lokasi',
        nama_konser = '$nama_konser', tanggal = '$tanggal', jam_konser = '$jam_konser'
        WHERE id_konser = $id_konser";

        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi delete data konser
    function delete_data_konser ($id_konser) {
        global $db;

        // Query hapus data konser
        $query = "DELETE FROM konser WHERE id_konser = $id_konser";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    // Fungsi menambahkan data lokasi
    function create_data_lokasi($post) {
        global $db;

        $lokasi_konser = $post ['lokasi_konser'];
        $kapasitas = $post ['kapasitas'];

        // Query tambah data
        $query = "INSERT INTO lokasi VALUES (null, '$lokasi_konser','$kapasitas')";
    
        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi update data lokasi
    function update_data_lokasi ($post) {
        global $db;

        $id_lokasi = $post ['id_lokasi'];
        $lokasi_konser = $post ['lokasi_konser'];
        $kapasitas = $post ['kapasitas'];

        // Query update data lokasi
        $query = "UPDATE lokasi SET lokasi_konser = '$lokasi_konser', kapasitas = '$kapasitas' 
        WHERE id_lokasi = $id_lokasi";

        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi delete data lokasi
    function delete_data_lokasi ($id_lokasi) {
        global $db;

        // Query hapus data lokasi
        $query = "DELETE FROM lokasi WHERE id_lokasi = $id_lokasi";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    // Fungsi menambahkan data pelanggan
    function create_data_pelanggan($post) {
        global $db;

        $nama = $post ['nama'];
        $email = $post ['email'];
        $password = $post ['password'];

        // Enkripsi Password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Query tambah data
        $query = "INSERT INTO pelanggan VALUES (null, '$nama', '$email', '$password')";
    
        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi update data pelanggan
    function update_data_pelanggan ($post) {
        global $db;

        $id_pelanggan = $post['id_pelanggan'];
        $nama = $post ['nama'];
        $email = $post ['email'];

        // Query update data pelanggan
        $query = "UPDATE pelanggan SET nama = '$nama', email = '$email' WHERE id_pelanggan = $id_pelanggan";

        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi delete data pelanggan
    function delete_data_pelanggan ($id_pelanggan) {
        global $db;

        // Query hapus data pelanggan
        $query = "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    // Fungsi menambahkan data tiket
    function create_data_tiket($post) {
        global $db;

        $id_tiket = $post ['id_tiket'];
        $id_kategori = $post ['id_kategori'];
        $id_konser = $post ['id_konser'];
        $harga = $post ['harga'];

        // Query tambah data
        $query = "INSERT INTO tiket VALUES ('$id_tiket','$id_kategori','$id_konser', '$harga')";
    
        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    // fungsi delete data tiket
    function delete_data_tiket ($id_tiket) {
        global $db;

        // Query hapus data tiket
        $query = "DELETE FROM tiket WHERE id_tiket = $id_tiket";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }
?>