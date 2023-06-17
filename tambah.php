<!DOCTYPE html>
<html>

<head>
    <?php include "header.php"; ?>
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="./fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./css/all.min.css">
    <script type="text/javascript" src="./fontawesome-free-6.4.0-web/js/all.min.js"></script>
</head>

<body>
    <?php include "menu.php"; ?>
    <?php include "koneksi.php";
    //baca Data Mahasiswa berdasarkan id
    $cari = mysqli_query($konek, "SELECT * FROM `tmprfiddaftar`");
    $hasil = mysqli_fetch_array($cari);
    $tambah_kelas = mysqli_query($konek, "SELECT * FROM `kelas`");
    $data = mysqli_fetch_array($tambah_kelas);
    ?>

    <!--Pembacaan No Kartu Otomatis-->
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function() {
                $("#tampilnomor").load('nokartu.php')
            }, 0)
        });
    </script>

    <script>
        var nokartuInput = document.getElementById("nokartu");
        nokartuInput.addEventListener("input", function() {
            var value = this.value;
            var numericValue = value.replace(/\D/g, ""); // Menghapus karakter non-angka dari input

            // Jika nilai input tidak berubah setelah menghapus karakter non-angka,
            // berarti input hanya berisi angka yang valid
            if (value !== numericValue) {
                this.value = numericValue; // Memperbarui nilai input dengan nilai numerik yang valid
            }
        });
    </script>
    <!-- isi-->
    <form id="form-mahasiswa" method="POST">
        <!-- form input -->
        <div class="container-fluid">

            <h3>Tambah Data Mahasiswa</h3>

            <!-- INPUTAN UNTUK NOMOR KARTU-->
            <div id="tampilnomor"></div>

            <div class="form-group">
                <label>Nomor Induk Mahasiswa (NIM)</label>
                <div class="input-group">
                    <input type="text" name="nokartu" id="nokartu" placeholder="Ubah No. Kartu sesuai NIM" class="form-control" style="width: 250px; border-radius: 4px;" required>
                </div>
            </div>




            <!--INPUTAN UNTUK NAMA MAHASISWA-->
            <div class="form-group">
                <label>Nama Mahasiswa</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" class="form-control" style="width: 250px" required>

            </div>



            <!-- INPUTAN UNTUK KELAS PRAKTIKUM -->
            <div class="form-group">
                <label for="id_kelas">Kelas Praktikum</label><br>
                <div style="display: flex; justify-content: wrap">
                    <div style="width: 150px">
                        <?php
                        // Query to fetch all "Kelas Praktikum" data from the database
                        $tambah_kelas = mysqli_query($konek, "SELECT * FROM kelas");

                        // Count the total number of data fetched
                        $total_data = mysqli_num_rows($tambah_kelas);

                        // Calculate the number of data to display in the left column
                        $left_data = ceil($total_data / 2);

                        // Counter variable to keep track of the number of iterations
                        $counter = 0;

                        while ($data = mysqli_fetch_array($tambah_kelas)) {
                            if ($counter < $left_data) {
                                // Display checkboxes for the data in the left column
                                echo "<div><input type='checkbox' name='id_kelas[]' value='$data[id_kelas]'>&nbsp;$data[singkatan]</div>";
                            }
                            $counter++;
                        }
                        ?>
                    </div>
                    <div style="width: 150px">
                        <?php
                        // Reset the cursor to the beginning of the query results
                        mysqli_data_seek($tambah_kelas, 0);

                        // Reset the counter variable
                        $counter = 0;

                        while ($data = mysqli_fetch_array($tambah_kelas)) {
                            if ($counter >= $left_data) {
                                // Display checkboxes for the data in the right column
                                echo "<div><input type='checkbox' name='id_kelas[]' value='$data[id_kelas]'>&nbsp;$data[singkatan]</div>";
                            }
                            $counter++;
                        }
                        ?>
                    </div>
                </div>
            </div>



            <script>
                var selectElement = document.getElementById('kelasPraktikum');
                var isCtrlPressed = false;

                selectElement.addEventListener('change', function(e) {
                    if (isCtrlPressed) {
                        var selectedOptions = Array.from(this.selectedOptions);
                        selectedOptions.forEach(function(option) {
                            var checkbox = option.querySelector('input[type="checkbox"]');
                            checkbox.checked = !checkbox.checked;
                        });
                    }
                });

                // Mendeteksi saat tombol Ctrl ditekan atau dilepaskan
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Control') {
                        isCtrlPressed = true;
                    }
                });

                document.addEventListener('keyup', function(e) {
                    if (e.key === 'Control') {
                        isCtrlPressed = false;
                    }
                });
            </script>



            <button class="btn btn-primary" type="submit" name="btnSimpan">Simpan</button>
            <button class="btn btn-warning" name="batal" onclick="location.href='datamahasiswa.php'">Batal</button>
        </div>
    </form>

    <?php include "koneksi.php";
    //kondisi jika tombol simpan diklik
    if (isset($_POST['btnSimpan'])) {
        //baca isi inputan form
        $nokartu    = $_POST['nokartu'];
        $nama       = $_POST['nama'];
        $id_kelas   = implode(",", $_POST['id_kelas']);

        $cek_kelas = mysqli_query($konek, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
        if (empty($id_kelas) || $id_kelas == '0') {
            echo "
                        <script>
                            alert('Kelas praktikum belum dipilih');
                            location.href='tambahmahasiswa.php';
                        </script>";
        } else {
            //validasi inputan id_kelas
            $cek_kelas = mysqli_query($konek, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
            $count_kelas = mysqli_num_rows($cek_kelas);
            if ($count_kelas == 0) {
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
                $cek_nokartu = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE nokartu='$nokartu'");
                $cek_nama = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE nama='$nama'");
                if (mysqli_num_rows($cek_nokartu) > 0) {
                    echo "
                                <script>
                                    $(document).ready(function() {
                                    $('#nim_sama').modal('show');
                                    $('#nokartu').val('$nokartu');
                                    $('#nama').val('$nama');
                                    });
                                </script>
                                ";
                } else if (strlen($nokartu) != 15) {
                    echo "<script>
                            $(document).ready(function() {
                            $('#nim_15').modal('show');
                            $('#nokartu').val('$nokartu');
                            $('#nama').val('$nama');
                            });</script>";
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
                } else if (!is_numeric($nokartu)) {
                    echo "
                                <script>
                                    $(document).ready(function() {
                                    $('#bukan_angka').modal('show');
                                    $('#nokartu').val('$nokartu');
                                    $('#nama').val('$nama');
                                    });
                                </script>
                                ";
                } else {

                    //simpan ke tabel mahasiswa
                    $simpan = mysqli_query($konek, "insert into mahasiswa(nokartu, nama, id_kelas)values('$nokartu', '$nama', '$id_kelas')");
                    // kirim nomor kartu ke tabel kirimdata untuk diproses di adddata.php
                    $insert_data = mysqli_query($konek, "INSERT INTO kirimdata(nokartu) VALUES ('$nokartu')");

                    if ($simpan) {
                        // menghapus nomor kartu dari tabel tmprfid
                        $hapus = mysqli_query($konek, "DELETE FROM `tmprfiddaftar` WHERE 1");
                        echo "
                                <script>
                                    $(document).ready(function() {
                                    $('#pesan_berhasil').modal('show');
                                    });
                                </script>";
                        mysqli_query($konek, "delete from tmprfidscan");
                    } else {
                        echo "
                                <script>
                                    $(document).ready(function() {
                                    $('#pesan_gagal').modal('show');
                                    });
                                </script>";
                    }
                }
            }
        }
    }
    if (isset($_POST['batal'])) {
        echo "
                <script>
                    location.replace('datamahasiswa.php');
                </script>";
    }
    ?>
    <!-- modal Berhasil -->
    <div class="modal fade" id="pesan_berhasil" tabindex="-1" role="dialog" aria-labelledby="pesanberhasilLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 350px; margin-top: 5%;">
            <div class="modal-content">
                <div class="modal-body" style="background-color: green; color: white">
                    <h4><strong>Data Berhasil Tersimpan</strong></h4>
                </div>
                <div class="modal-footer">
                     <h4>Tekan tombol "OKE"</h4>
                     <h4>Lalu tempelkan ulang kartu RFID</h4>
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

    <!-- modal Nim Bukan Angka -->
    <div class="modal fade" id="bukan_angka" tabindex="-1" role="dialog" aria-labelledby="nim sama" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background-color: 	#DAA520; color: black">
                    <h4><strong>NIM harus berupa angka.</strong></h4>
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

    <script>
        document.addEventListener("keyup", function(event) {
            if (event.key === "Enter") {
                document.getElementById("btnSimpan").click();
            }
        });
    </script>

    <?php include "footer.php"; ?>
</body>

</html>
