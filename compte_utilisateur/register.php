
<?php
session_start();
require_once('./includes/db.php');
require_once('./includes/functions.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs saisies dans le formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si les mots de passe correspondent
    $password_confirm = $_POST['password_confirm'];
    if ($password !== $password_confirm) {
        header("location:loginmdp.php");
        exit; // Arrêter l'exécution du script si les mots de passe ne correspondent pas
    }
    


    // Connexion à la base de données
    $servername = "localhost";
    $dbname = "generateur";
    $username_db = "root";
    $password_db = "";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);

    // Vérifier si les données existent déjà dans la base de données
$stmt_check = $conn->prepare("SELECT COUNT(*) FROM user WHERE  email = :email");
//$stmt_check->bindParam(':username', $username);
$stmt_check->bindParam(':email', $email);
$stmt_check->execute();
$count = $stmt_check->fetchColumn();

if ($count > 0) {
    header("location:loginem.php");
    exit;
}


    // Préparer et exécuter la requête SQL INSERT
    $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Vérifier si l'insertion a réussi
    if ($stmt->rowCount() > 0) {
         header("location:connexion.php");;
    } else {
        echo "Une erreur s'est produite lors de l'ajout des données à la base de données.";
    }

    // Fermer la connexion à la base de données
    $conn = null;
}
?>
<?php
    require_once './includes/header.php';
?>
    <div class="col-md-8 col-md-offset-2">
        <h1 style="color: #fff;"> creer compte </h1>
    <form action="" method="post">
        <fieldset>
            
            <div class="form-group">
                <label for="pseudo">Nom d'utilisateur</label>
                <input type="text" id="pseudo" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="password">Confirmation du mot de passe</label>
                <input type="password" id="password" class="form-control" name="password_confirm">
            </div>
            <input type="submit" class="btn btn-primary" value="S'insrire">
        </fieldset>
    </form>
</div>
<?php
    require_once './includes/footer.php';
?>
