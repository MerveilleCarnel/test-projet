<?php
    require_once './includes/header.php';
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "generateur";

$conn = new mysqli($servername, $username, $password, $dbname);
// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        // Récupération des valeurs soumises dans le formulaire
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Requête SQL pour vérifier si les champs existent dans la base de données
        $sql = "SELECT * FROM users WHERE username='$username' AND email='$email' AND password='$password'";
        $result = $conn->query($sql);

        // Vérification du résultat de la requête
        if ($result->num_rows > 0) {
            // Les champs existent dans la base de données
            header("location: homeAbonne.php");
        } else {
            // Les champs n'existent pas dans la base de données
            header("location: ../../devoir test/envoyer_ep.php");
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
    }
?>

<div class="col-md-8 col-md-offset-2">
    <h1 style="color: #fff;">Se connecter</h1>
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
           
            <input type="submit" class="btn btn-primary" value="connexion">
        </fieldset>
    </form>
</div>

<?php
    require_once './includes/footer.php';
?>