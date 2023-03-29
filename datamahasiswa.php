<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Data Mahasiswa</title>
       <link rel="stylesheet" type="text/css" href="style.css">
       <style>
        #hapusTeks {
            display: none;
        }
        <?php
        if(isset($_GET['q']) && $_GET['q'] != '') {
            echo '#hapusTeks { display: block; }';
        } else {
            echo '#hapusTeks { display: none; }';
        }
        ?>
    </style>
    </head>
    <body>

        <?php include "menu.php"; ?>
        
        

        <!--ISI-->
        
        
        <div class="container-fluid" style="width:100%;">
            <h3>Data Mahasiswa</h3>

            
            <!-- form pencarian -->
            <div class="table-header" style="float: left; margin-right: 0;">
                <form method="GET" action="" class="form-inline">
                    <div class="input-group">
                        <label for="inputSearch" class="sr-only">Cari:</label>
                            <input type="text" class="form-control" id="inputSearch" name="q" placeholder="Masukkan kata kunci" style="width: 400px"
                            value="<?php echo isset($_GET['q']) ? $_GET['q'] : '' ?>">
                                <div class="input-group-addon">
                                <span id="hapusTeks" style="cursor: pointer;">X</span>
                                </div>
                        </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

                <script>
                    
                document.getElementById("inputSearch").addEventListener("input", function() {
                    if (this.value !== "") {
                    document.getElementById("hapusTeks").style.display = "block";
                    } else {
                    document.getElementById("hapusTeks").style.display = "none";
                    }
                });
                
                document.getElementById("hapusTeks").addEventListener("click", function() {
                    document.getElementById("inputSearch").value = "";
                    this.style.display = "none";
                    document.querySelector('form').submit();
                });
                </script>


                        
                        <!-- tombol tambah data mahasiswa -->
                        <div class="table-header" style="float: right;">
                            <a href="tambah.php"><button class="btn btn-primary"> Tambah Data Mahasiswa</button></a>
                        </div>

                        <div style="clear: both;"></div>

                        <table class="table table-bordered" style="margin-top: 10px; ">

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

        // cek apakah ada data yang dicari
        if(isset($_GET['q']) && $_GET['q'] != '') {
            $keyword = $_GET['q'];
            // query pencarian data mahasiswa
            $sql = mysqli_query($konek, "SELECT * FROM mahasiswa WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%'");
        } else {
            // query menampilkan seluruh data mahasiswa
            $sql = mysqli_query($konek, "SELECT * FROM mahasiswa");
        }

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
                <a href="edit.php?id=<?php echo $data['id']; ?>" ><button class="btn btn-success" style="width:70x;">Edit</button></a>
                <a href="hapus.php?id=<?php echo $data['id']; ?>" ><button class="btn btn-danger" style="width:65px;">Hapus</button></a>
            </td>
        </tr>

        <?php } ?>

            </tbody>
            </table>

        </div>
       
       
        
    </body>

    <?php include "footer.php"?>
   
</html> 



