            <div class="headermc1" style="justify-content: flex-end;">
                <div class="kanan">
                <?php
                    if ($_SESSION['sebagai'] === "admin") {
                        echo'<a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>';
                    }elseif ($_SESSION['sebagai'] === "pakar") {                        
                        echo'<a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Pakar</span></a>';
                    }
                ?>
                </div>
            </div>
            <div class="headermc2">
                <div class="kiri">
                    <h1>Selamat Datang</h1>
                    <p>Administrator Workspace</p>
                </div>
                
                <!-- speaker note -->

                <!-- <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div> -->
            </div>
            <?php
            if ($_SESSION['sebagai'] === "admin") {
                echo'<div class="menu-box">
                <div class="box">
                    <a href="admin.php?page=tambahPenyakit.php">
                    <span class="material-symbols-outlined">coronavirus</span><strong>Penyakit</strong><span>tambah penyakit</span>
                    </a>
                </div>
                <div class="box">
                    <a href="admin.php?page=tambahGejala.php">
                    <span class="material-symbols-outlined">sick</span><strong>Gejala</strong><span>tambah gejala</span>
                    </a>
                </div>
                <div class="box">
                    <a href="admin.php?page=baskas.php">
                    <span class="material-symbols-outlined">database</span><strong>Basis Kasus</strong><span>Lihat Basis Kasus</span>
                    </a>
                </div>
                <div class="box">
                    <a href="admin.php?page=user.php">
                    <span class="material-symbols-outlined">medical_information</span><strong>User/Admin</strong><span>tambah admin</span>
                    </a>
                </div>
                <div class="box">
                    <a href="admin.php?page=riwayat.php">
                    <span class="material-symbols-outlined">manage_history</span><strong>Riwayat</strong><span>edit dan hapus riwayat</span>
                    </a>
                </div>
                <div class="box">
                    <a href="admin.php?page=tambahAdmin.php">
                    <span class="material-symbols-outlined">admin_panel_settings</span><strong>User/Admin</strong><span>lihat user</span>
                    </a>
                </div>
            </div>';
            }elseif ($_SESSION['sebagai'] === "pakar") {
                echo'<div class="menu-box">
                <div class="box">
                    <a href="admin.php?page=gejala.php">
                    <span class="material-symbols-outlined">coronavirus</span><strong>Penyakit</strong><span>tambah penyakit</span>
                    </a>
                </div>
                <div class="box">
                    <a href="admin.php?page=penyakit.php">
                    <span class="material-symbols-outlined">sick</span><strong>Gejala</strong><span>tambah gejala</span>
                    </a>
                </div>
                <div class="box">
                    <a href="admin.php?page=rules.php">
                    <span class="material-symbols-outlined">manage_history</span><strong>Rules</strong><span>edit dan hapus riwayat</span>
                    </a>
                </div>
            </div>';
            }
            ?>
            