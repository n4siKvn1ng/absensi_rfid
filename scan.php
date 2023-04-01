<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Scan Kartu</title>
       <link rel="stylesheet" type="text/css" href="style.css">

       <!-- scanning membaca kartu RFID -->
       <script type="text/javascript">
            $(document).ready(function(){
                setInterval(function(){
                    $("#cekkartu").load('bacakartu.php') // atasi ini ya faizal, ada hubungannya dengan #nokartu di menu tambah. Kalau emang ga ada masalah berarti aman.
                }, 1000);
            });
       </script>
    </head>
    <body>
        <?php include "menu.php"; ?>


        <!-- isi -->
        <div class="container-fluid">
            <div id="cekkartu"></div>
        </div>

        <?php include "footer.php"; ?>
    </body>
</html>