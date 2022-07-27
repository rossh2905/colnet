<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un étudiant | O'Sullivan</title>
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
                <span class="padding-bottom--15">Ajouter un étudiant</span>
                
                
                <form method="post" action="ajouterUnEtudiant.php">
                    <div class="field padding-bottom--24">
                        <label for="code">Code permanent</label>
                        <input type="text" id="code" name="code" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="nom">Nom complet</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" name="adresse" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="telephone">Télephone</label>
                        <input type="text" id="telephone" name="telephone" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <div class="grid--50-50">
                            <label for="moyenne">Moyenne</label>
                        </div>
                            <input type="text" id="moyenne" name="moyenne" required>
                        </div>
                    <div class='field padding-bottom--24 select'>
                        <label for='groupe'>Choisir un groupe</label>
                        <select id='groupe' name='groupe' required>
                            <?php
                                include "connexion.php";

                                $statementGROUPE = $dbco->prepare("SELECT code FROM groupe");
                                $statementGROUPE->execute();

                                $resultGROUPE = $statementGROUPE->fetchAll(PDO::FETCH_ASSOC);

                                for ($i = 0; $i <= count($resultGROUPE) - 1; $i++) {
                                    echo "
                                        <option value='" . $resultGROUPE[$i]["code"] . "'>" . $resultGROUPE[$i]["code"] . "</option>  
                                    ";
                                }
                            ?>
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

                        $code = $_POST["code"];
                        $nom = $_POST["nom"];
                        $adresse = $_POST["adresse"];
                        $telephone = $_POST["telephone"];
                        $moyenne = $_POST["moyenne"];
                        $groupe = $_POST["groupe"];
                        
                        $sth = $dbco->prepare(
                            "INSERT INTO etudiant(codePermanent,nomComplet,adresse,telephone,moyenne,codeGroupe) 
                            VALUES (:codePermanent,:nomComplet,:adresse,:telephone,:moyenne,:codeGroupe)");
                        $sth->bindValue(':codePermanent', $code);
                        $sth->bindValue(':nomComplet', $nom);
                        $sth->bindValue(':adresse', $adresse);
                        $sth->bindValue(':telephone', $telephone);
                        $sth->bindValue(':moyenne', $moyenne);
                        $sth->bindValue(':codeGroupe', $groupe);
                        $sth->execute();

                        echo "<p>L'étudiant(e) " . $nom . " a été ajouté(e).<br>Retourner à <a href='accueil.php'>l'accueil</a></p>";
                        
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