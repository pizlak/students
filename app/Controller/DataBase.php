<?php
namespace app\Controller;
class DataBase
{
    public function uniqMail(string $mail): bool
    {
        global $conn;
        $result = $conn->prepare('SELECT * FROM `students_res` WHERE `Mail` = ?');
        $result->bind_param('s', $mail);
        $result->execute();
        $sql = $result->get_result();
        return  $sql->num_rows != 0;
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