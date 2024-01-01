<?php
    include "connection.php";
    include "session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Diagnosa</title>
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="stylegen.css">
    <style>
        body{
            /* background: linear-gradient(0deg, #974EC2 14.05%, #D3BEF0 97%); */
            background-color: rgb(211, 190, 240);
            height: 100vh;
        }
        h1{
            color: #974EC2;
            margin-top: 30px;
            margin-left: 50px;
        }
        th{
            /* background-color: #D3BEF0; */
            background-color: white;
            color: #974EC2;
        }
        .content{
            height: 80vh;
            margin: 0px 20px 0px 20px;
        }
        @media screen and (max-width: 600px) {
            .content table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <h1>Riwayat Diagnosa:</h1>
    <div class="content" style="padding: 20px 30px; width: auto; max-width:3600px; overflow: auto;">
    
                <div class="tablenya" style="margin: 30px 0px;">
                    <table border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Phone</th>
                            <th>Sebagai</th>
                            <th>Alamat</th>
                            <th>Gejala Terpilih</th>
                            <th>Detail Diagnosa</th>
                            <th>Nama Penyakit</th>
                            <th>Waktu</th>
                        </tr>
                        <?php
                        $user = $_SESSION['user_code'];
                        $sql = "SELECT diagnosis.*, disease.disease_nm FROM diagnosis INNER JOIN disease ON diagnosis.disease_code=disease.disease_code WHERE user_code = '$user' ORDER BY diagnosis.history_code ASC;";
                        $symptom = mysqli_query($connection,$sql);

                        $no = 0;

                        while ($row=mysqli_fetch_array($symptom))
						{
                            $no++;
                        echo"<tr>";
                            echo"<td>$no</td>";
                            echo"<td>".$row['nama']."</td>";
                            echo"<td>".$row['jenis_kelamin']."</td>";
                            echo"<td>".$row['nohp']."</td>";
                            echo"<td>".$row['sebagai']."</td>";
                            echo"<td>".$row['alamat']."</td>";
                            echo"<td>".$row['gejala_terpilih']."</td>";
                            echo"<td>".$row['detail']."</td>";
                            echo"<td>".$row['disease_nm']."</td>";
                            echo"<td>".$row['tanggal']."</td>";
                        echo"</tr>";
						}
                        ?>

</body>
</html>