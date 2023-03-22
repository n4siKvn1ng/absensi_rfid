<?php 
    include "koneksi.php";

    // baca id data yang akan dihapus
    $id = $_GET['id'];

    // hapus data
    $hapus = mysqli_query($konek, "delete from mahasiswa where id='$id'");

    // jika berhasil terhapus tampilkan pesan Terhapus
    // kemudian kembali ke data mahasiswa
    if($hapus)
    {
        echo "
            <script>
                alert('Terhapus');
                location.replace('datamahasiswa.php');
            </script>
        ";
    }
    else
    {
        echo "
            <script>
                alert('Gagal Terhapus');
                location.replace('datamahasiswa.php');
            </script>
        ";
    }
?>