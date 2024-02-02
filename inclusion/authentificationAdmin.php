<?php

require("connexionBD.php");

$login = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * from administrateur WHERE email = '$login' AND password = '$password' ";
    
$result = mysqli_query($conn, $sql); //$conn correspond a la variable permettant la connexion a la BD

$rows = mysqli_num_rows($result);

if ($rows==1){
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            header("location: ../homeAdmin.php");
        }
if ($rows!=1){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Attention ! Identifiants invalides. Veuillez recommencer');
            window.location.href='javascript:history.go(-1)';
            </SCRIPT>");
        }


	?>