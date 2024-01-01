<?php
include "../function.php";
if (isset($_GET['code'])) {
    $code = $_GET['code'];
// $code ="DG002";

    $sql = "DELETE FROM diagnosis WHERE history_code = '$code'";
    $berhasil = mysqli_query($connection,$sql);

    if ($berhasil === true) {
        echo "<script>alert('Data Berhasil Dihapus');</script>";
        echo "<script>window.location='admin.php?page=riwayat.php';</script>";
    }else {
        echo "Data Gagal Dihapus ".mysqli_error($connection)." ";
        echo "<script>window.location='admin.php?page=riwayat.php';</script>";
    }
} else {
    header("Location: riwayat.php");
    exit;
}
?>