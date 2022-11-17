<?php

namespace Service;

class Login
{
    public static function process($data)
    {
        $validation = \Utility\Security\Validation::validate([
            ['key' => 'email', 'value' => $data->email?? '', 'rule' => '/^(?=.{0,100}$)[a-zA-Z0-9ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ\-.@!#$%&\'*+\/=?_`^´{|}~]+$/'],
            ['key' => 'password', 'value' => $data->password ?? '', 'rule' => '/^(?=.{0,32}$)[a-zA-Z0-9]+$/']
        ]);

        if(!empty($validation)) {
            $data = new \stdClass();
            $data->status = false;
            $data->title = 'Erro de Validação';
            $data->message = 'Ocorreu erro de validação.';
            $data->validation = $validation;
            return $data;
        }

        if(($data->email ?? '') == 'capedac.ac@gmail.com' && ($data->password ?? '') == 'BA8YDG3zazN12376GN') {
            session_start();
            //if(isset($_SESSION['login'])) {}
            $_SESSION['login'] = true;
            $data = new \stdClass();
            $data->status = true;
            $data->title = 'Login Realizado';
            $data->message = 'O login foi Realizado com sucesso.';
            return $data;
        } else {
            $data = new \stdClass();
            $data->status = false;
            $data->title = 'E-mail ou Senha Incorreto';
            $data->message = 'O e-mail ou senha está incorreto.';
            return $data;
        }

        return $data;
    }
}
