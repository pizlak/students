<?php

namespace app;

use app\Model\UserModel;
use app\Controller\DataBase;

class Validator
{
    protected array $errors = [];

    public function validateNewUser(UserModel $user)
    {
        $this->validateFirstName(self::clearData($user->getFirstName()));
        $this->validateLastName(self::clearData($user->getLastName()));
        $this->validateGender(self::clearData($user->getGender()));
        $this->validateGroupNumber(self::clearData($user->getGroupNum()));
        $this->validateMailNewUser(self::clearData($user->getMail()));
        $this->validateEge(self::clearData((int)$user->getSumEge()));
        $this->validateYOBirth(self::clearData($user->getYOBirth()));
        $this->validateLocalTown(self::clearData($user->getLocalTown()));

        return $this->errors;
    }

    public function validateAuthorisation(string $lastName, string $mail)
    {
        $this->validateLastName(self::clearData($lastName));
        $this->validateMailUpdateUser(self::clearData($mail));

        return $this->errors;
    }

    public function validateUpdateUser(UserModel $user)
    {
        $this->validateFirstName(self::clearData($user->getFirstName()));
        $this->validateLastName(self::clearData($user->getLastName()));
        $this->validateGender(self::clearData($user->getGender()));
        $this->validateGroupNumber(self::clearData($user->getGroupNum()));
        $this->validateMailUpdateUser(self::clearData($user->getMail()));
        $this->validateEge(self::clearData((int)$user->getSumEge()));
        $this->validateYOBirth(self::clearData($user->getYOBirth()));
        $this->validateLocalTown(self::clearData($user->getLocalTown()));

        return $this->errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public static function clearData(string $val): string
    {
        $val = trim($val);
        $val = stripslashes($val);
        $val = strip_tags($val);

        return htmlspecialchars($val);
    }

    public function validateFirstName(string $val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['first_name'] = 'Имя: Ошибка: Поле не может быть пустым.' . '<br>';
        }
        if ($this->validateRusFields($val)) {
            $this->errors['first_name'] = 'Имя:  Ошибка: В имени можно использоваь только русские символы.' . '<br>';
        }
    }

    public function validateLastName(string $val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['last_name'] = 'Фамилия: Ошибка: Поле не может быть пустым.' . '<br>';
        }
        if ($this->validateRusFields($val)) {
            $this->errors['last_name'] = 'Фамилия: Ошибка: В фамилии можно использоваь только русские символы.' . '<br>';
        }
    }

    public function validateGender(string $val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['gender'] = 'Пол: Ошибка: Поле не может быть пустым.' . '<br>';
        }
        if ($val !== 'Мужчина' && $val !== 'Женщина') {
            $this->errors['gender'] = 'Пол: Ошибка: Вы ввели не верные данные.' . '<br>';
        }
    }

    public function validateGroupNumber(string $val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['gr_num'] = 'Номер группы: Ошибка: Поле не может быть пустым.' . '<br>';
        }
        if (mb_strlen($val) < 2 || mb_strlen($val) > 5) {
            $this->errors['gr_num'] = 'Номер группы:  Ошибка: Номер группы не должен быть меньше 2 и больше 5 символов.' . '<br>';
        }
    }

    public function validateMailNewUser(string $val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['mail'] = 'Электронная почта: Ошибка: Поле не может быть пустым.' . '<br>';
        }

        if (!$this->validateMailFields($val)) {
            $this->errors['mail'] = 'Электронная почта: Ошибка. Вы ввели не верный формат E-Mail.' . '<br>';
        }
        $mail = new DataBase();
        if ($mail->uniqMail($val)) {
            $this->errors['mail'] = 'Электронная почта:  Ошибка. Данный E-Mail уже занят.' . '<br>';
        }
    }

    public function validateMailUpdateUser(string $val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['mail'] = 'Электронная почта:  Ошибка: Поле не может быть пустым.' . '<br>';
        }

        if (!$this->validateMailFields($val)) {
            $this->errors['mail'] = 'Электронная почта: Ошибка. Вы ввели не верный формат E-Mail.' . '<br>';
        }
    }

    public function validateEge(int $val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['sum_ege'] = 'Сумма баллов ЕГЭ: Ошибка: Поле не может быть пустым.' . '<br>';
        }
        if ($val < 1 || $val > 300) {
            $this->errors['sum_ege'] = 'Сумма баллов ЕГЭ:  Ошибка. Вы ввели не верные данные. Сумма баллов не может быть больше 300.' . '<br>';
        }
        if (!intval($val)) {
            $this->errors['sum_ege'] = 'Сумма баллов ЕГЭ:  Ошибка. Сумма баллов должна быть числом.' . '<br>';
        }
    }

    public function validateYOBirth($val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['y_o_b'] = 'Дата рождения: Ошибка: Поле не может быть пустым.' . '<br>';
        }
    }

    public function validateLocalTown($val): void
    {
        if ($this->validateEmpty($val)) {
            $this->errors['local_town'] = 'Местный/Иногородний: Ошибка: Поле не может быть пустым.' . '<br>';
        }
    }

    public function validateRusFields(string $val): bool
    {
        return preg_match('/^.*[^А-яЁё].*$/', $val);
    }

    public static function validateMailFields(string $mail): bool
    {
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }

    public function validateEmpty($val): bool
    {
        return empty($val);
    }
}