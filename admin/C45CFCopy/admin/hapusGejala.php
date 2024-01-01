<?php
include "../function.php";

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    // $code ="G029";
    $sql = "DELETE FROM symptom WHERE symptom_code = '$code'";
    $berhasil = mysqli_query($connection,$sql);

    if ($berhasil === true) {
        echo "<script>alert('Data Berhasil Dihapus');</script>";
        echo "<script>window.location='admin.php?page=gejala.php';</script>";
    }else {
        echo "Data Gagal Dihapus ".mysqli_error($connection)." ";
        echo "<script>window.location='admin.php?page=gejala.php';</script>";
    }
}else {
    header("Location: gejala.php");
    exit;
}


    
?>