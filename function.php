<?php
    //koneksi ke database
    //kita gunakan function php mysqli_connect
    $koneksi = mysqli_connect("localhost","root","","karyawan");

    //query data dalam DBMS
    function query($query){
        global $koneksi;
        $result = mysqli_query($koneksi, $query); 
        $rows=[];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    //MENAMBAH DATA BARU
    function tambah($dataBaru){
        global $koneksi;
        //ambil data dari tiap elemen dalam form
        $nama = htmlspecialchars( $dataBaru["nama"]); //htmlspecialchars berfungsi untuk mencegah inputan html
        $jabatan =htmlspecialchars($dataBaru["jabatan"]) ;
        $email = htmlspecialchars($dataBaru["email"]) ;
        $hobi = htmlspecialchars($dataBaru["hobi"]);
    
        //upload gambar
        $gambar = upload();
        if (!$gambar) {
            return false;
        }

        //query insert data
        $query = "INSERT INTO karyawan VALUES ('','$nama','$jabatan','$email','$hobi','$gambar')";
        
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows(($koneksi));
    }

    //FUNCTION UPLOAD
    function upload(){
        
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        //cek apakah tidak ada gambar yang diupload
        if($error === 4){
            echo"
              <script>
                confirm('Upload gambar terlebih dahulu')
              </script>  
            ";
            return false;
        }

        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid=['jpg','jpeg','png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo"
            <script>
              alert('Anda tidak mengupload gambar yang valid')
            </script>  
          "; 
          return false;
        }

        //cek apakah ukurannya terlalu besar
        if ($ukuranFile > 1000000) {
            echo"
              <script>
                confirm('Ukuran gambar terlalu besar');
              </script>  
            ";
            return false;
        }

        //lolos pengecekan, gambar siap diupload
        //generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

        return $namaFileBaru;


    }


    //MENGHAPUS DATA YANG SUDAH ADA
    function hapus($id){
        global $koneksi;
        mysqli_query($koneksi, "DELETE FROM karyawan WHERE id = $id");
        return mysqli_affected_rows($koneksi);
    }

    //MENGEDIT DATA
    function ubah($dataBaru){
        global $koneksi;
        $id = $dataBaru["id"];
        //ambil data dari tiap elemen dalam form
        $nama = htmlspecialchars( $dataBaru["nama"]); //htmlspecialchars berfungsi untuk mencegah inputan html
        $jabatan =htmlspecialchars($dataBaru["jabatan"]) ;
        $email = htmlspecialchars($dataBaru["email"]) ;
        $hobi = htmlspecialchars($dataBaru["hobi"]);
        $gambarLama = htmlspecialchars($dataBaru["gambarLama"]);

        //cek apakah user pilih gambar baru atau tidak
        if ($_POST['gambar']['error']=== 4) {
            $gambar = $gambarLama;
        }else {
            $gambar = upload();
        }

        $gambar = htmlspecialchars($dataBaru["gambar"]);
    
        //query insert data
        $query = "UPDATE karyawan SET 
                    nama = '$nama',
                    jabatan = '$jabatan',
                    email = '$email',
                    hobi = '$hobi',
                    gambar = '$gambar'
                    WHERE id = $id;
                    ";
        
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows(($koneksi));
    }

    //FUNCTION CARI
    function cari($keyword){
        $query = "SELECT * FROM karyawan
                    WHERE
                    nama LIKE '%$keyword%' OR
                    jabatan LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' OR
                    hobi LIKE '%$keyword%'
                    ";
        return query($query);
    }

    //FUNCTION REGISTER
    function registrasi($dataBaru){
        global $koneksi;

        $username = strtolower(stripslashes($dataBaru["username"]));
        $password = mysqli_real_escape_string($koneksi, $dataBaru["password"]) ;
        $password1 = mysqli_real_escape_string($koneksi, $dataBaru["password1"]);
        
        //cek username sudah ada apa belum
        $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)){
            echo "
                <script>
                    alert('Username sudah ada');
                    alert('Silakan ganti username Anda');
                </script>
            ";
            return false;
        }

        //cek konfirmasi password
        if($password !== $password1){
            echo "
                <script>
                    alert('Password tidak sama')
                </script>
            ";
            return false;
        }
        
        //enkripsi password

        $password = password_hash($password, PASSWORD_DEFAULT);

        //tambahkan user baru ke database
        mysqli_query($koneksi, "INSERT INTO user VALUES ('','$username','$password')");

        return mysqli_affected_rows($koneksi);

    }
?>

