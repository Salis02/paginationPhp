<?php

require 'function.php';
    // cek apakah tombol login sudah ditekan?
    if(isset($_POST["login"])){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

        //cek username
        if(mysqli_num_rows($result) === 1){

        //cek password

            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"]) ){
                header("Location: index.php");
                exit; //supaya berhenti sampai header
            };

        }

        $error = true;

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

    <title>Login</title>
  </head>
  <body>
    <div class="container">
        <h1 class="h1 text-align-center" >LOGIN</h1>
        <?php if(isset($error)) : ?>
        <p style="color:red;" >Username/password salah</p>
        <?php endif; ?>
        <form action="" method="post" >
        <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" required autocomplete="off">
                <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput" placeholder="Password" name="password" required autocomplete="off">
                <label for="floatingInput">Password</label>
    </div>
    <button class="btn btn-success" type="submit" name="login" >Login</button>
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