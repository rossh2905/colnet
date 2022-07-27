<!DOCTYPE html>
<html>

<head>
    <title>Données | O'Sullivan</title>
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
                <span class="padding-bottom--15">Veuillez appliquer vos filtres</span>
                
                <form method="post" action="afficherDonnees.php">
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
                    <div class='field padding-bottom--24 select'>
                        <label for='order'>Tri sur la moyenne</label>
                        <select id='order' name='order' required>
                            <option value='ASC'>Ascendant</option>
                            <option value='DESC'>Descendant</option>
                        </select>
                    </div>
                    <table>
                        <tr>
                            <th>Code permanent</th>
                            <th>Nom complet</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Moyenne</th>
                            <th>Groupe</th>
                        </tr>
                        <?php
                            include "connexion.php";
                            
                            if(isset($_POST["submit"])){
                                
                                $groupe = $_POST["groupe"];
                                $order = $_POST["order"];
                                
                                $statementDONNEES = $dbco->prepare("SELECT * FROM etudiant WHERE codeGroupe = :codeGroupe ORDER BY moyenne " . $order);
                                
                                $statementDONNEES->bindParam(':codeGroupe', $groupe);
                                $statementDONNEES->execute();
                                $resultDONNEES = $statementDONNEES->fetchAll(PDO::FETCH_ASSOC);
                                
                                for ($i = 0; $i <= count($resultDONNEES) - 1; $i++) {
                                    echo "
                                        <tr>
                                            <td>" . $resultDONNEES[$i]['codePermanent'] . "</td>
                                            <td>" . $resultDONNEES[$i]['nomComplet'] . "</td>
                                            <td>" . $resultDONNEES[$i]['adresse'] . "</td>
                                            <td>" . $resultDONNEES[$i]['telephone'] . "</td>
                                            <td>" . $resultDONNEES[$i]['moyenne'] . "</td>
                                            <td>" . $resultDONNEES[$i]['codeGroupe'] . "</td>
                                        </tr>
                                    ";
                                }

                            } 
                        ?>
                    </table>
                    <div>
                        <span class="field padding-bottom--24 inline">
                            <input type="submit" name="submit" value="Afficher les résultats">
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>