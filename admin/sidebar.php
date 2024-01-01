    <div class="logobalitbu">
        <a href="../homepage.php"><img src="../image/logo-balitbu.png" alt="Logo Balitbu Tropika" width="80px"></a>
        <a href="../homepage.php">Balitbu Tropika</a>
    </div>
    <div class="menu">
        <ul>
            <?php
            if ($_SESSION['sebagai'] === "admin") {
                echo'<li><a href="admin.php?page=penyakit.php"><span class="material-symbols-outlined">coronavirus</span><span>Penyakit</span></a></li>';
                echo'<li><a href="admin.php?page=gejala.php"><span class="material-symbols-outlined"> sick</span><span>Gejala</span></a></li>';
                echo'<li><a href="admin.php?page=dataset.php"><span class="material-symbols-outlined"> database</span><span>Dataset</span></a></li>';
                echo'<li><a href="admin.php?page=rules.php"><span class="material-symbols-outlined"> database</span><span>Rules</span></a></li>';
                echo'<li><a href="admin.php?page=riwayat.php"><span class="material-symbols-outlined"> manage_history</span><span>Riwayat</span></a></li>';
                echo'<li><a href="admin.php?page=user.php"><span class="material-symbols-outlined"> admin_panel_settings</span><span>User/Admin</span></a></li>';
                echo'<div class="active"></div>';
            }elseif ($_SESSION['sebagai'] === "pakar") {
                echo'<li><a href="admin.php?page=penyakit.php"><span class="material-symbols-outlined">coronavirus</span><span>Penyakit</span></a></li>';
                echo'<li><a href="admin.php?page=gejala.php"><span class="material-symbols-outlined"> sick</span><span>Gejala</span></a></li>';
                echo'<li><a href="admin.php?page=rules.php"><span class="material-symbols-outlined"> database</span><span>Rules</span></a></li>';
                echo'<div class="active"></div>';
            } 
            ?>
        </ul>                
    </div>
    <div class="logout">
        <div class="wrapplogout">
            <a href="admin.php" class="link1">Home</a> | <a href="../logout.php" class="link2">Logout</a>
        </div>
    </div>
