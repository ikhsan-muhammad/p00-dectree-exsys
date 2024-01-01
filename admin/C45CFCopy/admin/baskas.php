            <div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>Basis Kasus</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
            </div>
            <div class="tablenya" style="margin: 30px 0px; padding: 20px;">
            <div class="text"><p style="color:red; font-style: italic; margin-bottom: 5px;">** Pastikan Gejala Sudah di inputkan sebelumnya</p></div>
                        <table border="1" cellpadding="3" >
                            <tr>
                                <th>No</th>
                                <th>Nama Penyakit</th>
                                <th>Basis Kasus</th>
                                <th>Tindakan</th>
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
                            echo"<td>".$row['disease_nm']."</td>";
                            echo"<td>".$row['base_symptom']."</td>";
                            echo'<td><div class="tindakan"><a href="admin.php?page=editBaskas.php&code='.$row['disease_code'].'" class="edit_btn">Edit</a></div></td>';
                        echo"</tr>";
						}
                        ?>
                        </table>
            </div>