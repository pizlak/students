<?php

namespace app\Controller;

use app\Validator;
use app\Model\UserModel;
use app\Controller\DataBase;

class RegistrationController
{
    public function registration()
    {
        $user = new UserModel(
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['gender'],
            $_POST['gr_num'],
            $_POST['mail'],
            $_POST['sum_ege'],
            $_POST['y_o_b'],
            $_POST['local_town']
        );


        $auth = new DataBase();
        if ($auth->authorisation($_POST['last_name'], $_POST['mail'])) {
            echo 'Данная электронная почта уже занята';
        } else {
            $errors = (new Validator)->validateNewUser($user);
            if ($errors) {
                header('Location: /');
            } else {
                $this->createUser($user);
                header('Location: /redactor');
            }
        }
    }

    public function authorisation()
    {
        $auth = new DataBase();
        if ($auth->authorisation($_POST['last_name'], $_POST['mail'])) {
            $user = new UserModel(
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['gender'],
                $_POST['gr_num'],
                $_POST['mail'],
                $_POST['sum_ege'],
                $_POST['y_o_b'],
                $_POST['local_town']
            );

            setcookie("mail", $_POST['mail'], time() + 60 * 60 * 24 * 365 * 10, "/");
            header('Location: /redactor');
            include PATH . 'views/editForm.tpl.php';
        } else {
            echo 'Пользователь не найден. Проверьте корректность введенных данных';
        }
    }

    public function viewAuthorisationForm()
    {
        include PATH . 'views/authorisationForm.tpl.php';
    }

    public function viewEditForm()
    {
        if (!isset($_COOKIE['mail'])) {
            header('Location: /');
        }
        $user = UserModel::getByEmail($_COOKIE['mail']);

        $errors = [];
        include PATH . 'views/editForm.tpl.php';
    }

    public function updateUser()
    {
        $user = UserModel::getByEmail($_COOKIE['mail']);
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->gender = $_POST['gender'];
        $user->group_num = $_POST['gr_num'];
        $user->mail = $_POST['mail'];
        $user->sum_ege = $_POST['sum_ege'];
        $user->y_o_birth = $_POST['y_o_b'];
        $user->local_town = $_POST['local_town'];
        $errors = (new Validator)->validateUpdateUser($user);
        if (!$errors) {
            $user->update();
            setcookie("mail", $user->getMail(), time() - 60 * 60 * 24 * 365 * 10, "/");
            if ($user->getMail() && $user->getLastName()) {
                setcookie("mail", $user->getMail(), time() + 60 * 60 * 24 * 365 * 10, "/");
            }
        }
        include PATH . 'views/editForm.tpl.php'; // изменение
    }

    private function createUser(UserModel $user)
    {
        $user->save();
        if ($user->getMail() && $user->getLastName()) {
            setcookie("mail", $user->getMail(), time() + 60 * 60 * 24 * 365 * 10, "/");
        }
    }

}