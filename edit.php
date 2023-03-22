<!-- proses penyimpanan data-->

<?php include "koneksi.php";

    // baca ID data yang akan diedit
    $id = $_GET['id'];

    // baca data mahasiswa berdasarkan id
    $cari = mysqli_query($konek, "select * from mahasiswa where id='$id'");
    $hasil = mysqli_fetch_array($cari);

    //kondisi jika tombol simpan diklik
    if(isset($_POST['btnSimpan']))
    {
        //baca isi inputan form
        $nokartu    = $_POST['nokartu'];
        $nim        = $_POST['nim'];
        $nama       = $_POST['nama'];

        //simpan ke tabel mahasiswa
        $simpan = mysqli_query($konek, "update mahasiswa set nokartu='$nokartu', nim='$nim', nama='$nama' where id='$id'");

        //jika berhasil tersimpan, tampilkan pesan Tersimpan
        //kembali ke data mahasiswa
        if($simpan)
        {
            echo "
                <script>
                    alert('Data Berhasil Tersimpan');
                    location.replace('datamahasiswa.php');
                </script>
            ";
        }
        else 
        {
            echo "
                <script>
                    alert('Data Gagal Tersimpan');
                    location.replace('datamahasiswa.php');
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
                <input type="text" name="nokartu" id="nokartu" placeholder="Nomor kartu RFID" class="form-control" style="width: 200px"
                value="<?php echo $hasil['nokartu']; ?>">
            </div>

            <!--INPUTAN UNTUK NOMOR INDUK MAHASISWA-->
            <div class="form-group">
                <label>Nomor Induk Mahasiswa (NIM)</label>
                <input type="text" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa" class="form-control" style="width: 200px" value="<?php echo $hasil['nim']; ?>">
            </div>

            <!--INPUTAN UNTUK NAMA MAHASISWA-->
            <div class="form-group">
                <label>Nama Mahasiswa</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" class="form-control" style="width: 400px" value="<?php echo $hasil['nama']; ?>">
            </div>

            <button class="btn btn-primary" name="btnSimpan" >Simpan</button>
        </form>
    </div>

    <?php include "footer.php"; ?>
    </body>
</html>
