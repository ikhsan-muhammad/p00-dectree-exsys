<?php
session_start();
$arrkelasdt = $_SESSION['kelasdata'];//
$arrjmldtall = $_SESSION['jumlahkeseluruhan'];//
$arrjmldtpk = $_SESSION['jumlahperpenyakit'];//
$arrentall = $_SESSION['entropykeseluruhan'];//
$baris3 = $_SESSION['jumlahdata'];
$tengah = $_SESSION['jumlahperpenYT'];
$entropy = $_SESSION['entopyYT'];
$Gain = $_SESSION['Gain'];
// $nmSymptom = $_SESSION['namaG'];
// print_r($tengah);
// print_r($Gain);
// print_r($arrkelasdt);
// print_r($arrjmldtall[0]);
// print_r($arrjmldtpk[0]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Perhitungan</title>
</head>
<style>
    
        h1{
            text-align: center;
        }
        table {
            border-collapse: collapse;
            text-align: center;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .pendorong {
            display: flex;
            justify-content: center;
            height: 100vh;
        }
        .tombol{
            margin-top: 10px;
        }
        button{
            padding: 5px;
            background-color: plum;
            border: none;
            color: white;
            border-radius: 2px;
            margin-bottom: 10px;
        }
        a{
            text-decoration: none;
            color: white;
        }
</style>
<body>
<div class="judul">
    <h1>Perhitungan Algoritma C4.5</h1>
</div>

<div class="pendorong">
    <div class="konten">
        <?php
        for ($i=0; $i < count($arrkelasdt) ; $i++) {
            $iterasi = $i + 1;
            echo '<div class="subjudul">';
                echo '<h2>Iterasi '.$iterasi.':</h2>';
            echo '</div>';

        echo '<div class="tabelperhi">';
        echo "<table border = '1'>";
            echo '<tr>';
            echo '<th>'.$iterasi.'</th>';
            echo '<th></th>';
            echo '<th>Jumlah Kasus</th>';
            foreach ($arrkelasdt[$i] as $value) {
                echo '<th>'.$value.'</th>';
            }
            echo '<th>Entropy</th>';
            echo '<th>Gain</th>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td>All Data</td>';
            echo '<td></td>';
            echo '<td>'.$arrjmldtall[$i].'</td>';
            foreach ($arrjmldtpk[$i] as $value) {
                echo '<td>'.$value.'</td>';
            }
            echo '<td>'.$arrentall[$i].'</td>';
            echo '<td></td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            foreach ($arrjmldtpk[$i] as $value) {
                echo '<td></td>';
            }
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';

            $baris3P1 = $baris3[$i];
            $tengahP1 = $tengah[$i];
            $entropyP1 = $entropy[$i];
            $gainP1 = $Gain[$i];

            $angkaG = 1;
            $angkaGain = 0;
            for ($j=0; $j < count($baris3P1) ; $j++) { 
                echo '<tr>';
                if ($j == 0 || $j % 2 == 0 ) {
                    $angkaG = $i + 1;
                    echo '<td>G'.$angkaG.'</td>';
                    echo '<td>Y</td>';
                    echo '<td>'.$baris3P1[$j].'</td>';
                    foreach ($tengahP1[$j] as $value) {
                        echo '<td>'.$value.'</td>';
                    }
                    echo '<td>'.$entropyP1[$j].'</td>';
                    echo '<td>'.$gainP1[$angkaGain].'</td>';
                    echo '</tr>';
                    $angkaG++;
                    $angkaGain++;
                }else {
                    echo '<td></td>';
                    echo '<td>T</td>';
                    echo '<td>'.$baris3P1[$j].'</td>';
                    foreach ($tengahP1[$j] as $value) {
                        echo '<td>'.$value.'</td>';
                    }
                    echo '<td>'.$entropyP1[$j].'</td>';
                    echo '<td></td>';
                    echo '</tr>';
                }
            }

        echo "</table>";
        echo '</div>';
        }
        ?>
    <div class="tombol">
        <button onclick="window.print()">Print</button>
        <button><a href="admin.php?page=rules.php">Kembali</a></button>
    </div>
    </div>
</div>
</body>
</html>