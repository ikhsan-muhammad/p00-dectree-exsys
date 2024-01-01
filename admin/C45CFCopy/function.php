<?php
include "connection.php";

function filtering($data){
    $filter = stripslashes(strip_tags(htmlentities(htmlspecialchars($data, ENT_QUOTES))));
    return $filter;
}

function is_email_valid($email) {
    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", trim($email))){
        return TRUE;
    }
    return FALSE;
}

function registrasi($data2){
    global $connection;

    $nama     = filtering($data2['username']);
    $email    = $data2['email'];
    $phone    = $data2['nohp'];
    $alamat   = filtering($data2['alamat']);
    $password1= mysqli_real_escape_string($connection,$data2['pass']);
    $password2= mysqli_real_escape_string($connection,$data2['pass2']);

    $cari = mysqli_query($connection, "SELECT email  FROM user WHERE email='$email'");

    if (mysqli_fetch_assoc($cari)) {
        echo "<script> alert('User Sudah Ada !!') </script>";
        return false;
    }

    if(!is_email_valid($email)){
        echo "<script> alert('Masukkan E-mail yang Valid !!') </script>";
        return false;
    }

    if ($password1 !== $password2) {
        echo "<script> alert('Konfirmasi Password Berbeda !!') </script>";
        return false;
    }

    $password = password_hash($password1, PASSWORD_DEFAULT);
    
    //kode user
    $kami = "SELECT user_code FROM `user` WHERE user_code IN (SELECT MAX(user_code) FROM `user` WHERE user.sebagai = 'user')";
    $kamis = mysqli_fetch_assoc(mysqli_query($connection,$kami));
    if (empty($kamis['user_code'])) {
        $kamis['user_code'] = "U001";
    }
    $urutan = (int) substr($kamis['user_code'], 2, 3);

    $urutan++;

    $huruf = "U";
    $user_code = $huruf . sprintf("%03s", $urutan);

    mysqli_query($connection, "INSERT INTO user VALUES ('$user_code','$nama','$email','$phone','$alamat','user','$password')");
    
    return mysqli_affected_rows($connection);
}

function indexchanger ($array1, $array2){
    $result = array();
    for ($i=0; $i<count($array2); $i++){
        $result[$array2[$i]] = $array1[$i];
    }

    $array1 = $result;
    return $array1;
}
?>