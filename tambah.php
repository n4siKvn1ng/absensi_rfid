<!-- proses penyimpanan data-->

<?php include "koneksi.php";

    //kondisi jika tombol simpan diklik
    if(isset($_POST['btnSimpan']))
    {
        //baca isi inputan form
        $nokartu    = $_POST['nokartu'];
        $nim        = $_POST['nim'];
        $nama       = $_POST['nama'];

        //mengecek apakah ada data yang sama
        $cek_nokartu = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE nokartu='$nokartu'");
        $cek_nim = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE nim='$nim'");
        $cek_nama = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE nama='$nama'");
        if(mysqli_num_rows($cek_nim) > 0) {
            echo "
                <script>
                    alert('Data Mahasiswa dengan NIM yang sama sudah tersimpan');
                </script>
            ";
        }else if (mysqli_num_rows($cek_nokartu) > 0) {
            echo "
                <script>
                    alert('Data Mahasiswa dengan No. Kartu yang sama sudah tersimpan');
                </script>
            ";
        }else if (mysqli_num_rows($cek_nama) > 0) {
            echo "
                <script>
                    alert('Data Mahasiswa dengan Nama yang sama sudah tersimpan');
                </script>
            ";
        }else {
            //simpan ke tabel mahasiswa
             $simpan = mysqli_query($konek, "insert into mahasiswa(nokartu, nim, nama)values('$nokartu', '$nim', '$nama')");
            
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
        
     } 
     if(isset($_POST['batal'])){
       
        echo "
            <script>
                location.replace('datamahasiswa.php');
            </script>
            ";
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Tambah Data Mahasiswa</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        
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
                <input type="text" name="nokartu" id="nokartu" placeholder="Nomor kartu RFID" class="form-control" style="width: 200px" required>
            </div>

            <!--INPUTAN UNTUK NOMOR INDUK MAHASISWA-->
            <div class="form-group">
                <label>Nomor Induk Mahasiswa (NIM)</label>
                <input type="text" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa" class="form-control" style="width: 200px" required>
            </div>

            <!--INPUTAN UNTUK NAMA MAHASISWA-->
            <div class="form-group">
                <label>Nama Mahasiswa</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" class="form-control" style="width: 400px" required>
            </div>

            <button class="btn btn-primary" name="btnSimpan" >Simpan</button>
            <button class="btn btn-warning" name="batal" onclick="location.href='datamahasiswa.php'">Batal</button>
            
        </form>
    </div>

    <?php include "footer.php"; ?>
    </body>
</html>
