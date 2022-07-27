<!DOCTYPE html>
<html>

<head>
    <title>Connexion | O'Sullivan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.png">
</head>

<body>
<div class="login-root">
    <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-bottom--24 flex-flex flex-justifyContent--center">
            <img src="logo.png" width="350px">
        </div>
        <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <span class="padding-bottom--15">Veuillez vous connecter</span>
                
                <form method="post" action="pageConnexion.php">
                    <div class="field padding-bottom--24">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="field padding-bottom--24">
                        <div class="grid--50-50">
                            <label for="mdp">Mot de passe</label>
                        </div>
                            <input type="password" id="mdp" name="mdp">
                        </div>
                    <div>
                        <span class="field padding-bottom--24 inline">
                            <input type="submit" name="submit" value="Se connecter">
                        </span>
                        <span class="field padding-bottom--24 inline">
                            <a href="creationDeCompte.php">Créer un compte</a>
                        </span>
                    </div>
                </form>
                <?php
                    include "connexion.php";
                    if(isset($_POST["submit"])){

                        $error = "<p>Mauvais nom d'utilisateur ou mauvais mot de passe. Ce compte n'existe peut être pas. <a href='creationDeCompte.php'>Créer un compte</a></p>";
                        $username = $_POST["username"];
                        $mdp = $_POST["mdp"];
                        
                        $statementMDP = $dbco->prepare("SELECT motDePasse FROM utilisateur WHERE username = :username");
                        
                        $statementMDP->bindParam(':username', $username);
                        $statementMDP->execute();
                        $resultMDP = $statementMDP->fetch(PDO::FETCH_ASSOC);

                        if ($resultMDP) {
                            if ($resultMDP['motDePasse'] == $mdp) {
                                echo "<p>Crédentiels valides, vous pouvez accéder à <a href='accueil.php'>l'accueil</a></p>";
                            }  else {
                                echo $error;
                            }
                        } else {
                            echo $error;
                        }
                    } 
                ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>