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
    <div id="profile">
        <h1>User Profile</h1>
        <div id="conteudo">
            <section id="profile_header">
                <img id="userphoto" src ="<?php  echo $profile['image']; ?>"/>
                <h2><?php echo $user['user']; ?></h2>
            </section>
            <br>
            <section id="bio">
                <h3>Description</h3>
                <p><?php echo $profile['description']; ?></p>
            </section>
        </div>
    </div>
</body>
</html>