<?php
include "../connection.php";
include "../session.php";

    $code = $_SESSION['usercode'];

    $sql = "SELECT * FROM user WHERE user_code = '$code' ";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../stylegen.css">
    <style>
        .profil{
            background-color: white;
            color: #5E4DAB;
            border-radius: 10px;
        }
        .accounticon{
            display: flex;
            justify-content: center;
        }
        .tombol{
            margin: 20px;
        }
        .tombol a{
            color: white;
            background-color: #5E4DAB;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body style="width:100%; height:100vh; display: flex; justify-content: center; align-items: center;">
    <div class="profil">
        <div class="container">
            <div class="container2">
                <div class="accounticon">
                    <span class="material-symbols-outlined" style="font-size:70px; color: #5E4DAB;" >account_circle</span>
                </div>
            </div>
            <div class="desc">
            <h1 style="color: #5E4DAB; text-align: center; margin-bottom: 20px;">Account</h1>
                <table class="tblprofile" style="color: #5E4DAB; padding: 0 30px; margin-bottom: 30px;">
                <tr>
                    <td>Nama</td><td>:</td><td><?= $row['nama']?></td>
                </tr>
                <tr>
                    <td>Email</td><td>:</td><td><?= $row['email'] ?></td>
                </tr>
                <tr>
                    <td>Phone</td><td>:</td><td><?= $row['nohp'] ?></td>
                </tr>
                <tr>
                    <td>Alamat</td><td>:</td><td><?= $row['alamat'] ?></td>
                </tr>
                </table>
            </div>
            <div class="tombol" style="text-align: center;">
                <!-- <a href="editUser.php" class="tmbl ubah">Ubah</a> -->
                <a href="../logout.php" class="tmbl" >Logout</a>
            </div>
        </div>
    </div>
</body>
</html>