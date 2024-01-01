            <div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>Riwayat</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
            </div>

            <div class="content">
                <div class="tablenya" style="width: 161vh; box-sizing: border-box;">
                    <table border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Phone</th>
                            <th>Sebagai</th>
                            <th>Alamat</th>
                            <th>Gejala Terpilih</th>
                            <th>Detail Diagnosa</th>
                            <th>Nama Penyakit</th>
                            <th>Kode User</th>
                            <th>Waktu</th>
                            <th>Tindakan</th>
                        </tr>
                        <?php
                        $sql = "SELECT diagnosis.*, disease.disease_nm FROM diagnosis INNER JOIN disease ON diagnosis.disease_code=disease.disease_code";
                        $symptom = mysqli_query($connection,$sql);

                        $no = 0;

                        while ($row=mysqli_fetch_array($symptom))
						{
                            $no++;
                        echo"<tr>";
                            echo"<td>$no</td>";    
                            echo"<td>".$row['history_code']."</td>";
                            echo"<td>".$row['nama']."</td>";
                            echo"<td>".$row['jenis_kelamin']."</td>";
                            echo"<td>".$row['nohp']."</td>";
                            echo"<td>".$row['sebagai']."</td>";
                            echo"<td>".$row['alamat']."</td>";
                            echo"<td>".$row['gejala_terpilih']."</td>";
                            echo"<td>".$row['detail']."</td>";
                            echo"<td>".$row['disease_nm']."</td>";
                            echo"<td>".$row['user_code']."</td>";
                            echo"<td>".$row['tanggal']."</td>";
                            echo'<td><div class="tindakan"><a href="../cetakReport.php?kode_cetak='.$row['history_code'].'" target="_blank" class="cetak_btn">Cetak</a><a href="hapusRiwayat.php?code='.$row['history_code'].'" class="hapus_btn">Hapus</a></div></td>';
                        echo"</tr>";
						}
                        ?>
                    </table>
                </div>
            </div>