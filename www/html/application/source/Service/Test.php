<?php

namespace Service;

class Test
{
    public static function process(\stdClass $data): \stdClass
    {
        try {
            $dbh = \Utility\Database::getConnection();
            foreach($dbh->query('SHOW DATABASES;') as $row) {
                print_r($row);
            }
            $dbh = null;
        } catch (PDOException $exception) {
            var_dump($exception);
            exit();
        }
    
        /*$string1 = 'ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ';
        $string2 = 'ÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû';
        
        $string1 = preg_split('//u', $string1, -1, PREG_SPLIT_NO_EMPTY);
        $string2 = preg_split('//u', $string2, -1, PREG_SPLIT_NO_EMPTY);
        
        foreach($string1 as $string) {
            if(!in_array($string, $string2)) {
                echo $string . "\n";
            }
        }*/
        
        //sort($string1);
        //var_dump(implode('', $string1));

//         var_dump($string1, $string2);
    
        /*if(\Utility\HTTPRequest::getMethod() === \Utility\HTTPRequest::METHOD_GET) {
            $data->id = 1;
        }*/

        /*
        $connection = \Utility\Database::getConnection();
        
        $statement = $connection->query('SELECT * FROM `User` ORDER BY `id` DESC;');
        $statement->execute();
        if ($statement->columnCount() > 0) {
            if ($statement->rowCount() > 0) {
                $users = $statement->fetchAll();
            }
        }
        $statement->closeCursor();

        $connection = \Utility\Database::getConnection();
        $statement = $connection->prepare('INSERT INTO `Person` (`email`, `phone`, `cell`) VALUE(:email, :phone, :cell);');
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        if ($statement->columnCount() > 0) {
            if ($statement->rowCount() > 0) {
                $user = $statement->fetch();
            }
        }
        $statement->closeCursor();

        $connection->closeConnection();
        */
        return $data;
    }
}
