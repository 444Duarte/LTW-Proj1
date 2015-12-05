<!DOCTYPE HMTL>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="css/mainpage.css">
    <link rel="stylesheet" type="text/css"  href="css/perfil.css">    
</head>

<?php
    include_once 'database/connect.php';
    include_once 'database/access_db.php';
    $idUser = $_GET['user'];

    $user = getUserByID($idUser);
    $profile = getUserProfileByID($idUser);
?>

<body> 
    <?php 
        include 'templates/topbar.php';
        include 'templates/leftbar.php';
    ?>
    <div id="tela">
        <h1>User Profile</h1>
        <div id="conteudo">
            <div id="userphoto">
                <img src ="<?php  echo $profile['image']; ?>"/>
            </div>
            <h2><?php echo $user['user']; ?></h2>
    
            <section id="bio">
                <p><?php echo $profile['description']; ?></p>
            </section>
        </div>
    </div>
</body>
</html>