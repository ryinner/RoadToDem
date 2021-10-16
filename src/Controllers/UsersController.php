<?php


namespace MasterOk\Controllers;

/**
 * Контроллер для всего, что связано с пользователями
 */
class UsersController
{
    /**
     * Функция для регистрации, которая базируется на классе DataBaseController
     *
     * @return void
     */
    public function registration()
    {
        $post= $_POST;

        $name = $post['name'];
        $login = $post['login'];
        $email = $post['email'];
        $password = $post['password'];

        $db = new DataBaseController();

        $sql = "SELECT * FROM users WHERE login = :login";

        $query = $db->pdo->prepare($sql);
        $query->execute(['login' => $login]);
        $query = $query->fetchAll();
        if ($query == array()) {
            $password = password_hash($password,PASSWORD_DEFAULT);
            $db->insert('users',['name','email','password','login'],[$name,$email,$password,$login]);
            return json_encode([
                'success' => "true",
                'message' => "Вы зарегистрировались"
            ]);
        } else {
            return json_encode([
                'success' => "false",
                'message' => "Такой аккаунт уже есть"
            ]);
        }
    }

    public function login()
    {

    }

    public function logout()
    {
        
    }
}