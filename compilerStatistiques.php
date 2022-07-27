<!DOCTYPE html>
<html>

<head>
    <title>Statistiques | O'Sullivan</title>
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
                <span class="padding-bottom--15">Voici les statistiques</span>
                
                <?php
                    include "connexion.php";

                    $statement = $dbco->prepare("SELECT * FROM etudiant");
                    $statement->execute();

                    $nombreEtudiant = $statement->fetchAll(PDO::FETCH_ASSOC);

                    //nombre réussite
                    $statement = $dbco->prepare("SELECT * FROM etudiant WHERE moyenne >= 12");
                    $statement->execute();

                    $reussi = $statement->fetchAll(PDO::FETCH_ASSOC);
                    
                    //taux réussite L
                    $statement = $dbco->prepare("SELECT * FROM etudiant WHERE codeGroupe LIKE '%L'");
                    $statement->execute();

                    $nombreEtudiantL = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $statement = $dbco->prepare("SELECT * FROM etudiant WHERE moyenne >= 12 AND codeGroupe LIKE '%L'");
                    $statement->execute();

                    $reussiL = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $tauxReussiteL = (count($reussiL) / count($nombreEtudiantL)) * 100;
                    
                    //taux réussite C
                    $statement = $dbco->prepare("SELECT * FROM etudiant WHERE codeGroupe LIKE '%C'");
                    $statement->execute();

                    $nombreEtudiantC = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $statement = $dbco->prepare("SELECT * FROM etudiant WHERE moyenne >= 12 AND codeGroupe LIKE '%C'");
                    $statement->execute();

                    $reussiC = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $tauxReussiteC = (count($reussiC) / count($nombreEtudiantC)) * 100;
                    
                    //taux réussite H
                    $statement = $dbco->prepare("SELECT * FROM etudiant WHERE codeGroupe LIKE '%H'");
                    $statement->execute();

                    $nombreEtudiantH = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $statement = $dbco->prepare("SELECT * FROM etudiant WHERE moyenne >= 12 AND codeGroupe LIKE '%H'");
                    $statement->execute();

                    $reussiH = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $tauxReussiteH = (count($reussiH) / count($nombreEtudiantH)) * 100;


                    echo "
                        <span class='stats'><span style='color: #7ba32d;'>" . count($nombreEtudiant) . "</span> étudiants ont été évalués</span>
                        <span class='stats'><span style='color: #7ba32d;'>" . count($reussi) . "</span> étudiants réussi</span>
                        <span class='stats'>Le taux de réussite en Ligne est <span style='color: #7ba32d;'>" . round($tauxReussiteL) . "</span>%</span>
                        <span class='stats'>Le taux de réussite en Classe est <span style='color: #7ba32d;'>" . round($tauxReussiteC) . "</span>%</span>
                        <span class='stats'>Le taux de réussite en Hybride est <span style='color: #7ba32d;'>" . round($tauxReussiteH) . "</span>%</span>
                    ";

                ?>
            
            </div>
        </div>
    </div>
</div>
</body>

</html>