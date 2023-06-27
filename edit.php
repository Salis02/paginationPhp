<?php

//koneksi ke DBMS

require "function.php";

//ambil data di url

$id = $_GET["id"];

//query data karyawan berdasarkan id nya

$krywan = query("SELECT * FROM karyawan WHERE id = $id")[0];


//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])){

    //cek apakah data berhasil diedit?
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diedit');
                document.location.href='PHPMysql.php';
            </script>
            ";
        }else{
            echo "
            
            <script>
                alert('Data gagal diedit');
                document.location.href='PHPMysql.php';
            </script>
            ";
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit Data</title>
  </head>
  <body>
    <div class="container">
        <h1>Edit Data Karyawan</h1>
    
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $krywan["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $krywan["gambar"]; ?>">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Nama Karyawan" name="nama" required value="<?= $krywan["nama"]; ?>">
                <label for="floatingInput">Nama Karyawan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingJabatan" placeholder="Jabatan" name="jabatan" required value="<?= $krywan["jabatan"]; ?>">
                <label for="floatingJabatan">Jabatan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" placeholder="Email" name="email" required value="<?= $krywan["email"]; ?>">
                <label for="floatingEmail">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingHobi" placeholder="floatingHobi" name="hobi" required value="<?= $krywan["hobi"]; ?>">
                <label for="floatingHobi">Hobi</label>
            </div>
            <div class="form-floating mb-3">
                <label for="floatingGambar">Gambar</label>
                <img src="img/<?= $mhs["gambar"] ;?>" alt="">
                <input type="file" class="form-control" id="floatingGambar" placeholder="floatingGambar" name="gambar">
            </div>
            <button class="btn btn-outline-success" type="submit" name="submit">Submit</button>
        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>