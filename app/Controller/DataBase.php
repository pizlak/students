<?php

namespace app\Controller;

class DataBase
{
    public function searchResult()
    {
        global $conn;
        $search = $_POST['search'];
        return $result = $conn->query(
            "SELECT `First_Name`, `Last_Name`, `Group_Num`, `Ege` 
                    FROM `students_res` 
                    WHERE `First_Name` LIKE '%$search%' 
                    OR `Last_Name` LIKE '%$search%'"
        );
    }

    public function getStudents()
    {
        global $conn;
        return $result = $conn->query(
            'SELECT `First_Name`, `Last_Name`, `Group_Num`, `Ege` FROM `students_res` ORDER BY `Last_Name` ASC'
        );
    }

    public function uniqMail(string $mail): bool
    {
        global $conn;
        $result = $conn->prepare('SELECT * FROM `students_res` WHERE `Mail` = ?');
        $result->bind_param('s', $mail);
        $result->execute();
        $sql = $result->get_result();
        return $sql->num_rows != 0;
    }

    public function authorisation($lastName, $mail)
    {
        global $conn;
        $result = $conn->prepare('SELECT * FROM `students_res` WHERE `Last_Name` = ? AND `Mail` = ?');
        $result->bind_param('ss', $lastName, $mail);
        $result->execute();
        $sql = $result->get_result();
        return $sql->num_rows != 0;
    }
}