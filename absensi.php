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
            <table class="table table-bordered">
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
                        JOIN kelas AS kls ON mhw.id_kelas = kls.id_kelas
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