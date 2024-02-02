<?php
require 'connect_db1.php';

if (!empty($_FILES)) {
  $file_name = $_FILES['fichier']['name'];
  $message=$_POST['message'];
  $file_extension = strrchr($file_name, ".");

  $file_tmp_name = $_FILES['fichier']['tmp_name'];
  $file_dest = 'fichiers/' . $file_name;

  $extensions_autorisees = array('.png', '.jpeg','.jpg');


  if (in_array($file_extension, $extensions_autorisees)) {
    if (move_uploaded_file($file_tmp_name, $file_dest)) {
      $req = $db->prepare('INSERT INTO files (name, file_url) VALUES (?, ?)');
      $req->execute(array($file_name, $file_dest));

//recupere l'id du fichier inséré

$file_id = $db->lastInsertId();
//récupérer le chemin du fichier à partir de la base de données en utilisant l'ID du fichier

$req = $db->prepare('SELECT file_url FROM files WHERE id = ?');
$req->execute([$file_id]);
$file_path = $req->fetchColumn();




//chargéé l'image tétéchargé
//$image = imagecreatefromjpeg($file_path);

if ($file_extension == '.png') {
    $image = imagecreatefrompng($file_path);
} elseif ($file_extension == '.jpeg' || $file_extension == '.jpg') {
    $image = imagecreatefromjpeg($file_path);
}




//obtenir les dimensions actuelles de l'image à l'aide de imagesx() et imagesy() :
$original_width = imagesx($image);
$original_height = imagesy($image);

//définir les nouvelles dimensions souhaitées pour l'image :


$new_width = 400;  // Nouvelle largeur souhaitée
$new_height = 300;  // Nouvelle hauteur souhaitée
//$resized_image = imagescale($image, $new_width, $new_height);

//créer une nouvelle image avec les dimensions souhaitées à l'aide de imagecreatetruecolor() et utiliser imagecopyresampled() pour copier et redimensionner l'image originale dans la nouvelle image :

$resized_image = imagecreatetruecolor($new_width, $new_height);
imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);







//définir le type de contenu de l'image et afficher l'image modifiée 

header('Content-Type: image/jpeg');
imagejpeg($resized_image);

//pour liberer la memoire
imagedestroy($image);
imagedestroy($resized_image);





     echo "Fichier envoyé avec succès";



    } else {
      echo "Une erreur est survenue lors de l'envoi du fichier";
    }
  } else {
   echo "Seuls les fichiers image sont autorisés";
  }
}






?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--<title>Publication de de fichier PDF</title>-->
    <style>
        body {
            background-color: #222;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #fff;
        }

        form {
            margin-top: 20px;
        }

        input[type="file"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #555;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body style="
           
            justify-content: center;
            margin-left: 35%;
            ">



<form method="POST" enctype="multipart/form-data">
  
   <br><br><br> <input type="file" name="fichier" style="display:flex;margin-right: 500px;"><br>
   <textarea name="message" placeholder="message" ></textarea><br>
    <input type="submit" value="Aperçu réel">
   
    <!---<input type="submit" value="partager">-->

</form>
 <button id="affiche" >afficher</button>


<script type="text/javascript">
    var affiche=document.getElementById("affiche");
    affiche.onclick = function() {
        window.location.href="telecharge1.php"
    };
</script>
</body>
</html>