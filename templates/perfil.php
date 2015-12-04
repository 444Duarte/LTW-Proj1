<!DOCTYPE HMTL>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="../css/perfil.css">
</head>

  <?php
	include_once 'database/access_db.php';

	$user = getUserByID($idUser);
		
 ?>
  <div id="tela">
  <h1>User Profile</h1>
    <div id="conteudo">
      <div id="userphoto"><img src="../images/avatar.png" alt="default avatar"></div>
      <h2><?php echo $user['user']; ?></h2>
      
      <section id="bio">
        <p>Ola sou o Pedro venho do Porto tenho 20 anos sou estudante da FEUP viva viva viva</p>
    </section>
      
    </div>
  </div>
</body>
</html>