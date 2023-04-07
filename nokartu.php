<?php
    include "koneksi.php";

    //saya menggunakan pengkodisian dikarenakan mencegah tampilan error pada website dikarenakan data dianggap null

    //Baca isi tabel tmprfid
$sql = mysqli_query($konek, "SELECT * from `tmprfiddaftar` ");
if (mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_array($sql);
    //Membaca No Kartu
    $nokartu = $data['nokartu'];
} else {
    $nokartu = ""; // Atau bisa juga menggunakan nilai default lainnya
    echo "<strong><font style=color: red>Kolom No. Kartu tidak boleh kosong.</font></strong>"; // Tampilkan pesan jika data tidak ditemukan
}
?>
 
 <!--INPUTAN UNTUK NOMOR KARTU-->
 <div class="form-group">
        <label>No. Kartu</label>
        <input type="text" name="nokartu" id="nokartu" placeholder="Tempelkan kartu RFID" class="form-control" style="width: 200px"
        value="<?php echo $nokartu;?>" >
</div>

