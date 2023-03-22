<!-- proses penyimpanan data-->

<?php include "koneksi.php";

    //kondisi jika tombol simpan diklik
    if(isset($_POST['btnSimpan']))
    {
        //baca isi inputan form
        $nokartu    = $_POST['nokartu'];
        $nim        = $_POST['nim'];
        $nama       = $_POST['nama'];

        //simpan ke tabel karyawan
        $simpan = mysqli_query($konek, "insert into mahasiswa(nokartu, nim, nama)values('$nokartu', '$nim', '$nama')");

        //jika berhasil tersimpan, tampilkan pesan Tersimpan
        //kembali ke data mahasiswa
        if($simpan)
        {
            echo "
                <script>
                    alert('Data Berhasil Tersimpan');
                    location.replace('datakaryawan.php');
                </script>
            ";
        }
        else 
        {
            echo "
                <script>
                    alert('Data Gagal Tersimpan');
                    location.replace('datakaryawan.php');
                </script>
            ";
        }
    }

    ?>


<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Tambah Data Mahasiswa</title>
    </head>
    <body>

    <?php include "menu.php"; ?>

    <!-- isi-->
    <div class="container-fluid">
        <h3>Tambah Data Mahasiswa</h3>

        <!-- form input -->
        <form method="POST">

            <!--INPUTAN UNTUK NOMOR KARTU-->
            <div class="form-group">
                <label>No. Kartu</label>
                <input type="text" name="nokartu" id="nokartu" placeholder="Nomor kartu RFID" class="form-control" style="width: 200px">
            </div>

            <!--INPUTAN UNTUK NOMOR INDUK MAHASISWA-->
            <div class="form-group">
                <label>Nomor Induk Mahasiswa (NIM)</label>
                <input type="text" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa" class="form-control" style="width: 200px">
            </div>

            <!--INPUTAN UNTUK NAMA MAHASISWA-->
            <div class="form-group">
                <label>Nama Mahasiswa</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" class="form-control" style="width: 400px">
            </div>

            <button class="btn btn-primary" name="btnSimpan" >Simpan</button>
        </form>
    </div>

    <?php include "footer.php"; ?>
    </body>
</html>
