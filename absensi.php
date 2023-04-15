<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Rekapitulasi Absensi</title>
       <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php include "menu.php"; ?>

        <!-- isi -->
        <div class="container-fluid">
            <h3>Rekap Absensi</h3>

            
            <div class="table-header" style="display: inline-block;">
            <label for="id_kelas">Pilih Kelas</label><br>
            <select name="id_kelas" id="id_kelas" style="width: 250px; height: 32px;" required>
                <option value="">- Pilih Kelas -</option>
                    <?php include "koneksi.php";
                        $filter = mysqli_query($konek, "SELECT * FROM kelas");
                        while($data = mysqli_fetch_array($filter)){
                        echo "<option value='$data[id_kelas]'>$data[kelas_praktikum]</option>";
                    }
                    ?>
            </select>
            </div>

            <div class="table-header" style="display: inline-block; margin-left: 5px;">
            <label for="hari">Pilih Hari</label><br>
                <select name="hari" id="hari" style="width: 250px; height: 32px;" required>
                    <option value="">- Pilih Hari -</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <button id="resetButton" style="display: none;">Reset</button>

            <script>
                const selectKelas = document.getElementById('id_kelas');
                const selectHari = document.getElementById('hari');
                const resetButton = document.getElementById('resetButton');

                // Tambahkan event listener untuk menangkap perubahan nilai pada select
                selectKelas.addEventListener('change', () => {
                    resetButton.style.display = 'inline-block';
                });

                selectHari.addEventListener('change', () => {
                    resetButton.style.display = 'inline-block';
                });

                // Tambahkan event listener untuk tombol batal
                resetButton.addEventListener('click', () => {
                    selectKelas.value = '';
                    selectHari.value = '';
                    resetButton.style.display = 'none';
                });
            </script>




            <table class="table table-bordered" style="margin-top: 20px">
                <thead>
                    <tr style="background-color: grey; color:white; height:100%;">
                        <th style="width: 10px; text-align: center">No.</th>
                        <th style="width: 175px; text-align: center">NIM</th>
                        <th style="width: 300px; text-align: center">NAMA</th>
                        <th style="width: 250px; text-align:center">KELAS PRAKTIKUM</th>
                        <th style="width: 40px; text-align: center">TANGGAL</th>
                        <th style="width: 30px; text-align: center">JAM ABSENSI</th>
                        <th style="width: 150px; text-align: center">KETERANGAN</th>

                    </tr>
                </thead>
                <tbody>
                <?php 
                        include "koneksi.php";

                        // baca tabel absensi dan relasikan dengan tabel mahasiswa berdasarkan nomor kartu RFID untuk tanggal hari ini
                        // baca tanggal saat ini
                        date_default_timezone_set('Asia/Jakarta');
                        $tanggal = date('Y-m-d');
                        $tanggal_formatted = date('d-m-Y', strtotime($tanggal));

                        // filter absensi berdasarkan tanggal saat ini
                        $sql = mysqli_query($konek, "SELECT mhw.nama, absen.nokartu, kls.kelas_praktikum, absen.tanggal, absen.jam_absensi, absen.keterangan 
                        FROM absensi AS absen
                        JOIN mahasiswa AS mhw ON absen.nokartu = mhw.nokartu
                        JOIN kelas AS kls ON absen.id_kelas = kls.id_kelas
                        WHERE absen.tanggal = '$tanggal'");

                        $no = 0;
                        while($data = mysqli_fetch_array($sql))
                        { 
                            $no++;

                             // konversi hari ke dalam Bahasa Indonesia
                            switch(date('l', strtotime($data['tanggal'])))
                            {
                                case 'Monday':
                                    $hari = 'Senin';
                                    break;
                                case 'Tuesday':
                                    $hari = 'Selasa';
                                    break;
                                case 'Wednesday':
                                    $hari = 'Rabu';
                                    break;
                                case 'Thursday':
                                    $hari = 'Kamis';
                                    break;
                                case 'Friday':
                                    $hari = 'Jumat';
                                    break;
                                case 'Saturday':
                                    $hari = 'Sabtu';
                                    break;
                                case 'Sunday':
                                    $hari = 'Minggu';
                                    break;
                                default:
                                    $hari = '';
                                    break;
                            }

                    ?>
                    <tr> <!-- Ini beberapa database di bawah ini kalau emang bisa mengambil data dari database yang ada kamu ubah aja, soalnya aku ga paham logic database yang berbeda, data di bawah ini aku ambil dari database absensi -->
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['nokartu'] ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td style="text-align: center;"><?php echo $data['kelas_praktikum'] ?></td>
                        <td style="text-align: center;"><?php echo "$hari, $tanggal_formatted;" ?></td>
                        <td style="text-align: center;"><?php echo $data['jam_absensi'] ?></td>
                        <td style="text-align: center;"><?php echo $data['keterangan'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php include "footer.php"; ?>
    </body>
</html>
