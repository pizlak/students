<?php

namespace app\Controller;

use app\Controller\DataBase;

class StudentController
{
    public function viewStudentsTable()
    {
        $baseSortUrl = '/studentTable';
        $perPage = 50;
        $currentPage = $_GET['page'] ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $display = new DataBase();
        $totalRow = $display->getTotalStudentsCount();
        $totalPage = ceil($totalRow / $perPage);
        $search = $_GET['search'] ?? '';
        $sort = $_GET['sort'] ?? 'Last_Name';
        $sortTypeLink = $_GET['sort_type'] ?? 'DESC';

        if($sortTypeLink == 'DESC'){
            $sortTypeLink = 'ASC';
        } elseif ($sortTypeLink == 'ASC'){
            $sortTypeLink = 'DESC';
        }


        $result = $display->getStudents($sort, $sortTypeLink, $perPage, $offset);


        include PATH . 'views/studentsTable.tpl.php';
    }

    public function viewSearchStudents()
    {
        $baseSortUrl = '/studentTable/search';
        $perPage = 50;
        $currentPage = $_GET['page'] ?? 1;
        $search = $_GET['search'] ?? '';
        $offset = ($currentPage - 1) * $perPage;
        $display = new DataBase();
        $totalRow = $display->getSearchTotalStudentsCount($search);
        $totalPage = ceil($totalRow / $perPage);

        $sort = $_GET['sort'] ?? 'Last_Name';
        $sortTypeLink = $_GET['sort_type'] ?? 'DESC';

        if($sortTypeLink == 'DESC'){
            $sortTypeLink = 'ASC';
        } elseif ($sortTypeLink == 'ASC'){
            $sortTypeLink = 'DESC';
        }
    
        $results = $display->searchResult($search, $sort, $sortTypeLink, $perPage, $offset);

        $result = [];

        foreach ($results as $resultKey => $resultValue) {
            $result[$resultKey] = str_replace($search, '<span style="background-color: yellow;">' . $search . '</span>', $resultValue);
            $result[$resultKey] = str_replace(ucfirst($search), '<span style="background-color: yellow;">' . ucfirst($search) . '</span>', $resultValue);
        }

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