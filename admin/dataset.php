<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;


if (isset($_POST['kirimfile'])) {
    #1.memasukkan file ke directory
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $filename = "DataRiwayat".".".end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $targetdirectory = "../excel/";
    $targetfile = $targetdirectory.$filename;
    $upload = move_uploaded_file($sumber, $targetfile);
    if ($upload) {
        echo "<script>alert('Data Berhasil Dinputkan');</script>";
        // echo "<script>window.location='admin.php?page=pohonKeputusan.php';</script>";
    }else{
        echo "Data Gagal Disimpan ".mysqli_error($connection)." ";
    }

    #2.melakukan read excel
    //mulai membaca excel
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("$targetfile");
    $spreadsheet = $reader->load("$targetfile");
    $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        
    //mendapatkan jumlah kolom dalam file excel
    $highestColumn = $spreadsheet->setActiveSheetIndex(0)->getHighestColumn();
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    
    #3. mempersiapkan perintah SQL yang lebih flexible
    //membentuk kumpulan nama field table
    $nmfieldSQL = "DESCRIBE dataset";
    $nmfieldPick = mysqli_query($connection,$nmfieldSQL);

    while ($row = mysqli_fetch_assoc($nmfieldPick)) {
        $fields[] = $row['Field'];
    }

    //menghitung jumlah fields di tabel
    $jmlfields = count($fields);
    //menyatukan nama fields menjadi kalimat
    $linefields = implode(",", $fields);
    //membentuk tanda tanya dan tipe data
    for ($i=0; $i < $jmlfields ; $i++) { 
        $ttanya[] = "?";
        $typedata[] = "s";
    }
    $linettanya = implode(",", $ttanya);
    $linetypedata = implode("", $typedata);
    
    // echo $linefields;
    // echo "</br>";
    // echo $linettanya;
    // echo "</br>";
    // echo $linetypedata;
    // echo "</br>";
    // // echo $linesebaris;
    // // echo "</br>";

    //menghapus isi tabel atau memastikan tabel kosong
    $hapusdttblSQL = "TRUNCATE TABLE dataset";
    mysqli_query($connection,$hapusdttblSQL);
    
    //proses memasukkan data hasil pembacaan ke database
    for ($baris=1; $baris <count($sheetdata); $baris++) { 
        for ($kolom=0; $kolom <$highestColumnIndex ; $kolom++) { 
            $cell = $sheetdata[$baris][$kolom];
            $sebaris[]=$cell;
        }
        $tamplate = $connection->prepare("INSERT INTO dataset ($linefields) VALUES ($linettanya)");
        $tamplate->bind_param($linetypedata, ...$sebaris);
        $tamplate->execute();
        unset($sebaris);
    }    
}



?>
<div class="headermc1" style="justify-content: space-between;">
                <div class="kiri">
                    <h1>Dataset</h1>
                </div>
                <div class="kanan">
                <a href="profil.php" style="display: flex; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 5px;">account_circle</span><span>Admin</span></a>
                </div>
</div>

<div class="content">
    <div class="form">
        <div class="dataset">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="inputanfile">
                <h4>Input data ke database</h4>
                <input type="file" name="file" id="file" required>
                <button type="submit" name="kirimfile" id="kirimfile">Input</button>                
            </div>
        </form>
        <a href="algoritmaC45.php?action=proses"><button>Proses Data</button></a>
        </div>
    </div>

        <div class="tablenya" style="width: 161vh; box-sizing: border-box;">
                    <table border="1" cellpadding="3" cellspacing="0">
                        <?php
                        echo "<tr>";
                        echo "<th>Kasus</th>";  
                        
                        $nmtampilSQL = "DESCRIBE dataset";
                        $nmtampilPick = mysqli_query($connection,$nmtampilSQL);

                        while ($row = mysqli_fetch_assoc($nmtampilPick)) {
                            echo"<th>".$row['Field']."</th>";
                            $arrnmfield[] = $row['Field'];
                        }

                        echo "</tr>";
                        
                        $jmlfields2 = count($arrnmfield) ;

                        $sql = "SELECT dataset.* FROM dataset";
                        $symptom = mysqli_query($connection,$sql);

                        $no = 0;

                        while ($row2=mysqli_fetch_array($symptom))
						{
                            $no++;
                        echo"<tr>";
                            echo"<td>$no</td>";
                            for ($j=0; $j <$jmlfields2 ; $j++) { 
                                echo "<td>".$row2[$arrnmfield[$j]]."</td>";                                
                            }
                        echo"</tr>";
						}
                        ?>
                    </table>
        </div>
</div>