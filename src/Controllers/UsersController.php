<?php


namespace MasterOk\Controllers;

/**
 * Контроллер для всего, что связано с пользователями
 */
class UsersController
{
    /**
     * Функция для регистрации, которая использует @class DataBaseController
     * Проверяет уникальность логина
     * 
     * @return success
     */
    public function registration()
    {
        $post     = $_POST;

        $name     = $post['name'];
        $login    = $post['login'];
        $email    = $post['email'];
        $password = $post['password'];

        $db = new DataBaseController();

        $sql = "SELECT * FROM users WHERE login = :login";

        $query = $db->pdo->prepare($sql);
        $query->execute(['login' => $login]);
        $query = $query->fetchAll();
        if ($query == array()) {
            $password = password_hash($password,PASSWORD_DEFAULT);
            $db->insert('users',['name','email','password','login'],[$name,$email,$password,$login]);
            echo json_encode([
                'success' => "success",
                'message' => "Вы зарегистрировались"
            ]);
        } else {
            echo json_encode([
                'success' => "error",
                'message' => "Такой аккаунт уже есть"
            ]);
        }
    }

    /**
     * Функция входа в аккаунт, через проверку пароля и логина
     * Использует внутри @class DataBaseController
     *
     * @return success
     */
    public function login()
    {
        $post     = $_POST;

        $login    = $post['login'];
        $password = $post['password'];

        $db = new DataBaseController;

        $sql = "SELECT password FROM users WHERE login = :login";
        $query = $db->pdo->prepare($sql);
        $query->execute(['login' => $login]);
        $query = $query->fetchAll();

        if ($query !== array()) {

            foreach ($query as $row) {
                $hash = $row['password'];
            }

            if (password_verify($password,$hash)) {
                $_SESSION['login'] = $login;
                echo json_encode(['success' => 'true']);
            } else {
                echo json_encode(['success' => 'error']);
            }

        } else {
            echo json_encode(['success' => 'error']);
        }
    }

    /**
     * Выход из аккаунта
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
    }
}