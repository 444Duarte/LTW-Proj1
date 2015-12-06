<?php

  session_start();

  include_once('../database/connect.php');
  include_once('../database/access_db.php');
  include_once('users.php');

  function printResponse($value) {
    $data = ['login' => $value];
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  $filename=  $_FILES["image"]["name"];
  if ((($_FILES["image"]["type"] == "image/gif")|| ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/png")  || ($_FILES["image"]["type"] == "image/pjpeg"))) {
    if(file_exists($_FILES["image"]["name"]))
      echo "File name exists.";
    else {
      move_uploaded_file($_FILES["image"]["tmp_name"],"../images/events/".$filename);
      echo "Upload Successful . <a href='uploads/$filename'>Click here</a> to view the uploaded image";
    }
  }
  else echo "invalid file.";


  $title = $_POST['title'];
  $date = $_POST['date'];
  $description = $_POST['description'];
  $privacy = true;

  if ($_POST['Privacy'] == "Public") {
    $privacy = false;
  }
  else $privacy = true;

  $img = "images/events/" . $filename;

  $type = $_POST['Type'];

  $idUser = $_SESSION['user'];

  createEvent($idUser, $title, $date, $description, $img, $type, $privacy);    
?>