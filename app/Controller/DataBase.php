<?php

namespace app\Controller;

use app\Controller\DatabaseConnection;
use app\Model\UserModel;

class DataBase
{
    public function saveUser(string $firstName, string $lastName, string $gender, string $grNum, string $mail, int $sumEge, string $birth, string $localTown)
    {
        $result = $this->getDBConnection()->prepare(
            'INSERT INTO `students_res` (`First_Name`, `Last_Name`, `Gender`, `Group_Num`, `Mail`, `Ege`, `Y_O_Birth`, `Local_Town`) 
                   VALUE (?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $result->bind_param(
            'sssssiss',
            $firstName,
            $lastName,
            $gender,
            $grNum,
            $mail,
            $sumEge,
            $birth,
            $localTown
        );
        $result->execute();
    }
    public function updateUser(string $firstName, string $lastName, string $gender, string $grNum, string $mail, int $sumEge, string $birth, string $localTown, int $id)
    {
        $result = $this->getDBConnection()->prepare(
            "UPDATE `students_res` SET `First_Name` = ?, 
                          `Last_Name` = ?, 
                          `Gender` = ?, 
                          `Group_Num` = ?, 
                          `Mail` = ?, 
                          `Ege` = ?,
                          `Y_O_Birth` = ?,
                          `Local_Town` = ? WHERE `id` = ?"
        );
        $result->bind_param(
            'sssssissi',
            $firstName,
            $lastName,
            $gender,
            $grNum,
            $mail,
            $sumEge,
            $birth,
            $localTown,
            $id
        );
        $result->execute();

        if($result->execute() === false){
            $error['update'] = "Ошибка при обновлении данных " . $this->getDBConnection()->error;
        }

    }
    public function searchResult(string $search, string $sort, string $sortTypeLink, int $perPage, int $offset)
    {
        return $result = $this->getDBConnection()->query(
            "SELECT `First_Name`, `Last_Name`, `Group_Num`, `Ege` 
                    FROM `students_res` 
                    WHERE `First_Name` LIKE '%$search%' 
                    OR `Last_Name` LIKE '%$search%' ORDER BY $sort $sortTypeLink LIMIT $perPage OFFSET $offset"
        );
    }

    public function getStudents(string $sort, string $sortTypeLink, int $perPage, int $offset)
    {
        return $result = $this->getDBConnection()->query(
            "SELECT `First_Name`, `Last_Name`, `Group_Num`, `Ege` 
                   FROM `students_res` 
                   ORDER BY $sort $sortTypeLink LIMIT $perPage 
                   OFFSET $offset"
        );
    }
    public function getSearchTotalStudentsCount(string $search) : string
    {
        $result = $this->getDBConnection()->query(
            "SELECT COUNT(*) as total 
                   FROM `students_res` 
                   WHERE `First_Name` LIKE '%$search%' OR `Last_Name` LIKE '%$search%'"
        );
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        return $row['total'];
    }

    public function getTotalStudentsCount() : int
    {
        $result = $this->getDBConnection()->query(
            "SELECT COUNT(*) as total FROM `students_res`"
        );
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        return $row['total'];
    }

    public function uniqMail(string $mail): bool
    {
        $result = $this->getDBConnection()->prepare('SELECT * FROM `students_res` WHERE `Mail` = ?');
        $result->bind_param('s', $mail);
        $result->execute();
        $sql = $result->get_result();
        return $sql->num_rows != 0;
    }

    public function getUserId(string $mail) : int
    {
        $result = $this->getDBConnection()->prepare('SELECT `id` FROM `students_res` WHERE `Mail` = ?');
        $result->bind_param('s', $mail);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();

        if ($data) {
           return (int) $data['id'];
        } else {
            return 0;
        }
    }

    public function authorisation($lastName, $mail) : bool
    {
        $result = $this->getDBConnection()->prepare('SELECT * FROM `students_res` WHERE `Last_Name` = ? AND `Mail` = ?');
        $result->bind_param('ss', $lastName, $mail);
        $result->execute();
        $sql = $result->get_result();
        return $sql->num_rows != 0;
    }
    public function getMail($mail)
    {
        $query = $this->getDBConnection()->prepare('SELECT * FROM `students_res` WHERE `Mail` = ?');
        $query->bind_param('s', $mail);
        $query->execute();
        $userData = $query->get_result()->fetch_assoc();
        if ($userData) {
            return new UserModel(
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

    private function getDBConnection(){
        return DatabaseConnection::createNewConDbObj();
    }
}