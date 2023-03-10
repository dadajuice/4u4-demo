<?php

require_once "../app/Models/Brokers/UserBroker.php";
require_once "../app/Models/Flash.php";
session_start();

if (isset($_POST['submit'])) {

    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $broker = new UserBroker();
    $user = $broker->findByCredentials($username, $password);
    if (is_null($user)) {
        Flash::error("Authentifiants invalides.");
        header("Location: login.php");
        exit;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="stylesheets/style.css" rel="stylesheet" />
</head>
<body>
    <h1 class="intro-title">Authentification</h1>
    <div class="d-flex justify-content-center">
        <main>
            <?php Flash::displayAll(); ?>
            <form action="login.php" method="post">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" id="username" />

                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="password" />

                <div class="mt-3 text-end">
                    <button name="submit" class="btn btn-success" type="submit">Connecter</button>
                </div>
            </form>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
<?php
    unset($_SESSION['error']);
    unset($_SESSION['success']);
?>

