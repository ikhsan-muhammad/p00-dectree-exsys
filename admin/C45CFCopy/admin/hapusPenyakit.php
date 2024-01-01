<?php
include "../function.php";
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    // $code ="P006";

    $sql = "DELETE FROM disease WHERE disease_code = '$code'";
    $berhasil = mysqli_query($connection,$sql);

    if ($berhasil === true) {
        echo "<script>alert('Data Berhasil Dihapus');</script>";
        echo "<script>window.location='admin.php?page=penyakit.php';</script>";
    }else {
        echo "Data Gagal Dihapus ".mysqli_error($connection)." ";
        echo "<script>window.location='admin.php?page=penyakit.php';</script>";
    }
}else {
    header("Location: penyakit.php");
    exit;
}

?>