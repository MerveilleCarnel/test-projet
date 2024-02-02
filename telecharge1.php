<?php 
  #require ' connect_db1.php';
require 'connect_db1.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Télécharger</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #282C34;
      color: #FFFFFF;
    }
    h1 {
      text-align: center;
    }
    .file-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      grid-gap: 20px;
      list-style-type: none;
      padding: 0;
    }
    .file-item {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
      box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      background-color: #363E4F;
    }
    .file-item:hover {
      transform: translateY(-5px);
    }
    .file-name {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .file-download {
      display: inline-block;
      background-color: #4CAF50;
      color: white;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }
    .file-download:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1> galerie</h1>
  <ul class="file-list">
    <?php

    
      $req = $db->query('SELECT name, file_url FROM files');

      while ($data = $req->fetch()) {
        echo '<li class="file-item">';
        echo '<span class="file-name">'.$data['name'].'</span><br>';
        echo '<a class="file-download" href="'.$data['file_url'].'">Télécharger</a>';
        echo '</li>';

      }


    ?>

    <!-- Bouton de partage Facebook -->
<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($meme_file_path); ?>" target="_blank">Partager sur Facebook</a>

<!-- Bouton de partage Twitter -->
<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($meme_file_path); ?>&text=Regardez ce mème amusant!" target="_blank">Partager sur Twitter</a>
  </ul>
</body>
</html