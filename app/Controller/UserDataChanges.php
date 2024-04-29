<?php

namespace app\Controller;

use app\Controller\DatabaseConnection;

class UserDataChanges
{
    public function saveEditData(
        int $userId, string $firstName, string $lastName, string $gender, string $groupNum, string $mail,
        int $ege, string $yobirth, string $localTown
    )
    {
        $result = $this->getDBConnection()->prepare('INSERT INTO `editinfo` (`idUser`,  `FirstNameEdit`, `LastNameEdit`,	`GenderEdit`,	
         `GroupNumEdit`,	`MailEdit`,	`EgeEdit`,	`YOBirthEdit`,	`LocalTownEdit`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $result->bind_param(
            'isssssiss', $userId, $firstName, $lastName, $gender, $groupNum, $mail, $ege, $yobirth, $localTown);
        $result->execute();
    }

    public function getEditData(int $userId): array
    {
        $result = $this->getDBConnection()->prepare(
            'SELECT `dataTime`, `FirstNameEdit`, `LastNameEdit`,	`GenderEdit`,	`GroupNumEdit`,	`MailEdit`,	
                    `EgeEdit`,	`YOBirthEdit`,	`LocalTownEdit` FROM `editinfo` WHERE `idUser` = ? ORDER BY `dataTime` DESC');
        $result->bind_param('i', $userId);
        $result->execute();

        return $result->get_result()->fetch_all(MYSQLI_ASSOC);

    }

    private function getDBConnection()
    {
       return DatabaseConnection::createNewConDbObj();
    }

}