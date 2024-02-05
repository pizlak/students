<?php

namespace app\Controller;

use app\Controller\DataBase;

class StudentController
{
    public function viewStudentsTable()
    {
        $display = new DataBase();
        if (!isset($_POST['search'])){
            $result = $display->getStudents();
        } else {
            $result = $display->searchResult();
        }

        include PATH . 'views/studentsTable.tpl.php';
    }
}