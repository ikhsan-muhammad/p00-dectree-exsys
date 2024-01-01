<div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>User/Admin</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
            </div>

            <div class="content">
                <div class="linktambah">
                    <a href="admin.php?page=tambahAdmin.php">Tambah Admin</a>
                </div>
                <div class="tablenya" style="margin: 30px 0px;">
                    <table border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Alamat</th>
                            <th>sebagai</th>
                            <th>Tindakan</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM user";
                        $user = mysqli_query($connection,$sql);

                        $no = 0;

                        while ($row=mysqli_fetch_assoc($user))
						{
                            $no++;
                        echo"<tr>";
                            echo"<td>$no</td>";    
                            echo"<td>".$row['user_code']."</td>";
                            echo"<td>".$row['nama']."</td>";
                            echo"<td>".$row['email']."</td>";
                            echo"<td>".$row['nohp']."</td>";
                            echo"<td>".$row['alamat']."</td>";
                            echo"<td>".$row['sebagai']."</td>";
                            echo'<td><div class="tindakan"><a href="admin.php?page=editUser.php&code='.$row['user_code'].'" class="edit_btn">Edit</a><a href="hapusUser.php?code='.$row['user_code'].'" class="hapus_btn">Hapus</a></div></td>';
                        echo"</tr>";
						}
                        ?>
                    </table>
                </div>
            </div>