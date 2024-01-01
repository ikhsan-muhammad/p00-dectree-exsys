<?php
include "connection.php";
include "function.php";

if (isset($_POST['register'])) {
    if (registrasi($_POST)>0) {
        echo "<script>window.location='login.php';</script>";
    }else {
        echo mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up Form</title>
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
        <div class="isi">
            <form action="" method="post">
                <h1 style="margin: 0px 0px 20px 0px; color: white;">Sign up:</h1>
                <input type="text" name="username" id="username" placeholder="Your Name">           
                <input type="email" name="email" id="email" placeholder="Your E-mail">
                <input type="text" name="nohp" id="nohp" placeholder="Phone Number">
                <input type="text" name="alamat" id="alamat" placeholder="Your Address">
                <input type="password" name="pass" id="pass" placeholder="Your Password">
                <input type="password" name="pass2" id="pass2" placeholder="Your Password Again">
                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </div>
    <?php


    ?>

</body>
</html>