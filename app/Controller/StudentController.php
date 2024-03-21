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

    public function viewSearchStudents()
    {
        $display = new DataBase();
        $result = $display->searchResult();
        include PATH . 'views/studentsTable.tpl.php';
    }

    public function viewRegistrationForm()
    {
        if (isset($_COOKIE['mail'])) {
            header('Location: /redactor');
        }
        include PATH . 'views/registrationForm.tpl.php';
    }
}