<?php

namespace Service;

final class Cadastrar
{
    public static function process(\stdClass $data): \stdClass
    {
    
        //var_dump($data);
        $validation = \Utility\Security\Validation::validate([
            ['key' => 'name', 'value' => $data->name ?? '', 'rule' => '/^(?=.{0,100}$)[a-zA-Z ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~]+$/'],
            ['key' => 'birth', 'value' => $data->birth ?? '', 'rule' => '/^([0-9]{2}\/[0-9]{2}\/[0-9]{4})+$/'],
            ['key' => 'sex', 'value' => $data->sex ?? '', 'rule' => '/^(?=.{0,1}$)[0-9]+$/'],
            ['key' => 'identity', 'value' => $data->identity ?? '', 'rule' => '/^(?=.{0,32}$)[a-zA-Z0-9 \/-]+$/'],
            ['key' => 'document', 'value' => $data->document ?? '', 'rule' => '/^(?=.{11,11}$)[0-9]+$/'],
            ['key' => 'nationality', 'value' => $data->nationality ?? '', 'rule' => '/^(?=.{0,64}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/'],
            ['key' => 'naturalness', 'value' => $data->naturalness ?? '', 'rule' => '/^(?=.{0,64}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/'],
            ['key' => 'place', 'value' => $data->place ?? '', 'rule' => '/^(?=.{0,64}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/'],
            ['key' => 'maritial', 'value' => $data->maritial ?? '', 'rule' => '/^(?=.{0,1}$)[0-9]+$/'],
            ['key' => 'professional', 'value' => $data->professional ?? '', 'rule' => '/^(?=.{0,1}$)[0-9]+$/'],
            ['key' => 'academic', 'value' => $data->academic ?? '', 'rule' => '/^(?=.{0,1}$)[0-9]+$/'],
            ['key' => 'email', 'value' => $data->email ?? '', 'rule' => '/^(?=.{0,100}$)[a-zA-Z0-9ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ\-.@!#$%&\'*+\/=?_`^´{|}~]+$/'],
            ['key' => 'phone', 'value' => $data->phone ?? '', 'rule' => '/^(?=.{0,32}$)[0-9 )+(-]+$/'],
            ['key' => 'cell', 'value' => $data->cell ?? '', 'rule' => '/^(?=.{0,32}$)[0-9 )+(-]+$/'],
            ['key' => 'country', 'value' => $data->country ?? '', 'rule' => '/^(?=.{0,64}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/'],
            ['key' => 'state', 'value' => $data->state ?? '', 'rule' => '/^(?=.{0,64}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/'],
            ['key' => 'city', 'value' => $data->city ?? '', 'rule' => '/^(?=.{0,64}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/'],
            ['key' => 'district', 'value' => $data->district ?? '', 'rule' => '/^(?=.{0,64}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/'],
            ['key' => 'location', 'value' => $data->location ?? '', 'rule' => '/^(?=.{0,64}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/'],
            ['key' => 'number', 'value' => $data->number ?? '', 'rule' => '/^(?=.{0,16}$)[a-zA-Z 0-9º-]+$/'],
            ['key' => 'code', 'value' => $data->code ?? '', 'rule' => '/^(?=.{0,32}$)[0-9]+$/']
            //['key' => 'complement', 'value' => $data->complement ?? '', 'rule' => '/^(?=.{0,100}$)[a-zA-Z0-9 ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~-]+$/']
        ]);
        
        /*if(strpos($data->birth, '/') !== false) {
            $areas = explode(',', $_SESSION['shoparea']);
        }*/
        $parts = explode('/',$data->birth, 3);
        $data->birth = ($parts[2] ?? '') . '-' . ($parts[1] ?? '') . '-' . ($parts[0] ?? '');
        
        foreach($data->dependent ?? [] as $key => $dependent) {
            $dependent = (object) $dependent;
            $currentValidationDependent = \Utility\Security\Validation::validate([
                ['key' => 'name', 'value' => $dependent->name ?? '', 'rule' => '/^(?=.{0,100}$)[a-zA-Z ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~]+$/'],
                ['key' => 'birth', 'value' => $dependent->birth ?? '', 'rule' => '/^([0-9]{2}\/[0-9]{2}\/[0-9]{4})+$/'],
                ['key' => 'sex', 'value' => $dependent->sex ?? '', 'rule' => '/^(?=.{0,1}$)[0-9]+$/'],
            ]);
            if(!empty($currentValidationDependent)) {
                $validation['dependent'][] = $currentValidationDependent;
            } else {
                $parts = explode('/',$dependent->birth, 3);
                $data->dependent[$key]['birth'] = ($parts[2] ?? '') . '-' . ($parts[1] ?? '') . '-' . ($parts[0] ?? '');
            }
        }

        foreach($data->disability ?? [] as $disability) {
            $disability = (object) $disability;
            $currentValidationDisability = \Utility\Security\Validation::validate([
                ['key' => 'name', 'value' => $disability->name ?? '', 'rule' => '/^(?=.{0,100}$)[a-zA-Z ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüýÿ`^´¨~]+$/'],
                ['key' => 'ICD', 'value' => $disability->ICD ?? '', 'rule' => '/^(?=.{0,16}$)[a-zA-Z0-9.]+$/'],
                ['key' => 'degree', 'value' => $disability->degree ?? '', 'rule' => '/^(?=.{0,1}$)[0-9]+$/'],
            ]);
            if(!empty($currentValidationDependent)) {
                $validation['disability'][] = $currentValidationDisability;
            }
        }
        
        if(!empty($validation)) {
            $data = new \stdClass();
            $data->success = false;
            $data->title = 'Dados Incorretos';
            $data->message = 'Ocorreu um erro na validação dos dados.';
            $data->validation = $validation;
            return $data;
        }

        /*if(true) {
            $data = new \stdClass();
            $data->success = true;
            $data->message = 'A validação dos dados foi realizada com sucesso.';
            return $data;
        }*/
        
        $connection = \Utility\Database::getConnection();
        
        $connection->exec('ALTER TABLE `Person` AUTO_INCREMENT = 1;');
        $connection->exec('ALTER TABLE `Dependent` AUTO_INCREMENT = 1;');
        $connection->exec('ALTER TABLE `Disability` AUTO_INCREMENT = 1;');
        
        $connection->beginTransaction();

        try {
            $statement = $connection->prepare('
                INSERT INTO `Person`
                (
                `name`,
                `birth`,
                `sex`,
                `identity`,
                `document`,
                `nationality`,
                `naturalness`,
                `place`,
                `maritial`,
                `professional`,
                `academic`,
                `email`,
                `phone`,
                `cell`,
                `country`,
                `state`,
                `city`,
                `district`,
                `location`,
                `number`,
                `code`
                )
                VALUE
                (
                :name,
                :birth,
                :sex,
                :identity,
                :document,
                :nationality,
                :naturalness,
                :place,
                :maritial,
                :professional,
                :academic,
                :email,
                :phone,
                :cell,
                :country,
                :state,
                :city,
                :district,
                :location,
                :number,
                :code
                );');
            $statement->bindParam(':name', $data->name, \PDO::PARAM_STR);
            $statement->bindParam(':birth', $data->birth, \PDO::PARAM_STR);
            $statement->bindParam(':sex', $data->sex, \PDO::PARAM_INT);
            $statement->bindParam(':identity', $data->identity, \PDO::PARAM_STR);
            $statement->bindParam(':document', $data->document, \PDO::PARAM_STR);
            $statement->bindParam(':nationality', $data->nationality, \PDO::PARAM_STR);
            $statement->bindParam(':naturalness', $data->naturalness, \PDO::PARAM_STR);
            $statement->bindParam(':place', $data->place, \PDO::PARAM_STR);
            $statement->bindParam(':maritial', $data->maritial, \PDO::PARAM_INT);
            $statement->bindParam(':professional', $data->professional, \PDO::PARAM_INT);
            $statement->bindParam(':academic', $data->academic, \PDO::PARAM_INT);
            $statement->bindParam(':email', $data->email, \PDO::PARAM_STR);
            $statement->bindParam(':phone', $data->phone, \PDO::PARAM_STR);
            $statement->bindParam(':cell', $data->cell, \PDO::PARAM_STR);
            $statement->bindParam(':country', $data->country, \PDO::PARAM_STR);
            $statement->bindParam(':state', $data->state, \PDO::PARAM_STR);
            $statement->bindParam(':city', $data->city, \PDO::PARAM_STR);
            $statement->bindParam(':district', $data->district, \PDO::PARAM_STR);
            $statement->bindParam(':location', $data->location, \PDO::PARAM_STR);
            $statement->bindParam(':number', $data->number, \PDO::PARAM_STR);
            $statement->bindParam(':code', $data->code, \PDO::PARAM_STR);
            //$statement->bindParam(':complement', $data->complement, \PDO::PARAM_STR);
            //$statement->bindParam(':status', $data->status, \PDO::PARAM_STR);
            //$statement->bindParam(':date', $data->date, \PDO::PARAM_STR);
            $statement->execute();
            /*if ($statement->columnCount() > 0) {
                if ($statement->rowCount() > 0) {
                    $user = $statement->fetch();
                }
            }
            $statement->closeCursor();*/
            
            $personId = $connection->lastInsertId();
            
            foreach($data->dependent ?? [] as $dependent) {
                $dependent = (object) $dependent;
                $statement = $connection->prepare('INSERT INTO `Dependent` (`person`, `name`, `birth`, `sex`) VALUE (:person, :name, :birth, :sex);');
                $statement->bindParam(':person', $personId, \PDO::PARAM_INT);
                $statement->bindParam(':name', $dependent->name, \PDO::PARAM_STR);
                $statement->bindParam(':birth', $dependent->birth, \PDO::PARAM_STR);
                $statement->bindParam(':sex', $dependent->sex, \PDO::PARAM_INT);
                $statement->execute();
                /*if ($statement->columnCount() > 0) {
                    if ($statement->rowCount() > 0) {
                        $user = $statement->fetch();
                    }
                }
                $statement->closeCursor();*/
            }

            foreach($data->disability ?? [] as $disability) {
                $disability = (object) $disability;
                $statement = $connection->prepare('INSERT INTO `Disability` (`person`,`name`, `ICD`, `degree`) VALUE(:person, :name, :ICD, :degree);');
                $statement->bindParam(':person', $personId, \PDO::PARAM_INT);
                $statement->bindParam(':name', $disability->name, \PDO::PARAM_STR);
                $statement->bindParam(':ICD', $disability->ICD, \PDO::PARAM_STR);
                $statement->bindParam(':degree', $disability->degree, \PDO::PARAM_INT);
                $statement->execute();
                /*if ($statement->columnCount() > 0) {
                    if ($statement->rowCount() > 0) {
                        $user = $statement->fetch();
                    }
                }
                $statement->closeCursor();*/
            }
            
            $connection->commit();

            $data = new \stdClass();
            $data->success = true;
            $data->title = 'Cadastrado';
            $data->message = 'Cadastro realizado com sucesso.';
            return $data;
        } catch (\PDOException $PDOException) {
            $connection->rollBack();
            //throw new \Exception\ValidationException('Cadastro de associado, passou pela validação, mas ocorreu rollBack no banco de dados, mensage: ' . $PDOException->getMessage(), 0);
            $data = new \stdClass();
            $data->success = false;
            $data->title = 'Ocorreu um Erro';
            $data->message = 'Rollback: ' . $PDOException->getMessage();
            return $data;
        }

        return $data;
    }
}
