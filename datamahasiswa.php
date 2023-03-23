<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Data Mahasiswa</title>
       <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <?php include "menu.php"; ?>

        <!--ISI-->
        
        
        <div class="container-fluid" style="width:100%;">
            <h3>Data Mahasiswa</h3>

                        
                        <!-- tombol tambah data mahasiswa -->
                        <div class="table-header" style="float: right;">
                        <a href="tambah.php"><button class="btn btn-primary"> Tambah Data Mahasiswa</button></a>
                        </div>

                        <div style="clear: both;"></div>

            <table class="table table-bordered" style="margin-top: 10px">
            <thead>
                <tr style="background-color: grey; color: white; height:100%;">
                    <th style="width: 10px; text-align: center" >No.</th>
                    <th style="width: 200px; text-align: center">No. Kartu</th>
                    <th style="width: 300px; text-align: center">NIM</th>
                    <th style="width: 300px; text-align: center">NAMA</th>
                    <th style="width: 7.3%; text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    // koneksi ke database
                    include "koneksi.php";

                    // baca data mahasiswa
                    $sql = mysqli_query($konek, "select * from mahasiswa");
                    $no = 0;
                    while($data = mysqli_fetch_array($sql))
                    {
                        $no++;
                ?>

                <tr>
                    <td style="text-align: center"> <?php echo $no; ?> </td>
                    <td> <?php echo $data['nokartu']; ?> </td>
                    <td> <?php echo $data['nim']; ?> </td>
                    <td> <?php echo $data['nama']; ?> </td>
                    
                    
                    <td>
                        <a href="edit.php?id=<?php echo $data['id']; ?>" ><button class="btn btn-success" style="width:70x;">Edit</button>
                        </a> <a href="hapus.php?id=<?php echo $data['id']; ?>" ><button class="btn btn-danger" style="width:65px;">Hapus</button></a>
                       
                    </td>
                </tr>

                <?php } ?>
            </tbody>
            </table>

        </div>
       
       
        
    </body>

    <?php include "footer.php";  ?>
   
</html> 

