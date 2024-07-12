<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="class1.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Admin - Formulaires</title>
</head>

<body class="bodyAdmin">
    <?php
    session_start();
    if (!isset($_SESSION['logged_in']) || !in_array($_SESSION['logged_in'], [1, 2, 3, 4])) {
        header('Location: home.php');
        exit();
    }

    // Requête pour l'id utilisateur
    $db = new mysqli('localhost', 'root', '', 'alt_sup_project');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $email = $_SESSION['email'];
    $queryEmail = "SELECT id_utilisateur FROM utilisateurs WHERE email=?";
    $stmt = $db->prepare($queryEmail);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id_utilisateur = $row['id_utilisateur'];
    $stmt->close();
    ?>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
            <a name="home" class="navLogo" href="home.php" style=""><img src="logo.png" class="logo"></img></a>
            <a class="navA" href="SuiveursAlternant.php">Menu</a>
            <a class="navA" href="suivi_tuteur.php">Faire un suivi</a>
            <a class="navA" href="listeSuivis.php">Liste des suivis</a>
        </div> 
        <div class="divTime">
            <?php
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $sqlSelect = "SELECT prenom FROM utilisateurs WHERE email=?";
                $stmt = $db->prepare($sqlSelect);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $username = $row['prenom'];
                    echo "<a class='name'>Bienvenue $username</a>";
                } else {
                    echo "Utilisateur inconnu";
                }
                $stmt->close();
            } else {
                header("Location: home.php");
                exit();
            }
            ?>
            <?php echo "<a class='time' id='clock'></a>"; ?>
        </div>
    </nav>

    <div class="containerAdmin text-center">
        <div class="divAdminMenu bg-light">
            <div class="col">
                <div class="divTitle">
                    <h1>Liste des formulaires</h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom Étudiant</th>
                            <th>Prénom Étudiant</th>
                            <th>Nom Entreprise</th>
                            <th>Nom Tuteur</th>
                            <th>Poste Étudiant</th>
                            <th>Missions</th>
                            <th>Commentaires</th>
                            <th>Ponctualité</th>
                            <th>Capacité Intégration</th>
                            <th>Sens Organisation</th>
                            <th>Sens Communication</th>
                            <th>Travail Équipe</th>
                            <th>Réactivité</th>
                            <th>Persévérance</th>
                            <th>Force Proposition</th>
                            <th>Projets Semestre</th>
                            <th>Axes Amélioration</th>
                            <th>Points Forts</th>
                            <th>Mémoire Master</th>
                            <th>Poursuite Études</th>
                            <th>Projet Recrutement</th>
                            <th>Format Suivi</th>
                            <th>Nom Suiveur</th>
                            <th>Prénom Suiveur</th>
                            <th>Date Suivi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM formulaire";
                        $result = $db->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>".$row['nom_etudiant_formulaire']."</td>
                                    <td>".$row['prenom_etudiant_formulaire']."</td>
                                    <td>".$row['nom_entreprise_formulaire']."</td>
                                    <td>".$row['nom_tuteur_formulaire']."</td>
                                    <td>".$row['poste_etudiant_formulaire']."</td>
                                    <td>".$row['missions_etudiant_formulaire']."</td>
                                    <td>".$row['commentaires_formulaire']."</td>
                                    <td>".$row['ponctualite_formulaire']."</td>
                                    <td>".$row['capacite_integration_formulaire']."</td>
                                    <td>".$row['sens_organisation_formulaire']."</td>
                                    <td>".$row['sens_communication_formulaire']."</td>
                                    <td>".$row['travail_equipe_formulaire']."</td>
                                    <td>".$row['reactivite_formulaire']."</td>
                                    <td>".$row['perseverance_formulaire']."</td>
                                    <td>".$row['force_proposition_formulaire']."</td>
                                    <td>".$row['projets_semestre_formulaire']."</td>
                                    <td>".$row['axes_amelioration_formulaire']."</td>
                                    <td>".$row['points_forts_formulaire']."</td>
                                    <td>".$row['memoire_master']."</td>
                                    <td>".$row['projet_poursuite_etudes_formulaire']."</td>
                                    <td>".$row['projet_recrutement_formulaire']."</td>
                                    <td>".$row['format_suivi_formulaire']."</td>
                                    <td>".$row['nom_suiveur_formulaire']."</td>
                                    <td>".$row['prenom_suiveur_formulaire']."</td>
                                    <td>".$row['date_suivi_formulaire']."</td>
                                </tr>";
                            }
                        }
                        $db->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="time.js"></script>
</body>
</html>
