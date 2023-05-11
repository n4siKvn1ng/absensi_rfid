<?php
	include "koneksi.php";
	$nokartu = $_GET['nokartu'];
	$lab = substr($nokartu,-1);
	$nokartu = substr($nokartu,0,15);

	mysqli_query($konek, "delete from tmprfidscan");
	//simpan nomor kartu yang baru ke tabel tmprfid
	$simpan = mysqli_query($konek, "insert into tmprfidscan(nokartu, no_lab)values('$nokartu', '$lab')");
	if($simpan)
		echo "AbsenDiTerima";
		
 ?>