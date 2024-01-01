<?php
include "../function.php";

    if (isset($_POST['tambah'])) {
        $nama = filtering($_POST['nmp']);
        $desc = filtering($_POST['desc']);
        $handling   = filtering($_POST['handling']);

        //Code Penyakit
        $ur = "SELECT disease_code FROM `disease` WHERE disease_id IN (SELECT MAX(disease_id)  FROM `disease`)";
        $urut = mysqli_fetch_assoc(mysqli_query($connection,$ur));

        $urutan = (int) substr($urut['disease_code'], 2, 3);

        $urutan++;

        $huruf = "P";
        $disease_code = $huruf . sprintf("%03s", $urutan);

            //Memasukkan Data
            $tamplate = $connection->prepare("INSERT INTO disease (disease_code,disease_nm,description,handling) VALUES (?, ?, ?, ?)");

            $tamplate->bind_param("ssss", $disease_code, $nama, $desc,$handling);
            if ($tamplate->execute()) {
                echo "<script>alert('Data Berhasil Disimpan');</script>";
                echo "<script>window.location='admin.php?page=penyakit.php';</script>";
            }else{
                echo "Data Gagal Disimpan ".mysqli_error($connection)." ";
            }
        
        
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

            <div class="content">
                <div class="form">
                    <form action="" method="post">
                        <label for="nmp">Nama Penyakit:</label>
                        <input type="text" name="nmp" id="nmp">
                        <label for="desc">Descripsi Penyakit:</label>
                        <textarea name="desc" id="desc" cols="30" rows="20"></textarea>
                        <label for="handling">Penanganan Penyakit:</label>
                        <textarea name="handling" id="handling" cols="30" rows="5"></textarea>
                        <button type="submit" name="tambah">Tambah</button>
                    </form>
                </div>
            </div>