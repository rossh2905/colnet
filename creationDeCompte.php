<!DOCTYPE html>
<html>

<head>
    <title>Création de compte | O'Sullivan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.png">
</head>

<body>
<div class="login-root">
    <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-bottom--24 flex-flex flex-justifyContent--center">
            <img src="logo.png" width="120px">
        </div>
        <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <p>Vous avez déjà un compte? <a href="pageConnexion.php">Se connecter</a></p>
                <span class="padding-bottom--15">Veuillez vous connecter</span>
                
                
                <form method="post" action="creationDeCompte.php">
                    <div class="field padding-bottom--24">
                        <label for="nom">Nom complet</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="cPostal">Code postal</label>
                        <input type="text" id="cPostal" name="cPostal" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <div class="grid--50-50">
                            <label for="mdp">Mot de passe</label>
                        </div>
                            <input type="password" id="mdp" name="mdp" required>
                        </div>
                    <div>
                        <span class="field padding-bottom--24 inline">
                            <input type="submit" name="submit" value="S'enregistrer">
                        </span>
                    </div>
                    
                </form>
                
                <?php
                    if (isset($_POST["submit"])){
                        include "connexion.php";

                        $nom = $_POST["nom"];
                        $username = $_POST["username"];
                        $codePostal = $_POST["cPostal"];
                        $email = $_POST["email"];
                        $mdp = $_POST["mdp"];
                        
                        $sth = $dbco->prepare(
                            "INSERT INTO utilisateur(nomComplet,username,codePostal,email,motDePasse) 
                            VALUES (:nomComplet,:username,:codePostal,:email,:motDePasse)");
                        $sth->bindValue(':nomComplet', $nom);
                        $sth->bindValue(':username', $username);
                        $sth->bindValue(':codePostal', $codePostal);
                        $sth->bindValue(':email', $email);
                        $sth->bindValue(':motDePasse', $mdp);
                        $sth->execute();

                        echo '<p>Votre compte a été créé, vous pouvez vous <a href="pageConnexion.php">connecter</a></p>';
                        
                    }      
                ?>
            </div>
        </div>
    </div>
</div>

<?php
    
?>

</body>

</html>