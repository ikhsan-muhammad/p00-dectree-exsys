<?php
include "../function.php";
if (isset($_GET['code'])) {
    $code = $_GET['code'];

if (isset($_POST['edit'])) {
    $desc       = filtering($_POST['descrip']);
    $weight   = $_POST['bobot'];
    
    $sqledit = "UPDATE `symptom` SET `symptom_desc` = '$desc', `weight` = '$weight' WHERE `symptom`.`symptom_code` = '$code'";
    $berhasil = mysqli_query($connection,$sqledit);

    if ($berhasil === true) {
        echo "<script>alert('Data Berhasil Diedit');</script>";
        echo "<script>window.location='admin.php?page=gejala.php';</script>";
    }else {
        echo "Data Gagal Diedit ".mysqli_error($connection)." ";
    }
}
} else {
    header("Location: gejala.php");
}


?>
            <div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>Gejala</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
            </div>

            <?php
            $sql = "SELECT * FROM `symptom` WHERE symptom_code = '$code';";
            $hasil = mysqli_query($connection,$sql);
            $row   = mysqli_fetch_assoc($hasil);
            ?>

            <div class="content">
                <div class="form">
                    <form action="" method="post">
                        <label for="descrip">Dekripsi Gejala:</label>
                        <textarea name="descrip" id="descrip" cols="30" rows="5"><?= $row['symptom_desc'] ?></textarea>
                        <label for="bobot">Bobot:</label>
                        <select name="bobot" id="bobot">
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                        </select>
                        <button type="submit" name="edit">Edit</button>
                    </form>
                </div>
            </div>