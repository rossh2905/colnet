<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un groupe | O'Sullivan</title>
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
                <p>Retour à <a href="accueil.php">l'accueil</a></p>
                <span class="padding-bottom--15">Ajouter un groupe</span>
                
                
                <form method="post" action="ajouterUnGroupe.php">
                    <div class="field padding-bottom--24">
                        <label for="code">Code</label>
                        <input type="text" id="code" name="code" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="field padding-bottom--24 select">
                        <label for="type">Choisir un type</label>
                        <select id="type" name="type" required>
                            <option value="En ligne">En ligne</option>
                            <option value="En classe">En classe</option>
                            <option value="Hybride">Hybride</option>
                        </select>
                    </div>
                    <div>
                        <span class="field padding-bottom--24 inline">
                            <input type="submit" name="submit" value="Ajouter">
                        </span>
                    </div>
                    
                </form>
                
                <?php
                    if (isset($_POST["submit"])){
                        include "connexion.php";

                        $code = strtoupper($_POST["code"]);
                        $nom = $_POST["nom"];
                        $type = $_POST["type"];

                        $sth = $dbco->prepare(
                            "INSERT INTO groupe(code,nom,type) 
                            VALUES (:code,:nom,:type)");
                        $sth->bindValue(':code', $code);
                        $sth->bindValue(':nom', $nom);
                        $sth->bindValue(':type', $type);
                        $sth->execute();

                        echo "<p>Le groupe " . $nom . " a été créé.<br>Retourner à <a href='accueil.php'>l'accueil</a></p>";
                        
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