<?php
include "connection.php";
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

    $tangkap = $_GET['kode_cetak'];
    
    //ambil data dari tabel diagnosis
    $sql = "SELECT * FROM diagnosis WHERE history_code = '$tangkap'";
    $row = mysqli_fetch_assoc(mysqli_query($connection,$sql));

    // $sql = "SELECT * FROM diagnosis WHERE history_code LIKE 'D001'";
    // $row = mysqli_fetch_assoc(mysqli_query($connection,$sql));

    //Gejala
    $pemecahgejala = explode("||",$row['gejala_terpilih']);

    //detail
    $pemecah = explode(",",$row['detail']);
    $tertinggi = explode("=",$pemecah[0]);
    $simtertinggi = $tertinggi[1]*100;

    //waktu dan jam dipisah
    $waktu = explode(" ",$row['tanggal']);

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Hasil Diagnosa</title>
    <link rel="stylesheet" href="styleReport.css">
</head>
<body>
    <table class="table1">
    <tr>
        <td><img src="image/logo-balitbu.png" alt="Logo Balitbu" width="150px"></td>
        <td>KEMENTERIAN PERTANIAN BADAN PENELITIAN DAN PENGEMBANGAN PERTANIAN PUSAT PENELITIAN DAN PENGEMBANGAN HORTIKULTURA <br>
            <b>BALAI PENELITIAN TANAMAN BUAH TROPIKA</b> <br>
            <span style="font-size:12px;">
            Jl. Raya Solok - Aripan Km. 8 Kotak Pos 5 Solok, Sumatera Barat 27301 <br>
            Telephone : (62) 755 20137, fax : (62) 755 20592 <br>
            Email:balitbu@litbang.pertanian.go.id , balitbu@gmail.com
            </span>
            </td>
        <td><img src="image/iso.png" alt="ISO 9001" width="100px" style="padding-left: 10px;"></td>
    </tr>
    </table>

    <h3 style="text-align: center;"><u>Surat Keterangan Hasil Diagnosa</u></h3>

    <p style="text-indent: 45px;">Berdasarkan diagnosa penyakit pada tanaman manggis yang dilakukan pada tanggal <strong>'. $waktu[0] .'</strong> oleh:</p>

    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>'.$row['nama'].'</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>'.$row['jenis_kelamin'].'</td>
        </tr>
        <tr>
            <td>No.HP</td>
            <td>:</td>
            <td>'.$row['nohp'].'</td>
        </tr>
        <tr>
            <td>Sebagai</td>
            <td>:</td>
            <td>'.$row['sebagai'].'</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>'.$row['alamat'].'</td>
        </tr>
    </table>

    <p>Dengan daftar gejala yang dinputkan yaitu sebagai berikut:</p>

    <table class="table2">
        <tr>
            <th style="width:10%;">No</th>
            <th>Deskripsi gejala</th>
        </tr>';

        for ($h=0; $h < count($pemecahgejala); $h++) { 
            $j = $h+1;
            // $sqlgejala = "SELECT symptom_desc FROM symptom WHERE symptom_code = '$gejala_code[$h]'";
            // $hasil = mysqli_fetch_assoc(mysqli_query($connection,$sqlgejala));

            $html.='<tr>
                <td>'.$j.'</td>
                <td>'.$pemecahgejala[$h].'</td>
            </tr>';
        }

$html .= '</table>

    <p> Setelah dilakukan diagnosa pada tanaman manggis, diapatkan hasil bahwa sebanyak <strong>'.$row['jumlah_batang'].' batang</strong> tanaman manggis tersebut terserang Penyakit <strong>'.$tertinggi[0].'</strong> dengan persentase kepastian sebesar <strong>'.$simtertinggi.'%</strong>.</p>

    <table class="table2">
        <tr>
            <th style="width:10%;">No</th>
            <th>Nama Penyakit</th>
            <th>Certainty Percentage</th>
        </tr>';

        for ($i=0; $i < count($pemecah); $i++) { 
            $j = $i+1;
            $pemecah2 = explode("=",$pemecah[$i]);
            $persen = $pemecah2[1]*100;
            $html.='<tr>
                    <td>'.$j.'</td>
                    <td>'.$pemecah2[0].'</td>
                    <td>'.$persen.'%</td>
            </tr>';
           unset($pemecah2);
        }

$html .='</table>

    <p>Demikianlah surat ini dibuat untuk dapat dipergunakan seperlunya </p>

    <table style="text-align:right; margin-top:200px; width:100%;">
        <tr style="display:flex;">
            <td style="">
                Aripan, 20 september 2022 <br>
                TTD <br><br><br><br><br>
                AFFANDI, Ph.D 
            </td>
        </tr>
    </table>
</body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output();

?>