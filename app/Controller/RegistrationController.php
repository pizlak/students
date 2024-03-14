<?php

namespace app\Controller;

use app\Validator;
use app\Model\UserModel;
use app\Controller\DataBase;

class RegistrationController
{
    protected array $post;

    public function __construct(array $post)
    {
        $this->post = $post;
    }

    public function registration()
    {
        $user = new UserModel(
            $this->post['first_name'],
            $this->post['last_name'],
            $this->post['gender'],
            $this->post['gr_num'],
            $this->post['mail'],
            $this->post['sum_ege'],
            $this->post['y_o_b'],
            $this->post['local_town']
        );
        $auth = new DataBase();
        if ($auth->authorisation($this->post['last_name'], $this->post['mail'])) {
            setcookie("mail", $this->post['mail'], time() + 60 * 60 * 24 * 365 * 10, "/");
            header('Location: redactor.php');
        } else {
            $errors = (new Validator)->validateNewUser($user);
            if ($errors) {
                include PATH . 'public/index.php';
            } else {
                $this->createUser($user);
                header('Location: redactor.php');
            }
        }
    }

    public function viewEditForm()
    {
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