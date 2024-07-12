<!doctype html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="class1.css?<?php echo time(); ?>" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title>SuiveursAlternant</title>
    </head>
    <body class="bodyAdmin">
        <?php
            session_start();
            if (!isset($_SESSION['logged_in']) || !in_array($_SESSION['logged_in'], [1, 2, 3, 4])) {
                header('Location: home.php');
                exit();
            }
            

            //Requête pour l'id
            $db=new PDO('mysql:host=localhost;dbname=alt_sup_project;charset=utf8mb4', 'root', '');
            $email=$_SESSION['email'];
            $queryEmail="SELECT id_utilisateur FROM utilisateurs WHERE email= :email";
            $stmt = $db->prepare($queryEmail);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_utilisateur = $row['id_utilisateur'];
        ?>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header">
                <a name="home" class="navLogo" 

                <?php
                    if (isset($_POST['home'])) {
                        session_destroy();
                        header('Location: home.php');
                    }
                ?>
                href="home.php" style=""><img src="logo.png" class="logo"></img></a>
                <a class="navA" href="SuiveursAlternant.php">Menu</a>
                <a class="navA" href="suivi_tuteur.php">Faire un suivi</a>
                <a class="navA" href="listeSuivis.php">liste des suivis</a>

            </div> 
            <div class="divTime">
                <?php

                    if(isset($_SESSION['email'])) {
                        $email = $_SESSION['email'];
                        $db = mysqli_connect('localhost', 'root', '', 'alt_sup_project');
                        $sqlSelect = "SELECT prenom FROM utilisateurs WHERE email = '$email'";
                        $result = mysqli_query($db, $sqlSelect);

                        if(mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $username = $row['prenom'];
                            echo "<a class='name'>Bienvenue $username</a>";
                        } 
                            
                        else {
                            echo "Utilisateur inconnu";
                        }

                        mysqli_close($db);
                        } 
                        
                        else {
                        header("Location: home.php");
                        exit();
                    }

                ?>

              
                <?php
                    echo "<a class='time' id='clock'></a>"; 
                ?>
            </div>

        </nav>
<body class="bodyAdmin">
<div class="containerAdmin text-center">
<div class="divAdminMenu bg-light">
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $student_firstname = $_POST['student_firstname'];
    $company_name = $_POST['company_name'];
    $tutor_name = $_POST['tutor_name'];
    $tutor_firstname = $_POST['tutor_firstname'];
    $student_position = $_POST['student_position'];
    $student_missions = $_POST['student_missions'];

    // Validation check
    if (!empty($student_id) && !empty($student_name) && !empty($student_firstname) && 
        !empty($company_name) && !empty($tutor_name) && !empty($tutor_firstname) && 
        !empty($student_position) && !empty($student_missions)) {
        
        // Process form data (e.g., store in database or send an email)
        echo "<div class='container'><div class='alert alert-success' role='alert'>Merci d'avoir répondu à ce questionnaire</div></div>";
    } else {
        echo "<div class='container'><div class='alert alert-danger' role='alert'>Veuillez remplir tout le formulaire svp !</div></div>";
    }
}
?>

<body>
    <div class="container">
        <h1 class="text-center my-4">SYNTHESE SUIVI TUTEUR </h1>
        <p class="text-justify">
            <b>Bonjour,</b><br>
            Ce questionnaire s'adresse aux suiveurs, qui représentent le campus et
            réalisent les points d'étape de mi parcours avec les tuteurs entreprise et étudiants. Pour
            rappel, chaque apprenti doit faire l'objet à minima d'un suivi annuel. Chaque suivi doit être
            enregistré via ce formulaire le jour du suivi. Ce questionnaire a pour objectif de faire la
            synthèse de l'ensemble des SUIVIS et d'alerter les équipes relations entreprise et
            pédagogique au besoin.<br>
            Bien à vous<br>
            <b>Directeur des Relations Entreprises et des Admissions</b> - <i>Sonny BRUSSEAU</i>
        </p>

        <form action="" method="post">
            <div class="mb-4">
                <h2>ETUDIANT</h2>
                <div class="form-group">
                    <label for="student_id">ID étudiant *</label>
                    <input type="number" class="form-control" name="student_id" id="student_id" required>
                </div>
                <div class="form-group">
                    <label for="student_name">NOM de l'étudiant *</label>
                    <input type="text" class="form-control" name="student_name" id="student_name" required>
                </div>
                <div class="form-group">
                    <label for="student_firstname">PRENOM de l'étudiant *</label>
                    <input type="text" class="form-control" name="student_firstname" id="student_firstname" required>
                </div>
            </div>

            <div class="mb-4">
                <h2>ENTREPRISE</h2>
                <div class="form-group">
                    <label for="company_name">Nom de l'entreprise *</label>
                    <input type="text" class="form-control" name="company_name" id="company_name" required>
                </div>
                <div class="form-group">
                    <label for="tutor_name">NOM du tuteur d'entreprise *</label>
                    <input type="text" class="form-control" name="tutor_name" id="tutor_name" required>
                </div>
                <div class="form-group">
                    <label for="tutor_firstname">PRENOM du tuteur d'entreprise *</label>
                    <input type="text" class="form-control" name="tutor_firstname" id="tutor_firstname" required>
                </div>
                <div class="form-group">
                    <label for="student_position">POSTE occupé par l'étudiant *</label>
                    <input type="text" class="form-control" name="student_position" id="student_position" required>
                </div>
                <div class="form-group">
                    <label for="student_missions">MISSIONS confiées à l'étudiant *</label>
                    <textarea class="form-control" name="student_missions" id="student_missions" required></textarea>
                </div>
            </div>

            <!-- Add more sections as needed -->

            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>
    </div>
    </div>
    </div>
    
    <script src="time.js"></script>
    </body>
</html>
