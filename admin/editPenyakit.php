<?php
include "../function.php";
if (isset($_GET['code'])) {
    $code = $_GET['code'];

if (isset($_POST['edit'])) {
    $nmp       = filtering($_POST['nmp']);
    $desc   = filtering($_POST['desc']);
    $handling   = filtering($_POST['handling']);

    $sqledit = "UPDATE `disease` SET `disease_nm` = '$nmp', `description` = '$desc', `handling` = '$handling'  WHERE `disease`.`disease_code` = '$code'";
    $berhasil = mysqli_query($connection,$sqledit);

    if ($berhasil === true) {
        echo "<script>alert('Data Berhasil Diedit');</script>";
        echo "<script>window.location='admin.php?page=penyakit.php';</script>";
    }else {
        echo "Data Gagal Disimpan ".mysqli_error($connection)." ";
    }
}
} else {
    header("Location: penyakit.php");
    exit;
}




?>

            <div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>Penyakit</h1>
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
                <div class="form">
                    <form action="" method="post">
                        <label for="nmp">Nama Penyakit:</label>
                        <input type="text" name="nmp" id="nmp" value="<?= $row['disease_nm'] ?>">
                        <label for="desc">Descripsi Penyakit:</label>
                        <textarea name="desc" id="desc" cols="30" rows="5"><?= html_entity_decode(htmlspecialchars_decode($row['description'])) ?></textarea>
                        <label for="handling">Penanganan Penyakit:</label>
                        <textarea name="handling" id="handling" cols="30" rows="5"><?= html_entity_decode(htmlspecialchars_decode($row['handling'])) ?></textarea>
                        <button type="submit" name="edit">Edit</button>
                    </form>
                </div>
            </div>