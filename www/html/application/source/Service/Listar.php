<?php

namespace Service;

class Listar
{
    public static function process($data)
    {
        session_start();
        if(isset($_SESSION['login'])) {
            $connection = \Utility\Database::getConnection();
            $statement = $connection->prepare('SELECT * FROM `Person`;');
            $statement->execute();
            if ($statement->columnCount() > 0) {
                if ($statement->rowCount() > 0) {
                    $persons = $statement->fetchAll(\PDO::FETCH_OBJ) ?? [];
                }
            }
            $statement->closeCursor();
            //$data = $persons;
            $data = new \stdClass();
            $data->status = true;
            $data->title = 'Sucesso';
            $data->message = 'Funcionou corretamente.';
            $data->persons = $persons;
            return $data;
        } else {
            $data = new \stdClass();
            $data->status = false;
            $data->title = 'Login Necessário';
            $data->message = 'Realize on login para visualizar.';
            return $data;
        }

        return $data;
    }
}
