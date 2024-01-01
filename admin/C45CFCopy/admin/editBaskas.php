<?php
include "../function.php";
if (isset($_GET['code'])) {
    $code = $_GET['code'];

if (isset($_POST['edit'])) {;
    $baskas   = $_POST['baskas'];

    $sqledit = "UPDATE `disease` SET `base_symptom` = '$baskas' WHERE `disease`.`disease_code` = '$code'";
    $berhasil = mysqli_query($connection,$sqledit);

    if ($berhasil === true) {
        echo "<script>alert('Data Berhasil Diedit');</script>";
        echo "<script>window.location='admin.php?page=baskas.php';</script>";
    }else {
        echo "Data Gagal Diedit ".mysqli_error($connection)." ";
    }
}
} else {
    header("Location: baskas.php");
}


?>

            <div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>Basis Kasus</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
            </div>

            <?php
            $sql = "SELECT * FROM `disease` WHERE disease_code = '$code';";
            $hasil = mysqli_query($connection,$sql);
            $row   = mysqli_fetch_assoc($hasil);
            ?>

            <div class="content">
            <div class="text"><p style="color:red; font-style: italic; margin-bottom: 5px;">** Masukkan Kode Gejala Baru dengan Tanda ',' (koma) sebagai pemisah </p></div>
                <div class="form">
                    <form action="" method="post">
                        <label for="baskas">Penanganan Penyakit:</label>
                        <textarea name="baskas" id="baskas" cols="30" rows="5"><?= $row['base_symptom'] ?></textarea>
                        <button type="submit" name="edit">Edit</button>
                    </form>
                </div>
            </div>