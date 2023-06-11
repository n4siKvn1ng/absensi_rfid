<?php
    include "koneksi.php";

    //baca ID Data yang akan di edit
    $id = $_GET['id'];

    //baca Data Mahasiswa berdasarkan id
    $cari = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE id='$id'");
    $hasil = mysqli_fetch_array($cari);

    //baca id_kelas dari data mahasiswa
    $id_kelas = $hasil['id_kelas'];

    //baca data kelas berdasarkan id_kelas
    $cek_kelas = mysqli_query($konek, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
    $hasil_kelas = mysqli_fetch_array($cek_kelas);
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
            <h3>Edit Data Mahasiswa</h3>

            <!-- form input -->
            <form method="POST">

                <!--INPUTAN UNTUK NOMOR KARTU-->
                <div class="form-group">
                    <label>Nomor Induk Mahasiswa (NIM)</label>
                    <input type="text" name="nokartu" id="nokartu" placeholder="Nomor kartu RFID" class="form-control" style="width: 250px" readonly value="<?php echo $hasil['nokartu']; ?>">
                </div>

                <!--INPUTAN UNTUK NAMA MAHASISWA-->
                <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" class="form-control" style="width: 250px"required
                    value="<?php echo $hasil['nama']; ?>">
                </div>

                <div class="form-group">
                <label for="id_kelas">Kelas Praktikum</label><br>
                <div style="display: flex; justify-content: wrap">
                    <div style="width: 150px">
                        <?php
                        $tambah_kelas = mysqli_query($konek, "SELECT * FROM kelas");
                        $kelas_terpilih = explode(',', $hasil['id_kelas']);
                        $total_data = mysqli_num_rows($tambah_kelas);
                        $left_data = ceil($total_data / 2); // Jumlah data di sebelah kiri
                        $counter = 0;

                        while ($data = mysqli_fetch_array($tambah_kelas)) {
                            if ($counter < $left_data) {
                                ?>
                                <div style="width: 100%;">
                                    <input type='checkbox' name='id_kelas[]' value='<?php echo $data['id_kelas'] ?>' <?php if (in_array($data['id_kelas'], $kelas_terpilih)) echo 'checked' ?>>&nbsp;<?php echo $data['singkatan'] ?>
                                </div>
                                <?php
                            }
                            $counter++;
                        }
                        ?>
                    </div>
                    <div style="width: 150px">
                        <?php
                        mysqli_data_seek($tambah_kelas, 0); // Mengembalikan kursor ke awal hasil query
                        $counter = 0;

                        while ($data = mysqli_fetch_array($tambah_kelas)) {
                            if ($counter >= $left_data) {
                                ?>
                                <div style="width: 100%;">
                                    <input type='checkbox' name='id_kelas[]' value='<?php echo $data['id_kelas'] ?>' <?php if (in_array($data['id_kelas'], $kelas_terpilih)) echo 'checked' ?>>&nbsp;<?php echo $data['singkatan'] ?>
                                </div>
                                <?php
                            }
                            $counter++;
                        }
                        ?>
                    </div>
                </div>
            </div>


                <button class="btn btn-primary" name="btnSimpan" >Update</button>
                <button class="btn btn-warning" name="batal" onclick="location.href='datamahasiswa.php'">Batal</button>
            </form>
        </div>
    
        <?php include "koneksi.php";
        // simpan data sementara yang diedit dalam variabel
        $nokartu_sementara = $_POST['nokartu'] ?? $hasil['nokartu'];
        $nama_sementara = $_POST['nama'] ?? $hasil['nama'];

        //kondisi jika tombol simpan diklik
        if(isset($_POST['btnSimpan'])){
            //baca isi inputan form
            $nokartu    = $_POST['nokartu'];
            $nama       = $_POST['nama'];
            $id_kelas   = implode(",", $_POST['id_kelas']);

            $cek_kelas = mysqli_query($konek, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
            if(empty($id_kelas) || $id_kelas == '0'){
                echo "
                    <script>
                        alert('Kelas praktikum belum dipilih');
                        location.href='tambahmahasiswa.php';
                    </script>
                ";
            } else {
                //validasi inputan id_kelas
                $cek_kelas = mysqli_query($konek, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
                $count_kelas = mysqli_num_rows($cek_kelas);
                if($count_kelas == 0) {
                    echo "
                        <script>
                        $(document).ready(function() {
                            $('#kelas_kosong').modal('show');
                            $('#nokartu').val('$nokartu');
                            $('#nama').val('$nama');
                        });
                        </script>
                    ";
                } else {
                    //mengecek apakah ada data yang sama
                    $cek_nokartu = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE nokartu='$nokartu' AND id != '$id'");
                    $cek_nama = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE nama='$nama' AND id != '$id'");
                    if(mysqli_num_rows($cek_nokartu) > 0) {
                        echo "
                            <script>
                                $(document).ready(function() {
                                $('#nim_sama').modal('show');
                                $('#nokartu').val('$nokartu');
                                $('#nama').val('$nama');
                                });
                            </script>";
                    } else if(strlen($nokartu) != 15) {
                        echo "<script>
                            $(document).ready(function() {
                            $('#nim_15').modal('show');
                            $('#nokartu').val('$nokartu');
                            $('#nama').val('$nama');
                            });
                            </script>";
                    } else if (mysqli_num_rows($cek_nama) > 0) {
                        echo "
                            <script>
                                $(document).ready(function() {
                                $('#nama_sama').modal('show');
                                $('#nokartu').val('$nokartu');
                                $('#nama').val('$nama');
                                });
                            </script>
                            ";
                    } else {
                        //simpan ke tabel mahasiswa
                        $simpan = mysqli_query($konek, "UPDATE mahasiswa SET nokartu='$nokartu', nama='$nama', id_kelas='$id_kelas' WHERE id='$id'");
                        if($simpan) {
                            echo "
                            <script>
                                $(document).ready(function() {
                                $('#pesan_berhasil').modal('show');
                                });
                            </script>";
                        } else {
                            echo "
                            <script>
                                $(document).ready(function() {
                                $('#pesan_gagal').modal('show');
                                });
                            </script>
                            ";
                        }
                    }
                    
                } 
            }
        }

        if(isset($_POST['batal'])){
            echo "
            <script>
                location.replace('datamahasiswa.php');
            </script>";
        }?>

        <!-- modal Berhasil -->
        <div class="modal fade" id="pesan_berhasil" tabindex="-1" role="dialog" aria-labelledby="pesanberhasilLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 350px; margin-top: 5%;">
                <div class="modal-content">
                    <div class="modal-body" style="background-color: green; color: white">
                        <h4><strong>Data Berhasil Tersimpan</strong></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="color: blue; border: 1px solid black; border-color: blue" data-dismiss="modal" onclick="window.location.href='datamahasiswa.php'">Oke</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- modal Gagal -->
        <div class="modal fade" id="pesan_gagal" tabindex="-1" role="dialog" aria-labelledby="pesan gagal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="background-color: red; color: white">
                        <h4><strong>Data Gagal Tersimpan</strong></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="color: blue; border: 1px solid black; border-color: red" data-dismiss="modal" onclick="window.location.href='datamahasiswa.php'">Oke</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal Nim Sama -->
        <div class="modal fade" id="nim_sama" tabindex="-1" role="dialog" aria-labelledby="nim sama" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="background-color: 	#DAA520; color: black">
                            <h4><strong>NIM sudah terdaftar. Silakan masukkan NIM lain.</strong></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="color: black; border: 1px solid black; border-color: yellow" data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal Nim 15 -->
        <div class="modal fade" id="nim_15" tabindex="-1" role="dialog" aria-labelledby="nim sama" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="background-color: 	#DAA520; color: black">
                        <h4><strong>NIM harus berjumlah 15 digit.</strong></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="color: black; border: 1px solid black; border-color: yellow" data-dismiss="modal">Kembali</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal Nama Sama -->
        <div class="modal fade" id="nama_sama" tabindex="-1" role="dialog" aria-labelledby="nama sama" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="background-color:	#DAA520; color: black">
                        <h4><strong>Nama sudah terdaftar. Silakan masukkan Nama lain.</strong></h4>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="color: black; border: 1px solid black; border-color: yellow" data-dismiss="modal">Kembali</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>        

        <!-- modal Pilih Kelas -->
        <div class="modal fade" id="kelas_kosong" tabindex="-1" role="dialog" aria-labelledby="kelas_kosong" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="background-color: 	#DAA520; color: black">
                        <h4><strong>Harap memilih kelas terlebih dahulu.</strong></h4>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="color: black; border: 1px solid black; border-color: yellow" data-dismiss="modal">Kembali</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>    
        
        <?php include "footer.php"; ?>
    </body>
</html>