<?php
include "../function.php";
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    if (isset($_POST['edit'])) {
        $desc       = filtering($_POST['descrip']);
        $term   = $_POST['term'];
        
        $sqledit = "UPDATE rules
        SET certainty_code = '$term'
        WHERE rule_code = '$code'";
        $berhasil = mysqli_query($connection,$sqledit);

        if ($berhasil === true) {
            echo "<script>alert('Data Berhasil Diedit');</script>";
            echo "<script>window.location='admin.php?page=rules.php';</script>";
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
                    <h1>Rules</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
            </div>

            <?php
                        $sql = "SELECT rules.rule_code, rules.rule, certainty.certainty_code, certainty.certainty_term
                        FROM rules
                        JOIN certainty
                        ON rules.certainty_code = certainty.certainty_code
                        WHERE rules.rule_code = '$code';";
                        $hasil = mysqli_query($connection,$sql);
                        $row   = mysqli_fetch_assoc($hasil);
                        $pecah = $row['rule'];
                        $array_rules = explode(',', $pecah);
                        $last_element = array_pop($array_rules);
                        $kalimatand = implode(" AND ",$array_rules);                        
                        $rules_baru = "IF " . $kalimatand . " THEN " . $last_element;

                        $sql2 = "SELECT * FROM `certainty` LIMIT 6";
                        $hasil2 = mysqli_query($connection,$sql2);
            ?>

            <div class="content">
                <div class="form">
                    <form action="" method="post">
                        <label for="descrip">Dekripsi Gejala:</label>
                        <textarea name="descrip" id="descrip" cols="30" rows="5"><?= $rules_baru ?></textarea>
                        <label for="term">Tingkat Keyakinan:</label>
                        <select name="term" id="term">
                            <?php
                            while ($row2=mysqli_fetch_assoc($hasil2))
                            {
                                echo "<option value=".$row2['certainty_code'].">".$row2['certainty_term']."</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" name="edit">Edit</button>
                    </form>
                </div>
            </div>