<?php

require_once "../app/Models/Database.php";

$database = new Database();
$users = $database->select("SELECT * FROM authentication");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <ul>
        <?php
            foreach ($users as $user) {
                echo "<li>" . $user->firstname . "</li>";
            }
        ?>
    </ul>
</body>
</html>