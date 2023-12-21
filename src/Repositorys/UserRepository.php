<?php

namespace August\Repositorys;

use August\Entitys\UserEntity;

class UserRepository extends AbstractRepository
{

    private $user;

    //verification de l'eamil
    public function isEmailUsed($email)
    {
        global $pdo;

        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }


    //methode pour enregistré un utilisateur
    public function registerUser(UserEntity $user)
    {
        // Vérifier si l'e-mail est déjà utilisé
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user->getEmail()]);

        if ($stmt->fetch()) {
            return false;
        }

        $query = "INSERT INTO users (name, surname, email, password, role) VALUES (:name, :surname, :email, :password, :role)";

        $statment = $this->connection->prepare($query);

        $params = [
            "name" =>  $user->getName(),
            "surname" => $user->getSurname(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "role" => $user->getRole()
        ];

        $resultat = $statment->execute($params);
        return $resultat;
    }

    //methode de connection de l'utilisateur
    // authentification candidat......................
    public function authentificateUser(UserEntity $user)
    {
        $password = $user->getPassword();
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $params = [
            "email" => $user->getEmail(),
        ];

        $stmt->execute($params);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            $newUser = new UserEntity();
            $newUser->setId($user['id'])
                ->setName($user['name'])
                ->setSurname($user['surname'])
                ->setEmail($user['email'])
                ->setPassword($user['password'])
                ->setRole($user['role']);
            return $newUser;
        } else {
            return false;
        }
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE id = :user_id";
        $stmt = $this->connection->prepare($sql);

        $params = ["user_id" => $userId];

        $stmt->execute($params);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        $newUser = new UserEntity;

        $newUser->setId($user["id"])
            ->setName($user["name"])
            ->setSurname($user["surname"])
            ->setEmail($user["email"])
            ->setPassword($user["password"])
            ->setRole($user["role"]);

        return $newUser;
    }

    public function authentificateAdministrator($administrator)
    {
        $password = $administrator->getPassword();
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $params = [
            "email" => $administrator->getEmail(),
        ];
        $stmt->execute($params);
        $administrator = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($administrator && password_verify($password, $administrator["password"]) && $administrator["role"] == "admin") {
            return $administrator;
        } else {
            return false;
        }
    }

    public function userUpdate($newUser)
    {
        $sql = " UPDATE users SET name = :name, email = :email, password = ;password WHERE id = :id";
    }
}
