<?php

namespace app\Controller;

use app\Controller\DataBase;

class StudentController
{
    public function viewStudentsTable()
    {
        $display = new DataBase();
        $result = $display->getStudents();
        include PATH . 'views/studentsTable.tpl.php';
    }
}