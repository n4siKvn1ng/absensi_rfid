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

                        // filter absensi berdasarkan tanggal saat ini
                        $sql = mysqli_query($konek, "select b.nama, a.nokartu, a.nama, a.id_kelas, a.tanggal, a.jam_absensi, a.keterangan from absensi a, mahasiswa b where a.nokartu=b.nokartu and a.tanggal='$tanggal'");

                        $no = 0;
                        while($data = mysqli_fetch_array($sql))
                        {
                            $no++;

                    ?>
                    <tr> <!-- Ini beberapa database di bawah ini kalau emang bisa mengambil data dari database yang ada kamu ubah aja, soalnya aku ga paham logic database yang berbeda, data di bawah ini aku ambil dari database absensi -->
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['nokartu'] ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $data['id_kelas'] ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['jam_absensi'] ?></td>
                        <td><?php echo $data['keterangan'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php include "footer.php"; ?>
    </body>
</html>