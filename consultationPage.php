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
    <title>CONSULTATION PAGE</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        body{
            margin: 0;
            height: 100%;
            width: 100%;
            /* background: linear-gradient(0deg, #974EC2 14.05%, #D3BEF0 97%); */
        }
        ::-webkit-scrollbar{
            width: 5px;
        }
        ::-webkit-scrollbar-thumb{
            background-color: #5E4DAB;
        }
        label{
            margin-bottom: 10px;
            font-size: 18px;
        }
        input{
            background-color: #974EC2;
            color: white;
            border-color: whitesmoke;
            border-top: none;
            border-left: none;
            border-right: none;
            border-width: 2px;
            margin-bottom: 20px;
            
        }
        input[type="text"]:focus{
            outline: none;
        }
        input[type="checkbox"]{
            padding: 1px;
            height: 20px;
            width: 20px;
        }
        .material-icons{
            font-size: 18px;
        }
        a{
            text-decoration: none;
            color: #974EC2;
        }
        li{
            margin-right: 20px;
        }
        ul li{
            display: inline-block;
        }
        button{
            margin: 10px;
            padding: 10px 30px ;
            border: none;
            border-radius: 5px;
            color: white;
            box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
        }
        .radiobutton{
            border-bottom: 2px solid white;
            margin-bottom: 10px;
        }
      
    </style>
</head>
<body>
    
    <div class="consul-section" >
        <form action="certaintyFactor.php" method="post" style="display: flex;">
            <section class="sidebar" style="background-color: #974EC2; color: white; width: 350px;  position: relative; height:100vh; margin: 0;">
                <!--Logo Awal-->
                <div class="logo" style="display: flex; align-items: center; padding: 30px 0px;">
                    <img src="./image/logo-balitbu.png" alt="Lambang Kementrian Pertaniang" style="width: 100px; height: auto;">
                    <h1 style="margin: 0px;">Balitbu Tropika</h1>
                </div>

                <!-- data diagnosa -->
                <div class="data-diagnosa" style="display: grid; padding:0px 10px;">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" autocomplete="off" >
                    <div class="radiobutton">
                        <label for="jk">Jenis Kelamin:</label>
                        <input type="radio" name="jk" id="jk" value="laki-laki">Laki-laki
                        <input type="radio" name="jk" id="jk" value="perempuan">Perempuan
                    </div>
                    <label for="nohp">No.HP:</label>
                    <input type="text" name="nohp" id="nohp" autocomplete="off">
                    <div class="radiobutton">
                        <label for="sebagai">Tanaman Milik:</label>
                        <input type="radio" name="sebagai" id="sebagai" value="individu">Individu
                        <input type="radio" name="sebagai" id="sebagai" value="kelompok">Kelompok
                    </div>
                    <label for="alamat">Alamat:</label>
                    <input type="text" name="alamat" id="alamat" autocomplete="off">
                </div>

                <!-- footer sidebar -->
                <div class="footer" style=" position: absolute; bottom: 0; right: 0; padding: 10px ;margin-right: 10px;">
                    <!-- <a href="#petunjuk" style="color: white; display: flex; align-items: center;">
                        <span class="material-symbols-outlined" style="margin-right: 5px;">info</span><p>Petunjuk Pengisian</p>
                    </a> -->
                </div>

            </section>

            <section class="content">
                <div class="header" style="display: flex; justify-content: space-between; align-items: center; width: auto; padding: 0 30px;">
                    <ul style="list-style-type: none; margin:0; padding: 20px 0 20px 20px; border-bottom: 3px solid #974EC2;">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="riwayatAccount.php">Riwayat</a></li>
                        <li><a href="index.php#petunjuk">Petunjuk</a></li>
                    </ul>
                    <!-- <span class="hprofil" >
                        <a href="#profil"style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span>Muhammad Ikhsan</a>
                    </span> -->
                </div>

                <div class="symptomp" style="width: 65rem; height: 35rem; background-color: white; border: 2px solid #974EC2; margin: 50px 50px 10px 50px; overflow: auto; padding: 40px; box-sizing: border-box;">
                    <H1 style="padding: 0px 0px 30px 0px; margin: 0; border-bottom: 2px solid #974EC2; color: #974EC2;">Pilih Gejala dan Berikan Tingkat Keyakinan:</H1>
                        <!-- <div class="input-gejala" style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding:10px 0px; border-bottom: 2px solid #5a2e97;">
                            <p style="width: 60%; height: auto; margin: 0; text-align: center;">Pada Cabang atau ranting Terdapat lapisan jamur tipis berwarna putih.</p>
                            <input type="checkbox" name="gejala" id="gejala" style="margin: 0;">
                        </div>
                        <div class="input-gejala" style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding:10px 0px; border-bottom: 2px solid #5a2e97;">
                            <p style="width: 60%; height: auto; margin: 0; text-align: center;">pada cabang atau ranting terdapat kumpulan benang menyeripai sarang laba laba mengkilat berwarna peral</p>
                            <input type="checkbox" name="gejala" id="gejala" style="margin: 0;">
                        </div> -->
                        <?php

                        $sql = "SELECT * FROM symptom";
                        $symptom = mysqli_query($connection,$sql);

                        $sql2 = "SELECT * FROM certainty LIMIT 6, 6";
                        $certainty = mysqli_query($connection,$sql2);

                        while ($row=mysqli_fetch_array($symptom))
						{
                            echo'    <div class="input-gejala" style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding:10px 0px; border-bottom: 2px solid #974EC2;">';
                            echo'    <p style="width: 60%; height: auto; margin: 0; text-align: center;">'.$row['symptom_desc'].'</p>';
                            echo'    <select name="gejala[]" id="gejala" style="margin: 0;">';
                                         echo '<option value=0>-- Pilih --</option>';
                                        $certainty = mysqli_query($connection,"SELECT * FROM certainty LIMIT 6, 6");
                                        while ($row2=mysqli_fetch_array($certainty))
						                {
                                            echo "<option value=".$row2['certainty_weight'].">".$row2['certainty_term']."</option>";
                                        }
                            echo '  </select>
                                     </div>';
						}

                        
                        ?>
                </div>

                <div class="button" style="display: flex; justify-content: center;">
                    <button type="submit" name="submit" id="submit" style="background-color: #5E4DAB;">Proses</button>
                    <button type="reset" name="reset" id="reset" style="background-color: #5E4DAB;">Reset</button>
                </div>
            </section>
        </form>
    </div>
</body>
</html>