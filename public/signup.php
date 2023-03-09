<?php

require_once "../app/Models/Database.php";
require_once "../app/Models/Validation.php";

session_start();

$database = new Database();

if (isset($_POST['submit'])) {
    $email = $_POST['email'] ?? "";
    $firstname = $_POST['firstname'] ?? "";
    $lastname = $_POST['lastname'] ?? "";
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    $errors = [];
    if (!Validation::email($email)) {
        $errors[] = "Le courriel est invalide.";
    }
    if (empty($firstname)) {
        $errors[] = "Le prénom ne doit pas être vide.";
    }
    if (empty($lastname)) {
        $errors[] = "Le nom ne doit pas être vide.";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
        header("Location: signup.php");
        exit;
    }

    $password = hash('sha256', $password);
    $database = new Database();
    $sql = "INSERT INTO authentication(username, password, firstname, lastname, email) 
            VALUES ('$username', '$password', '$firstname', '$lastname', '$email')";
    $database->query($sql);
    $_SESSION['success'] = "Compte créé avec succès 🎉!";
    header("Location: login.php");
    exit;
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
    <h1 class="intro-title">Signup</h1>
    <div class="d-flex justify-content-center">
        <main>
            <?php
            if (!empty($_SESSION['error'] ?? "")) {
                ?>
                <div class="alert alert-danger">
                    <?php
                    if (is_array($_SESSION['error'])) {
                        ?>
                        <ul class="mb-0">
                            <?php
                            foreach ($_SESSION['error'] as $error) {
                                echo "<li>$error</li>";
                            }
                            ?>
                        </ul>
                        <?php
                    } else {
                        echo $_SESSION['error'];
                    }
                    ?>
                </div>
                <?php
                unset($_SESSION['error']);
            }
            ?>
            <form action="signup.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input name="email" type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Firstname</label>
                            <input name="firstname" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Lastname</label>
                            <input name="lastname" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <hr />
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input name="username" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="mt-3 text-end">
                    <button name="submit" class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </main>
    </div>
</body>