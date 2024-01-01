<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Penyakit Tanaman Manggis</title>
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="stylegen.css">
    <style>
        .navbar{
            color: #5E4DAB;
            background-color: transparent;
        }
        .navbar .menu li a{
            color: #5E4DAB;
        }
        .logo-balitbu span{
            font-size:24px;
        }
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>

    <div class="content-home">
        <div class="home-1">
            <div class="home-1dlm">
                <div class="welcometext">
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo '<h1>Hallo, ' . $_SESSION['nama'] . '</h1>';
                    } else {
                        echo '<h1>Hallo, Selamat Datang</h1>';
                    }
                    ?>
                    <p style="font-size: 24px;">Selamat Datang di Sistem Pendiagnosa Penyakit pada Tanaman Manggis Menggunakan Algoritma C4.5 dan Metode Certainty Factor</p>
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo '<a href="consultationPage.php" style="box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25); background-color: #5E4DAB; color: white; padding: 10px 10px; border-radius: 5px; ">Mulai Mendiagnosa ==></a>';
                    } else {
                        echo '<a href="login.php" class="tombolhome signin">Sign in</a>
                             <a href="registrasi.php" class="tombolhome signup">Sign up</a>';
                    }
                    ?>
                </div>
                <div class="gambarmanggis">
                    <img src="image/manggis-home.png" alt="manggis-home.png" width="600px">
                </div>
            </div>
        </div>

        <div class="home-2">
            <div class="tom manfaat">
                <div class="manfaattxt" style="margin-right: 30px;">
                    <h2 data-aos="fade-right">Manfaat Buah Manggis</h2>
                    <ul>
                        <li data-aos="fade-right" data-aos-delay="100"><strong>Menurunkan berat badan</strong>,Hal ini dipercaya karena manggis mengandung zat antiradang yang berpengaruh terhadap peningkatan metabolisme lemak, sehingga bisa dimanfaatkan untuk mengatasi berat badan berlebih.</li>
                        <li data-aos="fade-right" data-aos-delay="200"><strong>Meningkatkan daya tahan tubuh</strong>, Kandungan vitamin C pada buah manggis diduga bermanfaat untuk meningkatkan daya tahan tubuh.</li>
                        <li data-aos="fade-right" data-aos-delay="300"><strong>Mengontrol kadar gula darah</strong>, Hal ini karena manggis mengandung serat yang mampu menstabilkan kadar gula darah. Selain kandungan serat dalam manggis, kandungan xanthones pada buah ini juga diklaim mampu menstabilkan kadar gula darah</li>
                        <li data-aos="fade-right" data-aos-delay="400"><strong>Meredakan radang sendi</strong>, Kandungan xanthones dalam buah manggis yang juga berfungsi sebagai antiradang, turut mengurangi rasa sakit akibat peradangan dalam tubuh, misalnya nyeri akibat radang sendi.</li>
                        <li data-aos="fade-right" data-aos-delay="500"><strong>Mencegah penyakit kanker</strong>, Hal ini karena manggis mengandung zat xanthones yang bersifat antioksidan, sehingga mampu melawan perkembangan dan penyebaran sel kanker dalam tubuh.</li>
                    </ul>
                </div>
                <div data-aos="fade-left" data-aos-duration="600" data-aos-delay="150" class="manfaatimg">
                    <img src="image/manggis-home2.jpg" alt="gambar" width="500px" style="border-radius: 50px;">
                </div>
            </div>

            <div data-aos="fade-right" data-aos-delay="100" class="tom sp">
                <div class="spimg" style="margin-right: 30px;">
                    <img src="image/sistempakar.jpg" alt="Sistem Pakar" width="500px" style="border-radius: 50px;">
                </div>
                <div class="sptxt">
                    <h2 data-aos="fade-left" data-aos-delay="200">Apa itu Sistem Pakar?</h2>
                    <p data-aos="fade-left" data-aos-delay="300" style="text-indent: 45px;">Sistem pakar atau <i>Expert System</i> biasa disebut juga dengan <i>Knowledge Based System</i> yaitu suatu aplikasi
                        computer yang ditunjukkan untuk membantu pengambilan keputusan atau pemecahan dan persoalan dalam bidang yang spesifik. Sistem ini bekerja dengan menggunakan pengetahuan
                        motode analisis yang telah didefinisikan terlebih dahulu oleh Pakar yang sesuai dengan bidang keahliannya.</p>
                </div>
            </div>

            <div class="tom penyakitmang">
                <div class="penyakitmangtxt">
                    <h2 data-aos="fade-right" data-aos-delay="100">Penyakit-penyakit Tanaman Manggis</h2>
                    <p data-aos="fade-right" data-aos-delay="200" style="text-indent: 45px;">Beberapa penyakit pada pohon manggis antara lain getah kuning, jamur upas, busuk buah, bercak daun dan <a href="daftarPenyakit.php" style="color: red;">sebagainya...</a> </p>
                </div>
                <div data-aos="fade-left" data-aos-delay="100" class="penyakitmangimg">
                    <img src="image/manggis-home3.jpg" alt="penyakit manggis" width="500px" style="border-radius: 50px;">
                </div>
            </div>

            <div class="tahapandiagnosa" id="petunjuk" style="margin-bottom:20vh;">
                <h2 data-aos="zoom-in" style="text-align: center;">Tahapan Diagnosa</h2>
                <div class="thp-utama">
                    <div data-aos="fade-up" class="thp"><span class="material-symbols-outlined" style="font-size:50px; align-items: center;">inventory</span><span>Isi Data Diri</span></div>
                    <div data-aos="fade-up" data-aos-delay="50" class="thp"><span class="material-symbols-outlined" style="font-size:50px;">fact_check</span><span>Jawab Pertanyaan</span></div>
                    <div data-aos="fade-up" data-aos-delay="100" class="thp"><span class="material-symbols-outlined" style="font-size:50px;">plagiarism</span><span>Lihat Hasil Diagnosa</span></div>
                    <div data-aos="fade-up" data-aos-delay="150" class="thp"><span class="material-symbols-outlined" style="font-size:50px;">description</span><span>Dapatkan Arahan dan Saran</span></div>
                </div>
            </div>
        </div>

        <div class="home-3">
            <form name="contact">
                <h1 style="text-align: center;">Contact</h1>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email">
                <label for="pesan">pesan</label>
                <textarea name="pesan" id="pesan" cols="30" rows="10" style="resize: vertical;"></textarea>
                <button type="submit" class="tombol-kirim" name="kirim" style=" color: white; height:40px; width: 80px; margin-top: 15px; background-color: #5E4DAB;">Kirim</button>
            </form>
        </div>
        <div class="footer">
            <p style="text-align: center;"><i>Copyright &copy; 2023 by Muhammad Ikhsan</i></p>
        </div>
    </div>


    <script>
        const scriptURL = 'https://script.google.com/macros/s/AKfycbyuzRFGfKbkqHLYUUGrp4D8tkIloYstQECqs18Q0-bXMG1hHJ5W1Yfk7_ce5TjjiMI5tg/exec'
        const form = document.forms['contact']

        form.addEventListener('submit', e => {

            e.preventDefault()
            fetch(scriptURL, {
                    method: 'POST',
                    body: new FormData(form)
                })
                .then(response => console.log('Success!', response))
                .catch(error => console.error('Error!', error.message))
            alert('Terima Kasih Telah Mengirim Pesan')
            document.getElementById("nama").value = "";
            document.getElementById("email").value = "";
            document.getElementById("pesan").value = "";
        })
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: "900",
        });
    </script>
</body>

</html>