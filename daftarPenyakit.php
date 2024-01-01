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
            background: linear-gradient(0deg, #974EC2 14.05%, #D3BEF0 97%);
        }
        h2{
            border-bottom: 2px solid white;
        }
        th{
            background-color: #D3BEF0;
        }
        .content{
            padding: 100px;
        }
        .dp{
            margin-bottom: 20px;
            border-bottom: 2px solid white;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
<div class="content">
                        <?php
                        $sql = "SELECT * FROM disease";
                        $disease = mysqli_query($connection,$sql);

                        $no=1;

                        while ($row=mysqli_fetch_array($disease))
						{
                            echo"<div class='dp'>";
                            echo"<div class='namapenyakit'><h2>".$no.". ".$row['disease_nm']."</h2></div>";
                            echo"<div class='desc_tion'><strong>Deskripsi:</strong><br>";
                            echo html_entity_decode(htmlspecialchars_decode($row['description']));
                            echo"</div>";
                            echo"<div class='handl'><strong>Penanganan:</strong><br>";
                            echo html_entity_decode(htmlspecialchars_decode($row['handling']));
                            echo"</div>";
                            echo"</div>";
                            $no++;
						}
                        ?>
</div>
</body>
</html>