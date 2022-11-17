<?php

namespace Service;

class Visualizar
{
    public static function process($data)
    {
        session_start();
        if(isset($_SESSION['login'])) {
            $connection = \Utility\Database::getConnection();
            $statement = $connection->prepare('SELECT * FROM `Person` WHERE `id` = :id;');
            $statement->bindParam(':id', $data->id, \PDO::PARAM_INT);
            $statement->execute();
            if ($statement->columnCount() > 0) {
                if ($statement->rowCount() > 0) {
                    $person = $statement->fetch(\PDO::FETCH_OBJ) ?? [];
                }
            }
            $statement->closeCursor();
            $data = $person;
            $data->status = true;
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
