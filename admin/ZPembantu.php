<?php
include "../connection.php";
include "functionAdmin.php";


// if(isset($_GET['action']) &&  $_GET['action'] == 'proses'){
    // mengetahui gejala apa saja yang ada
    $loadSymptompSQL = "DESCRIBE dataset";
    $SymptomDS = mysqli_query($connection,$loadSymptompSQL);

    while ($row = mysqli_fetch_assoc($SymptomDS)) {
        $cell = $row['Field'];
        if ($cell != "Penyakit") {
            $nmSymptom[]= $cell;
        }
    }

    // var_dump(data("WHERE G1 = 'Y'"));
    // var_dump(kelasdata("WHERE G1 = 'Y'"));
    $kalimat = "G11 = 'T' AND G2 = 'T' AND G22 = 'T'";
    $data = data($kalimat);
    $kelasdata = Kelasdata("$kalimat");
    // var_dump($data);
    // merge data
    $MAkelasdata = array_merge(...$kelasdata);
    var_dump($MAkelasdata);
    echo "</br>";   
    // mencari entropy keseluruhan
    $jmlalldataALL = count($data);
    $jmlPenyakitALL = jumlahpenyakit($data, $MAkelasdata);
    $entropyALL = sterilization(entropy($jmlPenyakitALL, $jmlalldataALL));
    var_dump($entropyALL);
    echo "</br>";   
    for ($J=0; $J <count($nmSymptom); $J++) { 
        #// gejala yang akan di hitung gain-nya 
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
       
        $jmlPenyakitGY = jumlahpenyakit($data_filtered_Y, $MAkelasdata);
        $jmlPenyakitGT = jumlahpenyakit($data_filtered_T, $MAkelasdata);
    
        # perintah cetak
        // var_dump($jmlPenyakitGY);
        // var_dump($jmlPenyakitGT);
    
        $entropyGY = sterilization(entropy($jmlPenyakitGY, $jmlalldataGY));
        $entropyGT = sterilization(entropy($jmlPenyakitGT, $jmlalldataGT));
        
        // # perintah cetak
        // echo "</br>";
        // var_dump($entropyGY);
        // echo "</br>";
        // var_dump($entropyGT);
        // echo "</br>";
        
        #// perhitungan gain
        $gain = gain($jmlalldataALL, $entropyALL, $jmlalldataGY, $entropyGY, $jmlalldataGT, $entropyGT);
        echo $Gejala." ";
        var_dump($gain);
        echo "</br>";       
    }
    

// }   
?>