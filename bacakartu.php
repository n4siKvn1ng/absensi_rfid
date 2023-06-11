<?php
    include "koneksi.php";
   
    // baca tabel status untuk mode absensi
    $sql = mysqli_query($konek, "SELECT * FROM status");
    $data = mysqli_fetch_array($sql);
    $mode_absen = $data['mode'];

    // uji mode absen
    $mode = "";
    if ($mode_absen == 1) {
        $mode = "Aktif";
    }

    // baca tabel tmprfid
    $baca_kartu = mysqli_query($konek, "SELECT * FROM tmprfidscan");
    $data_kartu = mysqli_fetch_array($baca_kartu);
    $nokartu = "";
    if (!is_null($data_kartu)) {
        $nokartu = $data_kartu['nokartu'];
    }
?>

<div class="container-fluid" style="text-align:center; margin-top: 10%">

    <?php
    // Kondisi pertama: ketika kartu telah masuk di RFID maka kartu akan mengalami verifikasi
    if ($nokartu == '') { ?>
        <div style="margin-top: 5%;">
        <h3>Status Absen : <?php echo $mode; ?> </h3>
        <h3>Silahkan Tempelkan Kartu RFID Anda</h3>
        <img src="images/rfid.png" style="width: 300px"> <br>
        <img src="images/animasi2.gif">
        </div>
<!-- SELECT  -->
    <?php 
    } else {
    
        $cari_mahasiswa = mysqli_query($konek, "SELECT m.*, k.kelas_praktikum, k.jam , k.hari FROM mahasiswa m JOIN kelas k ON m.id_kelas=k.id_kelas WHERE m.nokartu = '$nokartu'");
        $jumlah_data = mysqli_num_rows($cari_mahasiswa);

        if ($jumlah_data == 0) {
            echo "<h1>Maaf, Kartu Tidak Terdaftar</h1>";

        } else {
            // ambil data mahasiswa, kelas_praktikum, dan jam
            date_default_timezone_set('Asia/Jakarta');
            $hari_ini = date('l');
            // tanggal dan jam hari ini
            $tanggal = date('Y-m-d');
            $jam_absen = date('H:i:s');
            
            $data_mahasiswa1 = mysqli_fetch_array($cari_mahasiswa);
            $id_kelas = explode(',', $data_mahasiswa1['id_kelas']);
            $countDt = count($id_kelas);
            $check = false ?? 0;
            $lab_ada = false;
            $hari_kelas ;
            $jam_kelas;
            $data_hari = false;
            $data_jam = false;
            for ($i=0; $i < $countDt ; $i++) : 
                $cari_mahasiswa1 = mysqli_query($konek, "SELECT m.*, k.kelas_praktikum, k.jam , k.hari FROM mahasiswa m JOIN kelas k ON '$id_kelas[$i]'=k.id_kelas WHERE m.nokartu = '$nokartu'");
                $jmlhDt = mysqli_fetch_all($cari_mahasiswa1, MYSQLI_ASSOC);
                //cek di tabel absensi, apakah nomor kartu tersebut sudah ada sesuai tanggal saat ini, apabila sudah ada maka dianggap masuk
                $cari_absen = mysqli_query($konek, "SELECT * FROM absensi WHERE nokartu='$nokartu' and tanggal='$tanggal' and id_kelas='$id_kelas[$i]'");
                 $jumlah_absen = mysqli_num_rows($cari_absen);
                    foreach ($jmlhDt as $getDtMhs) :
                        $nama = $getDtMhs['nama'];
                        $kelas_praktikum = $getDtMhs['kelas_praktikum'];
                        $jam_kelas = $getDtMhs['jam'];
                        $hari_kelas = $getDtMhs['hari'];
                        

                        // mengubah jam kelas menjadi format waktu
                        $jam_kelas = DateTime::createFromFormat('H:i:s', $jam_kelas);
                        $jam_kelas = $jam_kelas->getTimestamp();

                        // menambahkan 110 menit ke jam kelas
                        $jam_kelas_110_menit = strtotime('+110 minutes', $jam_kelas);

                        // jika hari saat ini sama dengan hari kelas, maka bisa melakukan absensi
                
                            $lab_ada = true;
                            if (strtolower($hari_ini) == strtolower($hari_kelas)) {
                                $data_hari = true; 
                                if(time() >= $jam_kelas && time() <= $jam_kelas_110_menit) { 
                                    $data_jam = true;
                                    if($jumlah_absen == 0){
                                        // cek apakah nokartu tersebut terdaftar pada tabel kelas
                                        $cari_kelas = mysqli_query($konek, "SELECT jam FROM kelas WHERE kelas_praktikum='$kelas_praktikum'");
                                        $data_kelas = mysqli_fetch_array($cari_kelas);
                                        $jam_kelas = DateTime::createFromFormat('H:i:s', $data_kelas['jam']);
                                        $jam_kelas = $jam_kelas->getTimestamp();
                        
                                            echo "<h1 >Selamat Datang, $nama.<br>Di Kelas $kelas_praktikum.</h1>";
                                            $waktu_terlambat = strtotime('+15 minutes', $jam_kelas);
                                            if (strtotime($jam_absen) <= $waktu_terlambat) {
                                                $keterangan = '<strong>Tepat Waktu</strong>';
                                            } else {
                                                $durasi_terlambat = round((strtotime($jam_absen) - $waktu_terlambat) / 60);
                                                $keterangan = 'Terlambat - -'.$durasi_terlambat.' menit- -';
                                            }
                                            
                                            mysqli_query($konek, "INSERT into absensi(nokartu, id_kelas, tanggal, jam_absensi, keterangan)values('$nokartu','$id_kelas[$i]', '$tanggal', '$jam_absen', '$keterangan')");
                                            $check = true;
                                    }
                                    else{
                                        echo "<h1>Hai, $nama.<br> Anda sebelumnya telah berhasil melakukan absensi</h1>";
                                        $check = true;
                                        break;
                                    }
                                }else{
                                    $data_jam = false;
                                }
                            }else{
                                $data_hari = false;
                            
                            }
                        
                    endforeach;
                endfor;    
                
            if (!$check) {
                  
                if (!$data_hari) {
                    echo "<h1>Maaf, $nama.<br>Hari ini bukan hari kelas Anda</h1>";
                }
                if(($data_hari == true) && !($data_jam)){
                    echo "<h1>Maaf, $nama.<br>Anda Tidak Memiliki Kelas Pada Saat Ini</h1>";
                }

            }
        }
        //kosongkan tabel tmprfid
        mysqli_query($konek, "DELETE FROM tmprfidscan");
        
    }?>
</div>