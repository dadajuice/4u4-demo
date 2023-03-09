<?php

require_once __DIR__ . "/../Database.php";

class UserBroker
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function findByCredentials(string $username, string $password): ?stdClass
    {
        $password = hash('sha256', $password);
        $sql = "SELECT * 
                  FROM authentication 
                 WHERE username = '$username' 
                   AND password = '$password'";
        return $this->database->selectOne($sql);
    }

    public function insert(stdClass $user): void
    {
        $user->password = hash('sha256', $user->password);
        $sql = "INSERT INTO authentication(username, password, firstname, lastname, email) 
            VALUES ('$user->username', 
                    '$user->password', 
                    '$user->firstname', 
                    '$user->lastname', 
                    '$user->email')";
        $this->database->query($sql);
    }
}
