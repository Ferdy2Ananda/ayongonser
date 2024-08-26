<?php
    session_start();
    
    // Membatasi halaman sebelum Log In
    if (!isset($_SESSION["login"])) {
        echo"<script>
                alert('diharap Log In dulu...');
                document.location.href = 'login.php';
            </script>";
        exit;
    }

    $_SESSION = [];

    session_unset();
    session_destroy();
    header("Location: login.php");
 ?>