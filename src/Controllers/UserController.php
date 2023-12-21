<?php

namespace August\Controllers;

use August\Controllers\AbstractController;
use August\Entitys\UserEntity;
use August\Services\UserService;

class UserController extends AbstractController
{
    private $userService;
    private $messages;
    public function __construct()
    {
        $this->userService = new UserService;
    }
    //methode register User
    public function registerUser()
    {
        if ($this->loged("user" or "admin" or "super_admin")) {
            $this->redirect("/");
        }

        if ($this->hasPosted()) {
            $profil_tof = $_FILES["profil"];
            $name = $_POST["name"];
            $sur_name = $_POST["surname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["password_confirm"];
            if ($password != $confirm_password) {
                $this->messages["error"] = "mot de pass non identique";
                $data = [
                    "error" => $this->messages["error"]
                ];
                return $this->renderView("/user/register-user", $data);
            }
            //cryptage mot de pass
            $password_h = password_hash($password, PASSWORD_DEFAULT);
            $profil = $this->imageUploaded($profil_tof);

            $user = new UserEntity();
            $user->setName($name)
                ->setSurname($sur_name)
                ->setEmail($email)
                ->setPassword($password_h)
                ->setRole($user->getDeafaultRole());
            $resultat = $this->userService->registerUser($user);
            if ($resultat) {
                $this->messages["succes"] = "Bien Enregistré";
                $this->redirect("/login");
            } else {
                $this->messages["error"] = "l'utilisateur existe deja ";
            }
            $data = [
                "error" => $this->messages["error"] ?? ""
            ];
            return $this->renderView("/user/register-user", $data);
        }

        $this->renderView("/user/register-user");
    }

    //methode login user
    public function loginUser()
    {
        if ($this->loged("user")) {
            $this->redirect("/");
        }

        if ($this->hasPosted()) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = new UserEntity();
            $user->setEmail($email)->setPassword($password);
            $newUser = $this->userService->authentificateUser($user);
            if ($newUser instanceof UserEntity) {
                $_SESSION["user"] = ["id" => $newUser->getId(), "role" => $newUser->getRole()];
                header("Location:/");
                exit(502);
            } else {
                $this->messages["error"] = "Verifier vos informations ";
            }
            $data = [
                "error" => $this->messages["error"] ?? "",
                "succes" => $this->messages["succes"] ?? ""
            ];
            return $this->renderView("/user/login-user", $data);
        }
        $data = [
            "error" => $this->messages["error"] ?? "",
            "succes" => $this->messages["succes"] ?? ""
        ];

        $this->renderView("/user/login-user", $data);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /');
        exit();
    }
}
