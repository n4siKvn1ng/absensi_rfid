<?php
    // uratan = server, userdb, passdb, namadb
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "absenrfid";

    // buat koneksi
    $konek = mysqli_connect($host, $username, $password, $dbname);

    // mengecek koneksi
    if (!$konek) {
    die("Connection failed: " . mysqli_connect_error());
    }

?>