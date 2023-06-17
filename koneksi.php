<?php
    // urutan = server, userdb, passdb, namadb
    $host = "localhost";
    $port = 8181;
    $username = "root";
    $password = "beliauinidb";
    $dbname = "absenrfid";

    // buat koneksi
    $konek = mysqli_connect($host, $username, $password, $dbname, $port);

    // mengecek koneksi
    if (!$konek) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>
