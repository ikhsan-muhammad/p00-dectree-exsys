<div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>Rules</h1>
                </div>
                <div class="kanan">
                <?php
                    if ($_SESSION['sebagai'] === "admin") {
                        echo'<a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>';
                    }elseif ($_SESSION['sebagai'] === "admin") {                        
                        echo'<a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>';
                    }
                ?>
                </div>
            </div>

            <div class="content">
                <div class="tablenya" style="margin: 30px 0px;">
                    <table border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <th>No</th>
                            <th>Rules Code</th>
                            <th>Rule</th>
                            <th>Certainty term</th>
                            <?php
                            if ($_SESSION['sebagai'] === "pakar") {
                                echo'<th>Tindakan</th>';
                            }
                            ?>
                            
                        </tr>
                        <?php
                        $sql = "SELECT rules.rule_code, rules.rule, certainty.certainty_term
                                FROM rules
                                JOIN certainty
                                ON rules.certainty_code = certainty.certainty_code;";
                        $rule = mysqli_query($connection,$sql);

                        $no = 0;

                        while ($row=mysqli_fetch_assoc($rule))
						{
                        $pecah = $row['rule'];
                        $array_rules = explode(',', $pecah);
                        $last_element = array_pop($array_rules);
                        $kalimatand = implode(" AND ",$array_rules);                        
                        $rules_baru = "IF " . $kalimatand . " THEN " . $last_element;
                        $no++;
                        echo"<tr>";
                            echo"<td>$no</td>";    
                            echo"<td>".$row['rule_code']."</td>";
                            echo"<td>".$rules_baru."</td>";
                            echo"<td>".$row['certainty_term']."</td>";
                            if ($_SESSION['sebagai'] === "pakar") {
                                echo'<td><div class="tindakan"><a href="admin.php?page=editRules.php&code='.$row['rule_code'].'" class="edit_btn">Edit</a></td>';
                            }
                        echo"</tr>";
						}
                        ?>
                    </table>
                </div>
            </div>