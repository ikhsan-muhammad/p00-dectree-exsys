            <div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>Penyakit</h1>
                </div>
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

            <div class="content">
                <div class="linktambah">
                    <?php
                        if ($_SESSION['sebagai'] === "admin") {
                            echo'<a href="admin.php?page=tambahPenyakit.php">Tambah</a>';                            
                        }
                    ?>
                </div>
                <div class="tablenya" style="margin: 30px 0px;">
                    <table border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Penyakit</th>
                            <th>Deskripsi Penyakit</th>
                            <th>Penanganan dan Solusi</th>
                            <?php
                                if ($_SESSION['sebagai'] === "admin") {
                                    echo'<th>Tindakan</th>';                            
                                }
                            ?> 
                        </tr>

                        <?php
                        $sql = "SELECT * FROM disease";
                        $disease = mysqli_query($connection,$sql);

                        $no = 0;

                        while ($row=mysqli_fetch_array($disease))
						{
                            $no++;
                        echo"<tr>";
                            echo"<td>$no</td>";    
                            echo"<td>".$row['disease_code']."</td>";
                            echo"<td>".$row['disease_nm']."</td>";
                            echo"<td>".html_entity_decode(htmlspecialchars_decode($row['description']))."</td>";
                            echo"<td>".html_entity_decode(htmlspecialchars_decode($row['handling']))."</td>";
                            if ($_SESSION['sebagai'] === "admin") {                          
                                echo'<td><div class="tindakan"><a href="admin.php?page=editPenyakit.php&code='.$row['disease_code'].'" class="edit_btn">Edit</a><a href="admin.php?page=hapusPenyakit.php&code='.$row['disease_code'].'" class="hapus_btn">Hapus</a></div></td>';
                            }
                        echo"</tr>";
						}
                        ?>
                    </table>
                </div>
            </div>