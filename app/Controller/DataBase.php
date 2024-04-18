<?php

namespace app\Controller;

class DataBase
{
    public function searchResult(string $search, string $sort, string $sortTypeLink, int $perPage, int $offset)
    {
        global $conn;
        return $result = $conn->query(
            "SELECT `First_Name`, `Last_Name`, `Group_Num`, `Ege` 
                    FROM `students_res` 
                    WHERE `First_Name` LIKE '%$search%' 
                    OR `Last_Name` LIKE '%$search%' ORDER BY $sort $sortTypeLink LIMIT $perPage OFFSET $offset"
        );
    }

    public function getStudents(string $sort, string $sortTypeLink, int $perPage, int $offset)
    {
        global $conn;
        return $result = $conn->query(
            "SELECT `First_Name`, `Last_Name`, `Group_Num`, `Ege` FROM `students_res` ORDER BY $sort $sortTypeLink LIMIT $perPage OFFSET $offset"
        );
    }
    public function getSearchTotalStudentsCount(string $search)
    {
        global $conn;
        $result = $conn->query(
            "SELECT COUNT(*) as total FROM `students_res` WHERE `First_Name` LIKE '%$search%' 
            OR `Last_Name` LIKE '%$search%'"
        );
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        return $row['total'];
    }

    public function getTotalStudentsCount()
    {
        global $conn;
        $result = $conn->query(
            "SELECT COUNT(*) as total FROM `students_res`"
        );
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        return $row['total'];
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