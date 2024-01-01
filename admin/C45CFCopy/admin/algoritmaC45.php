<?php

use Mpdf\Utils\Arrays;

include "../connection.php";
include "functionAdmin.php";



if(isset($_GET['action']) &&  $_GET['action'] == 'proses'){
    // mengetahui gejala apa saja yang ada
    $loadSymptompSQL = "DESCRIBE dataset";
    $SymptomDS = mysqli_query($connection,$loadSymptompSQL);
    while ($row = mysqli_fetch_assoc($SymptomDS)) {
        $cell = $row['Field'];
        if ($cell != "Penyakit") {
            $nmSymptom[]= $cell;
        }
    }

    # Penampung
    $rules = array();
    $rule = array();
    $stack = array();
    $scanednodeline = array();
    $berhenti = false;
    
    # Penampung array untuk dibawa ke detail
    $arrkelasdt = array();
    $arrjmldtall = array();
    $arrjmldtpkall = array();
    $arrentall = array();
    $arrMoreone11 = array();
    $arrMoreone12 = array();
    $arrMoreone13 = array();
    $arrMoreoneGain = array();

    while ($berhenti == false) {
            # Penghitungan entropy seluruh data load
            if (empty($rule)) {
                $data = data();
                $kelasdata = Kelasdata();
            }
            elseif (count($rule) == 1) {
                $kalimat = $rule[0];
                $data = data($kalimat);
                $kelasdata = Kelasdata($kalimat);
            }
            else {
                $kalimat = implode(" AND ", $rule);
                $data = data($kalimat);
                $kelasdata = Kelasdata($kalimat);
            }

            # memasukkan node ke array node yang sudah dihitung
            $scanednodeline[] = end($rule);
    
            # Merge data == kelas data merupakan P1-P5
            $MAkelasdata = array_merge(...$kelasdata);
            // var_dump($MAkelasdata);

            if (count($MAkelasdata)==1) {
                $penyakit = $MAkelasdata[0];
                $rule[] = $penyakit;
                $rules[] = $rule;
    
                // penghapusan penyakit terakhir dalam rule
                array_splice($rule, -1);
                
                // membandingkan apakah gejala terakhir di stsck ada di rule
                // for ($m=0; $m < count($rule) ; $m++) { 
                //     $naStack = end($stack);
                //     $naRule = end($rule);
                //     if(preg_match("/Y/", $naRule)){
                //         $naRuleo = str_replace("Y", "T", $naRule);
                //       } else if(preg_match("/T/", $naRule)){
                //         $naRuleo = str_replace("T", "Y", $naRule);
                //       }
        
                //     $naStackA = preg_replace('/\D/', '', end($stack));
                //     $naRuleA = preg_replace('/\D/', '', end($rule));
                    
                //     if ($naStackA == $naRuleA) {
                //         array_splice($rule, -1);
                //         $rule[] = array_pop($stack);
                //     }else {
                //         foreach ($rules as $arrayanak) {
                //             if (in_array($naRuleo, $arrayanak)) {
                //                 $benar = true;
                //             }
                //         }
                //         if (!empty($benar)) {
                //             array_splice($rule, -1);
                //             continue;
                //         } else {
                //             $rule[] = array_pop($stack);
                //             break;
                //         }
                        
                //     }
                // }
                
                // melakukan scanning pada rule yang ada untuk mengeliminasi rule yang sudah di telusuri sebelumnya
                $hasilscanning = scanningrule($rule, $stack, $scanednodeline);
                $rule = $hasilscanning[0];
                $stack = $hasilscanning[1];
                $scanednodeline = $hasilscanning[2];
                $lanjut = $hasilscanning[3];
                if ($lanjut == false) {
                    break;
                    $berhenti = true;
                } else {
                    continue;
                }
                
            }
        
        
            // Data Total &&  Isi table baris 1
            $jmlalldataALL = count($data);
            $jmlPenyakitALL = jumlahpenyakit($data, $MAkelasdata);
            $entropyALL = sterilization(entropy($jmlPenyakitALL, $jmlalldataALL));
            var_dump($jmlalldataALL);
            var_dump($jmlPenyakitALL);
            var_dump($entropyALL);
            // echo "BATAS";
            // echo "</br>";

            $arrkelasdt[] = $MAkelasdata;
            $arrjmldtall[] = $jmlalldataALL;
            $arrjmldtpkall[] = $jmlPenyakitALL;
            $arrentall[] = $entropyALL;

            $arrOne21 = array();
            $arrOne22 = array();
            $arrOne23 = array();
            $arrOneGain = array();

            $gainTerbaik = 0;
            # Mencari Gejala Dengan Nilai Gain Terbaik pada data load 
            for ($J=0; $J <count($nmSymptom); $J++) { 
                // gejala yang akan di hitung gain-nya 
                $Gejala = "$nmSymptom[$J]";
                // ambil angka kode gejala
                $kodegejala = preg_replace('/\D/', '', $Gejala);
                // ambil data yang sudah di pecah dari load data awal
                $hasil = dataYT($data, $kodegejala);
                // masukkan ke variable hasil filterasi
                $data_filtered_Y = $hasil[0];
                $data_filtered_T = $hasil[1];
            
            
                // data yang nanti akan dibawa apabila gainya tertinggi
                $jmlalldataGY = count($data_filtered_Y);
                $jmlalldataGT = count($data_filtered_T);
                $arrOne21[] = $jmlalldataGY;
                $arrOne21[] = $jmlalldataGT; 
                // echo "BATAS";
                // echo "</br>";
                // var_dump($jmlalldataGY);
                // echo "</br>";
                // var_dump($jmlalldataGT);

                $jmlPenyakitGY = jumlahpenyakit($data_filtered_Y, $MAkelasdata);
                $jmlPenyakitGT = jumlahpenyakit($data_filtered_T, $MAkelasdata);
                $arrOne22[] = $jmlPenyakitGY;
                $arrOne22[] = $jmlPenyakitGT; 
                // echo "</br>";
                // var_dump($jmlPenyakitGY);
                // echo "</br>";
                // var_dump($jmlPenyakitGT);
            
                $entropyGY = sterilization(entropy($jmlPenyakitGY, $jmlalldataGY));
                $entropyGT = sterilization(entropy($jmlPenyakitGT, $jmlalldataGT));
                $arrOne23[] = $entropyGY;
                $arrOne23[] = $entropyGT; 
                // echo "</br>";
                // var_dump($entropyGY);
                // echo "</br>";
                // var_dump($entropyGT);
                // echo "</br>";
                
                # Perhitungan gain
                $gain = gain($jmlalldataALL, $entropyALL, $jmlalldataGY, $entropyGY, $jmlalldataGT, $entropyGT);
                $arrOneGain[] = $gain;
                // var_dump($gain);

                // if ($i == 8 ) {
                //     echo $Gejala." ";
                //     var_dump($gain);
                //     echo "</br>";
                // }
        
                # Perintah memilih yang gain terbaik
                if ($gain > $gainTerbaik) {
                    $gainTerbaik = $gain;
                    $gejalaTerbaik = $Gejala;
                    $jmlPenyakitGYTerbaik = $jmlPenyakitGY;
                    $jmlPenyakitGTTerbaik = $jmlPenyakitGT;
                }
            }  
            // var_dump($gainTerbaik);
            // var_dump($gejalaTerbaik);
            // var_dump($jmlPenyakitGYTerbaik);
            // var_dump($jmlPenyakitGTTerbaik);
        
            $gejalaY = "$gejalaTerbaik"." = 'Y'";
            $gejalaT = "$gejalaTerbaik"." = 'T'";
        
            // $fakta[] = $gejalaTerbaik;
            array_push($stack, $gejalaT);
            array_push($stack, $gejalaY);
    
            $rule[] = array_pop($stack);

            # Array yang akan di angkut
            $arrMoreone11[] = $arrOne21;
            $arrMoreone12[] = $arrOne22;
            $arrMoreone13[] = $arrOne23;
            $arrMoreoneGain[] = $arrOneGain;
    }

    // // echo "</br>";
    // // echo "INI RULE";
    // // echo "</br>";
    // // var_dump($rule);
    // // echo "</br>";
    // // echo "INI stack";
    // // echo "</br>";
    // // var_dump($stack);
    // // echo "</br>";
    // echo "INI rules";
    // echo "</br>";
    // var_dump($rules);

    # Rules Masuk Database
    foreach ($rules as $rule) {
        // $penyakitrule[] = array_pop($rule);
        $rulesentence = implode(",", $rule);
        $kumpulanRS[] = $rulesentence;
    }
    
    $certainty_code = "CF001";
    // var_dump($penyakitrule);
    var_dump($kumpulanRS);
    
    // Membersihkan tabel
    $bersi = "DELETE FROM rules WHERE certainty_code IN (SELECT certainty_code FROM certainty)";
    mysqli_query($connection,$bersi);

    foreach ($kumpulanRS as $rule) {   
        $kami = "SELECT rule_code FROM `rules` WHERE rule_code IN (SELECT MAX(rule_code)  FROM `rules`)";
        $kamis = mysqli_fetch_assoc(mysqli_query($connection,$kami));
        if (empty($kamis['rule_code'])) {
        $rule_code= "R001";
    }else {
        $urutan = (int) substr($kamis['rule_code'], 2, 3);
    
        $urutan++;
        
        $huruf = "R";
        $rule_code = $huruf . sprintf("%03s", $urutan);
    }
    
    $tamplate = $connection->prepare("INSERT INTO rules (rule_code, rule, certainty_code) VALUES (?, ?, ?)");
    
    $tamplate->bind_param("sss", $rule_code, $rule, $certainty_code);
    $tamplate->execute();
    }

session_start();
$_SESSION['kelasdata'] = $arrkelasdt;
$_SESSION['jumlahkeseluruhan'] = $arrjmldtall;
$_SESSION['jumlahperpenyakit'] = $arrjmldtpkall;
$_SESSION['entropykeseluruhan'] = $arrentall;
$_SESSION['jumlahdata'] = $arrMoreone11;
$_SESSION['jumlahperpenYT'] = $arrMoreone12;
$_SESSION['entopyYT'] = $arrMoreone13;
$_SESSION['Gain'] = $arrMoreoneGain;
$_SESSION['namaG'] = $nmSymptom;
header("Location: datasetDetail.php");
}
?>