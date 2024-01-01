<?php
include "../function.php";

    if (isset($_POST['tambah'])) {
        $nama = filtering($_POST['nama']);
        $email = $_POST['email'];
        $phone   = $_POST['phone'];
        $alamat = filtering($_POST['alamat']);
        $password1= mysqli_real_escape_string($connection,$_POST['pass1']);
        $password2= mysqli_real_escape_string($connection,$_POST['pass2']);

    $cari = mysqli_query($connection, "SELECT email  FROM user WHERE email='$email'");

    if (mysqli_fetch_assoc($cari)) {
        echo '<script type="text/javascript">alert("UserAdmin Sudah Ada !!");window.location="admin.php?page=tambahUser.php";</script>';
        exit;
    }

    if(!is_email_valid($email)){
        echo '<script type="text/javascript">alert("Masukkan Email yang Valid !!");window.location="admin.php?page=tambahUser.php";</script>';
        exit;
    }

    if ($password1 !== $password2) {
        echo '<script type="text/javascript">alert("Konfirmasi Password Berbeda !!");window.location="admin.php?page=tambahUser.php";</script>';
        exit;
    }

    $password = password_hash($password1, PASSWORD_DEFAULT);
        //Code Penyakit
        $ur = "SELECT user_code FROM `user` WHERE user_code IN (SELECT MAX(user_code) FROM `user` WHERE user.sebagai = 'admin')";
        $urut = mysqli_fetch_assoc(mysqli_query($connection,$ur));
        if (empty($urut['user_code'])) {
            $urut['user_code'] = "A000";
        }
        $urutan = (int) substr($urut['user_code'], 2, 3);

        $urutan++;
        echo $urutan;
        $huruf = "A";
        $user_code = $huruf . sprintf("%03s", $urutan);
        $admin = "admin";

            //Memasukkan Data
            $tamplate = $connection->prepare("INSERT INTO user (user_code,nama,email,nohp,alamat,sebagai,password) VALUES (?, ?, ?, ?, ?, ?, ?)");

            $tamplate->bind_param("sssssss", $user_code, $nama, $email, $phone, $alamat, $admin, $password);
            if ($tamplate->execute()) {
                echo "<script>alert('Data Berhasil Disimpan');</script>";
                echo "<script>window.location='admin.php?page=user.php';</script>";
            }else{
                echo "Data Gagal Disimpan ".mysqli_error($connection)." ";
            }
        
        
    }
?>

            <div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>User/Admin</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
            </div>

            <div class="content">
                <div class="form">
                    <form action="" method="post">
                        <label for="nama">Nama Admin:</label>
                        <input type="text" name="nama" id="nama">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone">
                        <label for="alamat">Alamat:</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="5"></textarea>
                        <label for="pass1">Password:</label>
                        <input type="password" name="pass1" id="pass1">
                        <label for="pass2">Konfirmasi Password:</label>
                        <input type="password" name="pass2" id="pass2">
                        <button type="submit" name="tambah">Tambah Admin</button>
                    </form>
                </div>
            </div>