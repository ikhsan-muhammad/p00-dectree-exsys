<?php
include "function.php";

session_start();

if (isset($_POST['login'])) {

    $email = $_POST["email"];
    $password = $_POST["pass"];

    $tangkap = mysqli_query($connection,"SELECT * FROM user WHERE email = '$email'");

    if (mysqli_num_rows($tangkap) === 1) {
        
        // cek pasword
        $row = mysqli_fetch_assoc($tangkap);
        if (password_verify($password, $row['password'])) {
            
            //Membuat session
            $_SESSION['login'] = true;
            $_SESSION['usercode'] = $row['user_code'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['user_code'] = $row['user_code'];
            $_SESSION['sebagai'] = $row['sebagai'];
            //mengarah ke index page
            if ($_SESSION['sebagai'] === "user") {
                header("Location: index.php");
                exit;
            }elseif ($_SESSION['sebagai'] === "pakar") {
                header("Location: admin/admin.php");
                exit;
            }else {
                header("Location: admin/admin.php");
                exit;
            }
            
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in Form</title>
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
        h1{
            margin-bottom: 20px;
        }
        .gambar{
            display: flex;
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
            margin-top: 50px;
            display: grid;
            padding: 20px;
        }
        input,button{
            border: none;
            padding: 5px;
            border-radius: 5px;
            margin: 10px 0px;
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="gambar">
        <img src="image/manggis.jpg" alt="Gambar Manggis" width="400px" height="auto">
        </div>
        <div class="isi">
            <form action="" method="post">
                <h1 style="color: white;">Sign in:</h1>
                <?php
                    if (isset($error)) {
                        echo "<P style='color:red;font-size:14px;'>E-mail/Password Salah,Sign-up/cobalagi</P>";
                    }
                ?>
                <input type="email" name="email" id="email" placeholder=" E-mail">
                <input type="password" name="pass" id="pass" placeholder=" Password">
                <button type="submit" name="login">Login</button>
                <p style="text-align: center; font-size: 16px; color: white;">Tidak punya akun?<a href="registrasi.php"><strong style="color: yellow;">Buat akun</strong></a></p>
            </form>
        </div>
    </div>
</body>
</html>