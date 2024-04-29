<?php

namespace app\Model;

use app\Controller\DataBase;

use app\Controller\DatabaseConnection;

class UserModel
{
    public $id;
    public $first_name;
    public $last_name;
    public $gender;
    public $group_num;
    public $mail;
    public $sum_ege;
    public $y_o_birth;
    public $local_town;


    public function __construct($first_name, $last_name, $gender, $group_num, $mail, $sum_ege, $y_o_birth, $local_town, $id = null)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
        $this->group_num = $group_num;
        $this->mail = $mail;
        $this->sum_ege = $sum_ege;
        $this->y_o_birth = $y_o_birth;
        $this->local_town = $local_town;
        $this->id = $id;
    }

    public function save()
    {
        self::getDatabaseClass()->saveUser(
            $this->first_name,
            $this->last_name,
            $this->gender,
            $this->group_num,
            $this->mail,
            $this->sum_ege,
            $this->y_o_birth,
            $this->local_town
        );
    }

    public function update()
    {
        self::getDatabaseClass()->updateUser(
            $this->first_name,
            $this->last_name,
            $this->gender,
            $this->group_num,
            $this->mail,
            $this->sum_ege,
            $this->y_o_birth,
            $this->local_town,
            $this->id
        );
    }

    public static function getByEmail(string $mail): ?UserModel
    {
        return self::getDatabaseClass()->getMail($mail);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getGroupNum()
    {
        return $this->group_num;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getSumEge()
    {
        return $this->sum_ege;
    }

    public function getYOBirth()
    {
        return $this->y_o_birth;
    }

    public function getLocalTown()
    {
        return $this->local_town;
    }

    private static function getDatabaseClass(): ?DataBase
    {
        return new DataBase();
    }
}