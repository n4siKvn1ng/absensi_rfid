<?php
	include "koneksi.php";
	$cari = mysqli_query($konek, "SELECT * FROM `kirimdata`");
    $hasil = mysqli_fetch_array($cari);
	
	if($hasil != null){
		// data nomor kartu ada di variabel "nim" di bawah ini ya
		$nim = $hasil['nokartu'];
		echo $nim; // untuk echo nomor kartu ada di bagian ini ya
	}else{
		echo "Gagal";
	}
	sleep(15);
  	mysqli_query($konek, "DELETE FROM `kirimdata`");
 ?>