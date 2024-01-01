<?php
include "../function.php";
if (isset($_GET['code'])) {
$code = $_GET['code'];

if (isset($_POST['edit'])) {
    $nama       = filtering($_POST['nama']);
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $alamat   = filtering($_POST['alamat']);

    $sqledit = "UPDATE `user` SET `nama` = '$nama', `email` = '$email', `nohp` = '$phone', `alamat` = '$alamat'  WHERE `user`.`user_code` = '$code'";
    $berhasil = mysqli_query($connection,$sqledit);

    if ($berhasil === true) {
        echo "<script>alert('Data Berhasil Diedit');</script>";
        echo "<script>window.location='admin.php?page=user.php';</script>";
    }else {
        echo "Data Gagal Diedit ".mysqli_error($connection)." ";
    }
}
} else {
    header("Location: user.php");
}


?>

            <div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>User/Admin</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
            </div>

            <?php
            $sql = "SELECT * FROM `user` WHERE user_code = '$code';";
            $hasil = mysqli_query($connection,$sql);
            $row   = mysqli_fetch_assoc($hasil);
            ?>

            <div class="content">
                <div class="form">
                    <form action="" method="post">
                        <label for="nama">Nama Admin:</label>
                        <input type="text" name="nama" id="nama" value="<?= $row['nama'] ?>">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" value="<?= $row['email'] ?>">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" value="<?= $row['nohp'] ?>">
                        <label for="alamat">Alamat:</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="5"><?= $row['alamat'] ?></textarea>
                        <button type="submit" name="edit">Edit Admin</button>
                    </form>
                </div>
            </div>