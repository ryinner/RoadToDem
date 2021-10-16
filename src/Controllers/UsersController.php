<?php


namespace MasterOk\Controllers;


class UsersController
{
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
            $db->insert('users',['name','email','password','login'],[$name,$email,$password,$login]);
            return [
                'success' => "true",
                'message' => "Вы зарегистрировались"
            ];
        } else {
            return [
                'success' => "false",
                'message' => "Такой аккаунт уже есть"
            ];
        }
    }

    public function login()
    {

    }
}