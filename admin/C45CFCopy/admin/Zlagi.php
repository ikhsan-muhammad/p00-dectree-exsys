<?php
include "../connection.php";
include "functionAdmin.php";
// $satu = 40;
// $dua = 20;
// $tiga = "Kamu";
// $empat = "saya";

// // $san = array("ikhan","asa");
// // // var_dump($san[1]);
// // // echo $tiga;
// echo "<br>";

// $arrang[] = $satu;
// $arrang[] = $dua;
// $arrang = ["saku"=> 2];
// $arrang = ["kami"=> 3];

// var_dump($arrang);
// echo "<br>";
// unset($arrang);

// var_dump($arrang);

// echo "<br>";
// $arrang[] = $empat;
// var_dump($arrang);
// echo "<br>";

// // var_dump($arrang[0]/$arrang[1]);
// // var_dump($arrang[2]);

// $rancak = "D001";

// //membuat code baru
// $kami = "SELECT history_code FROM `diagnosis` WHERE history_id IN (SELECT MAX(history_id)  FROM `diagnosis`)";
// $kamis = mysqli_fetch_assoc(mysqli_query($connection,$kami));

// $urutan = (int) substr($kamis['history_code'], 3, 3);

// $urutan++;

// $huruf = "DG";
// $diagnosiscode = $huruf . sprintf("%03s", $urutan);

// echo $diagnosiscode;

// // menjadikan float 2 angka blakang koma
// $azam = 0;
// $azam2 = round($azam, 2);
// $azam2 = number_format($azam,2);
// echo $azam;
// echo "<br>";
// echo $azam2;

// $sqlbaskas      = "SELECT symptom_code FROM `symptom`";
// $hasilsqlbaskas = mysqli_query($connection,$sqlbaskas);

// while ($row=mysqli_fetch_array($hasilsqlbaskas))
// {
// $gejalagroup[] = $row['symptom_code'];
// }
// $gejalagroup[] = "G046";
// $semuagejala = implode("','",$gejalagroup);

// echo $semuagejala;
// $kamis = 023;
// $kamis++;
// echo $kamis;

// $kamis = "lagi";
// if ($kamis === "lagi") {
//     echo "hai";
// }

// $sqlgejala = "SELECT symptom_desc FROM symptom WHERE symptom_code = 'G001'";
//             $hasil = mysqli_fetch_assoc(mysqli_query($connection,$sql));
//             var_dump($hasil['symptom_desc']);

// $array = array("G11 = 'Y'", "G22 = 'Y'", "G33 = 'Y'");
// $angka = preg_replace('/\D/', '', end($array));
// echo $angka;

// $array = array();

// $data = data("G1 = 'Y'");
// var_dump($data);
$kamis = "R032";
$urutan = (int) substr($kamis, 2, 3);
$urutan++;
    
        $huruf = "R";
        $rule_code = $huruf . sprintf("%03s", $urutan);
var_dump($rule_code);
?>