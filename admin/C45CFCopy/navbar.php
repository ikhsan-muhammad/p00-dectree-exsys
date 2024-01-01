<div class="navbar">
        <div class="logo-balitbu">
            <img src="image/logo-balitbu.png" alt="Logo Balitbu Tropika" width="80px"><span>Balitbu Tropika</span>
        </div>
        <div class="menu">
            <ul>
                <li><a href="index.php">Home</a> </li>
                <li><a href="index.php#petunjuk">Petunjuk</a></li>
                <li><a href="consultationPage.php">Diagnosa</a></li>
                <!-- <li><a href="daftarPenyakit.php">Penyakit</a></li> -->
                <?php
                if (isset($_SESSION['login'])) {
                    echo'<li><a href="riwayatAccount.php">Riwayat</a></li>'; 
                }
                ?>
                <li>                    
                    <?php
                    if (isset($_SESSION['login'])) {
                       echo'<span class="hprofil" >
                        <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span></a>
                        </span>'; 
                    }else{
                        echo '<a href="login.php" style="background-color: white; color: #5E4DAB; padding: 5px 10px; border-radius: 5px; ">Sign in</a>';
                    }
                    ?>
                    <!-- <a href="logout.php">logout</a> -->
                </li>
            </ul> 
        </div>
    </div>