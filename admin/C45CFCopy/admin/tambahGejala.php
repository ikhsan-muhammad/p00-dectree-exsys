<?php
include "../function.php";

if (isset($_POST['tambah'])) {
    $desc       = filtering($_POST['descr']);
    $weight   = $_POST['bobot'];
    //Code Penyakit
    $ur = "SELECT symptom_code FROM `symptom` WHERE symptom_code  IN (SELECT MAX(symptom_code )  FROM `symptom`)";
    $urut = mysqli_fetch_assoc(mysqli_query($connection,$ur));

    $urutan = (int) substr($urut['symptom_code'], 2, 3);
    
    $urutan++;

    $huruf = "G";
    $symptom_code = $huruf . sprintf("%03s", $urutan);

    $sqlbaskas      = "SELECT symptom_code FROM `symptom`";
    $hasilsqlbaskas = mysqli_query($connection,$sqlbaskas);
    
    while ($row=mysqli_fetch_array($hasilsqlbaskas))
    {
    $gejalagroup[] = $row['symptom_code'];
    }
    $gejalagroup[] = "$symptom_code";
    $semuagejala = implode("','",$gejalagroup);
    
    echo $semuagejala;

    // mengupdate SET DATA TYPE dari base_symptom
    $sqlupdate = "ALTER TABLE `disease` CHANGE `base_symptom` `base_symptom` SET('".$semuagejala."') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL";
    $update = mysqli_query($connection,$sqlupdate);    

        //Memasukkan Data
        $tamplate = $connection->prepare("INSERT INTO symptom (symptom_code,symptom_desc,weight) VALUES (?, ?, ?)");

        $tamplate->bind_param("ssi", $symptom_code, $desc, $weight);
        if ($tamplate->execute()) {
            echo "<script>alert('Data Gejala ".$symptom_code." Berhasil Ditambah');</script>";
            echo "<script>window.location='admin.php?page=baskas.php';</script>";
        }else{
            echo "Data Gagal Ditambah ".mysqli_error($connection)." ";
        }
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

            <div class="content">
                <div class="form">
                    <form action="" method="post">
                        <label for="desc">Dekripsi Gejala:</label>
                        <textarea name="descr" id="descr" cols="30" rows="5"></textarea>
                        <label for="bobot">Bobot:</label>
                        <select name="bobot" id="bobot">
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                        </select>
                        <button type="submit" name="tambah">Tambah</button>
                    </form>
                </div>
            </div>