<?php
    include "../connection.php";
    include "session.php";

    if ($_SESSION['sebagai'] === "user") {
        header("Location: index.php");
        exit;
    }    

    if (isset($_GET['page'])) {
        $page=$_GET['page'];
    }else {
        $page="awal.php";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php
    if ($_SESSION['sebagai'] === "admin") {
        echo '<title>Admin</title>';
    }elseif ($_SESSION['sebagai'] === "pakar") {
        echo '<title>Pakar</title>';
    } 
    ?>
    <title>Admin</title>
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <div class="wrapper">   
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="main-content">
            <?php
            // $page=$_GET['page'];
            // if(empty($top)){
            // $on_page="awal.php";
            // }
            // else{
            // $on_page=$top;
            include "$page";
            
            // }
            ?>    
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
        .create( document.querySelector( '#desc' ) )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#handling' ) )
        .catch( error => {
            console.error( error );
        } );    
    </script>
</body>
</html>