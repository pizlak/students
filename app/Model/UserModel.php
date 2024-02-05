<?php

namespace app\Model;

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


    public function __construct(
        $first_name,
        $last_name,
        $gender,
        $group_num,
        $mail,
        $sum_ege,
        $y_o_birth,
        $local_town,
        $id = null
    ) {
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
        global $conn;
        $user = $conn->prepare(
            'INSERT INTO `students_res` (`First_Name`, `Last_Name`, `Gender`, `Group_Num`, `Mail`, `Ege`, `Y_O_Birth`, `Local_Town`) VALUE (?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $user->bind_param(
            'ssssssss',
            $this->first_name,
            $this->last_name,
            $this->gender,
            $this->group_num,
            $this->mail,
            $this->sum_ege,
            $this->y_o_birth,
            $this->local_town
        );
        $user->execute();
    }

    public function update()
    {
        global $conn;
        $update = $conn->prepare(
            "UPDATE `students_res` SET `First_Name` = ?, 
                          `Last_Name` = ?, 
                          `Gender` = ?, 
                          `Group_Num` = ?, 
                          `Mail` = ?, 
                          `Ege` = ?,
                          `Y_O_Birth` = ?,
                          `Local_Town` = ? WHERE `id` = ?"
        );

        $update->bind_param(
            'sssssssss',
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
        $result = $update->execute();
        if ($result === false) {
            echo "Ошибка при обновлении данных " . $conn->error;
        }
    }

    public static function getByEmail(string $mail): ?UserModel
    {
        global $conn;
        $query = $conn->prepare('SELECT * FROM `students_res` WHERE `Mail` = ?');
        $query->bind_param('s', $mail);
        $query->execute();
        $userData = $query->get_result()->fetch_assoc();
        if ($userData) {
            return new self(
                $userData['First_Name'],
                $userData['Last_Name'],
                $userData['Gender'],
                $userData['Group_Num'],
                $userData['Mail'],
                $userData['Ege'],
                $userData['Y_O_Birth'],
                $userData['Local_Town'],
                $userData['id']
            );
        }
        return null;
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
}