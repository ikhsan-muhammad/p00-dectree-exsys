<?php
include "../connection.php";

# Fungsi Algoritma C4.5
function data($kriteria = "kosong"){
    global $connection;
    if ($kriteria == "kosong") {
        $linePerintah = "SELECT * FROM `dataset`";        
    }else {
        $linePerintah = "SELECT * FROM `dataset` WHERE "."$kriteria";            
    }
    $allDS = mysqli_fetch_all(mysqli_query($connection,$linePerintah));
    
    return $allDS;
}

function dataYT($data, $kodegejala) {
    // mastiin aja $kodegejala bekoma apa ngga
    if (!is_numeric($kodegejala) || $kodegejala < 0) {
        return false;
    }
    
    // Tambahkan 'use' untuk mengakses variabel $kodegejala di dalam closure
    $data_filtered_Y = array_filter($data, function($var) use ($kodegejala) {
        return $var[$kodegejala] !== "T";
    });
    $data_filtered_T = array_filter($data, function($var) use ($kodegejala) {
        return $var[$kodegejala] !== "Y";
    });
    
    return array($data_filtered_Y, $data_filtered_T);
}

function Kelasdata($kriteria = "kosong" ){
    global $connection;
    if ($kriteria == "kosong") {
        $linePerintah = "SELECT DISTINCT Penyakit FROM dataset";        
    }else {
        $linePerintah = "SELECT DISTINCT Penyakit FROM dataset WHERE "."$kriteria";            
    }
    $classDS = mysqli_fetch_all(mysqli_query($connection,$linePerintah));
    
    return $classDS;
}

function jumlahpenyakit($data, $MAkelasdata){
    $jmlPenyakit = array();    
    for ($i=0; $i <count($MAkelasdata) ; $i++) {
        $angka = 0; 
        foreach ($data as $arrayAnak) {            
            $angka += count(array_keys($arrayAnak, "$MAkelasdata[$i]"));
        }
        $jmlPenyakit[$MAkelasdata[$i]] = $angka;
        unset($angka);
    }
    return $jmlPenyakit;
}

function entropy($jmlPenyakit, $jmlalldata){
    $entropy = 0;
    foreach ($jmlPenyakit as $value) {
        if ($value != 0) {
            $pi = $value/$jmlalldata; // Hitung probabilitas kelas i
            $E = -$pi*log($pi, 2); // Hitung entropy kelas i
        }elseif ($value == 0) {
            $E = 0;
        }
        $entropy += $E; // Tambahkan entropy kelas i ke entropy total
    }
    return $entropy;
}

function sterilization($nilai1){
    if (is_nan($nilai1)) {
        $nilai1 = 0;
    }
    return $nilai1;
}

function gain($nilai1,$nilai2,$nilai3, $nilai4, $nilai5, $nilai6){
    // jumlah data dahulu entropy kemudian, Y dulu T kemudian
    if ($nilai3 != 0 && $nilai5 != 0 ) {
        $gain = $nilai2-((($nilai3/$nilai1)*$nilai4)+(($nilai5/$nilai1)*$nilai6));        
    }else {
        $gain = 0;
    }
    
    return $gain;
}

function scanningrule($rule, $stack,$scanednodeline){
    $a = true;
    $lanjut = true;
    while ($a == true) {
        $hapus = array();
        $naRule = end($rule);
        $hapus[]= $naRule;
        if(preg_match("/Y/", $naRule)){
            $naRuleo = str_replace("Y", "T", $naRule);
        } else if(preg_match("/T/", $naRule)){
            $naRuleo = str_replace("T", "Y", $naRule);
        }
        $hapus[]= $naRuleo;
        if (in_array($naRuleo, $scanednodeline)) {
            //sudah atau sama antara rule yang diperiksa dengan scanednodeline
            array_splice($rule, -1);
            $scanednodeline = array_diff($scanednodeline,$hapus);
            $scanednodeline = array_values($scanednodeline);
        }else {
            //belum
            array_splice($rule, -1);
            $rule[] = array_pop($stack);
            $a = false;
        }
    }
    if (in_array(NULL, $rule) && empty($stack)) {
        $lanjut = false;
    }
    return array($rule, $stack, $scanednodeline, $lanjut) ;
}

# Fungsi Umum Admin
?>