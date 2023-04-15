<?php
    include "koneksi.php";

    //saya menggunakan pengkodisian dikarenakan mencegah tampilan error pada website dikarenakan data dianggap null

    //Baca isi tabel tmprfid
$sql = mysqli_query($konek, "SELECT * from tmprfiddaftar ");
if (mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_array($sql);
    //Membaca No Kartu
    $nokartu = $data['nokartu'];
} 
?>
<!-- INPUTAN UNTUK NOMOR KARTU -->
<div class="form-group">
    <label>Nomor Induk Mahasiswa (NIM)</label>
    <?php
    $sql = mysqli_query($konek, "SELECT * from `tmprfiddaftar` ");
    if (mysqli_num_rows($sql) >= 0) {
        $data = mysqli_fetch_array($sql);
        if (empty($data['nokartu'])) {
            ?>
            <div class="input-group">
                <input type="text" name="nokartu" id="nokartu" placeholder="Harap Menempelkan Kartu" class="form-control" style="width: 250px" required >
            </div>
            <?php
        } else {
            ?>
            <div class="input-group">
                <input type="text" name="nokartu" id="nokartu" placeholder="Ubah No. Kartu sesuai NIM" class="form-control" style="width: 250px" required value="<?php echo $data['nokartu']; ?>">
            </div>
            <?php
        }
    }
    ?>
</div>
