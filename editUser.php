<?php
    include "connection.php";
    include "function.php";
    include "session.php";
    $code = $_SESSION['user_code'];

    if (isset($_POST['edit'])) {
        $nama       = filtering($_POST['username']);
        $email   = $_POST['email'];
        $phone   = $_POST['nohp'];
        $alamat   = filtering($_POST['alamat']);
    
        $sqledit = "UPDATE `user` SET `nama` = '$nama', `email` = '$email', `nohp` = '$phone', `alamat` = '$alamat'  WHERE `user`.`user_code` = '$code'";
        $berhasil = mysqli_query($connection,$sqledit);
    
        if ($berhasil === true) {
            echo "<script>alert('Data Berhasil Diedit');</script>";
            echo "<script>window.location='profil.php';</script>";
        }else {
            echo "Data Gagal Diedit ".mysqli_error($connection)." ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Form</title>
    <style>
        
        body{
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(0deg, #974EC2 14.05%, #D3BEF0 97%);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .gambar{
            display: flex;
            align-items: center;
            background-color: white;
        }
        .container{
            background-color: #5E4DAB;
            display:  inline-flex;
            border-radius: 20px;
        }
        .isi {
            display: inline;
            width: 350px;
            height: auto;
        }
        form{
            display: grid;
            padding: 20px;
        }
        input,button{
            border: none;
            padding: 2px;
            border-radius: 5px;
            margin-bottom: 20px;
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="gambar">
        <img src="image/manggis.jpg" alt="Gambar Manggis" width="400px" height="400px">
        </div>
        <?php
            $sql = "SELECT * FROM `user` WHERE user_code = '$code';";
            $hasil = mysqli_query($connection,$sql);
            $row   = mysqli_fetch_assoc($hasil);
        ?>
        <div class="isi">
            <form action="" method="post">
                <h1 style="margin: 0px 0px 20px 0px; color: white;">Ubah data:</h1>
                <input type="text" name="username" id="username" value="<?= $row['nama'] ?>" placeholder="Your Name">           
                <input type="email" name="email" id="email" value="<?= $row['email'] ?>" placeholder="Your E-mail">
                <input type="text" name="nohp" id="nohp" value="<?= $row['nohp'] ?>" placeholder="Phone Number">
                <input type="text" name="alamat" id="alamat" value="<?= $row['alamat'] ?>" placeholder="Your Address">
                <button type="submit" name="edit">Ubah</button>
            </form>
        </div>
    </div>
    <?php


    ?>

</body>
</html>