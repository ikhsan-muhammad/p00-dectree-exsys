<?php
include "connection.php";
include "session.php";
    // ambil data get dari halaman dignose.php dengan variable zip
    if (!isset($_GET['zip'])) {
        header("location: consultationPage.php");
        exit;
    }
    
    $tangkap = $_GET['zip'];
    
    //ambil data dari tabel diagnosis
    $sql = "SELECT diagnosis.*, disease.description, disease.handling FROM diagnosis INNER JOIN disease ON diagnosis.disease_code=disease.disease_code WHERE history_code = '$tangkap'";
    $row = mysqli_fetch_assoc(mysqli_query($connection,$sql));

    // $sql = "SELECT * FROM diagnosis WHERE history_code LIKE 'D001'";
    // $row = mysqli_fetch_assoc(mysqli_query($connection,$sql));

    $pemecah = explode(",",$row['detail']);
    $tertinggi = explode("=",$pemecah[0]);

    //waktu dan jam dipisah
    $waktu = explode(" ",$row['tanggal']);
    // var_dump($pemecah);
    //untuk menampilkan seluruh data// SELECT diagnosis.*, disease.disease_code, disease.disease_nm, disease.disease_desc, disease.handling, disease.base_symptom FROM diagnosis INNER JOIN disease ON diagnosis.disease_id=disease.disease_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa</title>
    <link rel="stylesheet" href="stylegen.css">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="content-hasil">
        <div class="visual1">
            <div class="info-diagnosa">
                <h1 class="title-pendiagnosa">Hasil diagnosa:</h1>
                <table class="data-pendiagnosa">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $row['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                    </tr>
                    <tr>
                        <td>No.HP</td>
                        <td>:</td>
                        <td><?= $row['nohp'] ?></td>
                    </tr>
                    <tr>
                        <td>Sebagai</td>
                        <td>:</td>
                        <td><?= $row['sebagai'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $row['alamat'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="hasildiagnosa">
                <div class="tablehasil">
                    <table style="margin-left:auto;margin-right:auto" >
                        <tr style=" background-color: #FF5EA1;">
                            <td>NO</td>
                            <td>Nama Penyakit</td>
                            <td>Certainty Percentage</td>
                        </tr>

                        <?php
                            for ($i=0; $i < count($pemecah); $i++) { 
                                $j = $i+1;
                                $pemecah2 = explode("=",$pemecah[$i]);
                                $persen = $pemecah2[1]*100;
                                $harya[]=$persen; 
                                echo "
                                <tr>
                                        <td>$j</td>
                                        <td>$pemecah2[0]</td>
                                        <td>$persen%</td>
                                </tr>
                               ";
                               unset($pemecah2);
                            }
                        ?>
                    </table>
                </div>
                <div class="penjabaran">
                    <?php
                    $ps = $tertinggi[1] * 100;
                    if ($harya[0] == 0) {
                        echo'<p style="text-indent: 45px;">Berdasarkan gejala yang di inputkan oleh pendiagnosa, yang dikirim pada tanggal <strong>'.$waktu[0].'</strong> Jam <strong>'.$waktu[1].'</strong>. Didapatkan hasil bahwa tanaman manggis yang di diagnosa tidak terserang Penyakit</p>';
                    }else {
                        echo'<p style="text-indent: 45px;">Berdasarkan gejala yang di inputkan oleh pendiagnosa, yang dikirim pada tanggal <strong>'.$waktu[0].'</strong> Jam <strong>'.$waktu[1].'</strong>. Didapatkan hasil bahwa tanaman manggis di diagnosa terserang Penyakit <strong>'.$tertinggi[0].'</strong> dengan Tingkat Kepercayaan (Certainty) sebesar <strong>'.$ps.'%</strong>. <i id="ketklik">Untuk detail penyakit dan penanganan lebih lanjut dapat dilihat dengan meng-klik tombol detail penyakit.</i></p>';
                    }
                    ?>
                </div>
                <?php
                if ($harya[0] != 0) {
                    echo'<div class="detailpenyakit" id="detailpenyakit" style="display:none;">
                            <h2>Penyakit <?= $tertinggi[0] ?></h2>
                            <p><?= html_entity_decode(htmlspecialchars_decode($row["description"]))?></p>
                            <h3>Solusi dan penanganan:</h3>
                            <p><?=html_entity_decode(htmlspecialchars_decode($row["handling"]))?></p>
                    </div>
                    <div class="tombollanjutan">
                        <button id="showmore" onclick="moreless()" style="background-color: skyblue; margin-right: 10px;">Detail Penyakit</button>
                        <button id="showless" onclick="moreless()" style="display: none; background-color: palevioletred; margin-right: 10px;">Tampilkan lebih sedikit</button>
                        <button style="background-color: greenyellow;"><a href="cetakReport.php?kode_cetak=<?= $tangkap ?>" target="_blank">Cetak</a></button>
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <script>
    function moreless() {
        var detailpenyakit = document.getElementById("detailpenyakit");
        var showmore = document.getElementById("showmore");        
        var showless = document.getElementById("showless");

        if (detailpenyakit.style.display === "none") {
            detailpenyakit.style.display = "inline-block";
            ketklik.style.display = "none"; 
            showmore.style.display = "none";
            showless.style.display = "inline";
        } else {
            detailpenyakit.style.display = "none"; 
            ketklik.style.display = "inline";
            showmore.style.display = "inline";
            showless.style.display = "none";
        }
    }
    </script>
</body>
</html>