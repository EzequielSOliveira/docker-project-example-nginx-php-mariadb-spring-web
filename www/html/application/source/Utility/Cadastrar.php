<?php

namespace Service;

class Cadastrar
{
    public static function process(\stdClass $data): \stdClass
    {
        $connection = \Utility\Database::getConnection();

        // [INSERT] Person
        $statement = $connection->prepare('INSERT INTO `Person` (`email`, `phone`, `cell`) VALUE(:email, :phone, :cell);');
        $statement->bindParam(':email', $email, \PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, \PDO::PARAM_STR);
        $statement->bindParam(':cell', $cell, \PDO::PARAM_STR);
        $statement->execute();
        if ($statement->columnCount() > 0) {
            if ($statement->rowCount() > 0) {
                $user = $statement->fetch();
            }
        }
        $statement->closeCursor();

        $personId = $connection->lastInsertId();

        // [INSERT] Natural
        $statement = $connection->prepare('INSERT INTO `Person` (`person`, `name`, `birth`, `gender`, `identity`, `document`, `nationality`, `city`, `state`, `maritial`, `professional`, `academic`) VALUE(:person, :name, :birth, :gender, :identity, :document, :nationality, :city, :state, :maritial, :professional, :academic);');
        $statement->bindParam(':person', $personId, \PDO::PARAM_INT);
        $statement->bindParam(':name', $name, \PDO::PARAM_STR);
        $statement->bindParam(':birth', $birth, \PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, \PDO::PARAM_STR);
        $statement->bindParam(':identity', $identity, \PDO::PARAM_STR);
        $statement->bindParam(':document', $document, \PDO::PARAM_STR);
        $statement->bindParam(':nationality', $nationality, \PDO::PARAM_STR);
        $statement->bindParam(':city', $city, \PDO::PARAM_STR);
        $statement->bindParam(':state', $state, \PDO::PARAM_STR);
        $statement->bindParam(':maritial', $maritial, \PDO::PARAM_STR);
        $statement->bindParam(':professional', $professional, \PDO::PARAM_STR);
        $statement->bindParam(':academic', $academic, \PDO::PARAM_STR);
        $statement->execute();
        if ($statement->columnCount() > 0) {
            if ($statement->rowCount() > 0) {
                $user = $statement->fetch();
            }
        }
        $statement->closeCursor();

        // [INSERT] Address
        $statement = $connection->prepare('INSERT INTO `Address` (`person`, `state`, `city`, `district`, `code`, `location`, `number`, `complement`) VALUE(:person, :state, :city, :district, :code, :location, :number, :complement);');
        $statement->bindParam(':person', $personId, \PDO::PARAM_INT);
        $statement->bindParam(':state', $state, \PDO::PARAM_STR);
        $statement->bindParam(':city', $city, \PDO::PARAM_STR);
        $statement->bindParam(':district', $district, \PDO::PARAM_STR);
        $statement->bindParam(':code', $code, \PDO::PARAM_STR);
        $statement->bindParam(':location', $location, \PDO::PARAM_STR);
        $statement->bindParam(':number', $number, \PDO::PARAM_STR);
        $statement->bindParam(':complement', $complement, \PDO::PARAM_STR);
        $statement->execute();
        if ($statement->columnCount() > 0) {
            if ($statement->rowCount() > 0) {
                $user = $statement->fetch();
            }
        }
        $statement->closeCursor();

        // [INSERT] Disability
        $statement = $connection->prepare('INSERT INTO `Disability` (`person`, `ICD`, `degree`) VALUE(:person, :ICD, :degree);');
        $statement->bindParam(':person', $personId, \PDO::PARAM_INT);
        $statement->bindParam(':ICD', $ICD, \PDO::PARAM_STR);
        $statement->bindParam(':degress', $degree, \PDO::PARAM_STR);
        $statement->execute();
        if ($statement->columnCount() > 0) {
            if ($statement->rowCount() > 0) {
                $user = $statement->fetch();
            }
        }
        $statement->closeCursor();

        // [INSERT] Dependent
        $statement = $connection->prepare('INSERT INTO `Dependent` (`person`, `name`, `birth`) VALUE(:name, :birth);');
        $statement->bindParam(':person', $personId, \PDO::PARAM_INT);
        $statement->bindParam(':name', $name, \PDO::PARAM_STR);
        $statement->bindParam(':birth', $birth, \PDO::PARAM_STR);
        $statement->execute();
        if ($statement->columnCount() > 0) {
            if ($statement->rowCount() > 0) {
                $user = $statement->fetch();
            }
        }
        $statement->closeCursor();

        // [INSERT] Associate
        $statement = $connection->prepare('INSERT INTO `Associate` (`person`, `date`, `active`) VALUE(:person, :date, :active);');
        $statement->bindParam(':person', $personId, \PDO::PARAM_INT);
        $statement->bindParam(':date', $date, \PDO::PARAM_STR);
        $statement->bindParam(':active', $active, \PDO::PARAM_STR);
        $statement->execute();
        if ($statement->columnCount() > 0) {
            if ($statement->rowCount() > 0) {
                $user = $statement->fetch();
            }
        }
        $statement->closeCursor();

        $connection->closeConnection();



        /*if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // CSRF Protection
        if ($request->getMethod() == $request::METHOD_POST) {
            if (empty($request->input->CSRFToken)) {
                throw new \Exception\SecurityException('Token de CSRF não encontrado');
            } else {
                if (hash_equals($_SESSION['CSRFToken'], $request->input->CSRFToken)) {
                    // Generate new token
                    $_SESSION['CSRFToken'] = bin2hex(random_bytes(32));
                } else {
                    throw new \Exception\SecurityException('Token de CSRF inválido');
                }
            }
        } else {
            if (empty($_SESSION['CSRFToken'])) {
                $_SESSION['CSRFToken'] = bin2hex(random_bytes(32));
            }
        }

        $request->security->CSRFToken = $_SESSION['CSRFToken'];




        // TODO: pode aumentar impacto em caso de ataque de DDoS, visto que cada usuário terá uma sessão.
        if(empty($_SESSION['LGPD']) && !empty($request->input->lgpd)) {
            $_SESSION['LGPD'] = true;
            $request->redirect('/cadastro');
            exit();
        }

        $request->entity->Estado = \Service\Database::query('/ListarEstado.sql', []);
        $request->entity->EstadoCivil = \Service\Database::query('/ListarEstadoCivil.sql', []);
        $request->entity->SituacaoProfissional = \Service\Database::query('/ListarSituacaoProfissional.sql', []);
        $request->entity->FormacaoAcademica = \Service\Database::query('/ListarFormacaoAcademica.sql', []);

        if ($request->getMethod() === $request::METHOD_POST) {
            $validation = new \Service\Security\Validation();
            $validation->verify('nome', 'tinytext', $request->input->nome, true);
            $validation->verify('nascimento', 'tinydate', $request->input->nascimento, true);
            $validation->verify('sexo', 'tinynumeric', $request->input->sexo, true);
            $validation->verify('rg', 'tinytext', $request->input->rg, true);

            $validation->verify('cpf', 'tinynumeric', $request->input->cpf, true);
            //$resultCPF = \Service\Database::query('/VerificarCPFUnico.sql', [
            //    'cpf' => $request->input->cpf
            //]);

            //if(!empty($resultCPF)) {
            //    $request->validation->cpf = 'CPF já existe.';
            //}

            $validation->verify('email', 'tinyemail', $request->input->email, true);
            $validation->verify('telefone', 'tinynumeric', $request->input->telefone, true);
            $validation->verify('celular', 'tinynumeric', $request->input->celular, true);
            $validation->verify('nacionalidade', 'tinytext', $request->input->nacionalidade, true);
            $validation->verify('naturalidade', 'tinytext', $request->input->naturalidade, true);
            $validation->verify('estadoNatural', 'tinynumeric', $request->input->estadoNatural, true);
            $validation->verify('estadoCivil', 'tinynumeric', $request->input->estadoCivil, true);
            $validation->verify('situacaoProfissional', 'tinynumeric', $request->input->situacaoProfissional, true);
            $validation->verify('formacaoAcademica', 'tinynumeric', $request->input->formacaoAcademica, true);
            $validation->verify('estado', 'tinynumeric', $request->input->estado, true);
            $validation->verify('cidade', 'tinytext', $request->input->cidade, true);
            $validation->verify('bairro', 'tinytext', $request->input->bairro, true);
            $validation->verify('cep', 'tinynumeric', $request->input->cep, true);
            $validation->verify('localidade', 'tinytext', $request->input->localidade, true);
            $validation->verify('numero', 'tinytext', $request->input->numero, true);
            $validation->verify('complemento', 'tinytext', $request->input->complemento, false);
            // $validation->verify('cid', 'tinytext', $request->input->cid, false);
            // $validation->verify('grauDeficiencia', 'tinynumeric', $request->input->grauDeficiencia, false);

            $validDependent = [];
            for($i = 0; $i < 5; $i++) {
                $required = false;
                $isValid = true;
                if ($required === true && empty($request->input->dependente[$i]['nome'])) {
                    $isValid = false;
                    $request->validation->dependente[$i]['nome'] = 'O preenchimento é obrigatório.';
                } else {
                    if(!empty($request->input->dependente[$i]['nome'])) {
                        if ($validation->check('nome', 'tinytext', $request->input->dependente[$i]['nome'])) {
                            $isValid = false;
                            $request->validation->dependente[$i]['nome'] = 'Digite somente letras, números, espaços, vírgulas, pontos e ponto e vírgula.';
                        }
                    }
                }
                if ($required === true && empty($request->input->dependente[$i]['nascimento'])) {
                    $isValid = false;
                    $request->validation->dependente[$i]['nascimento'] = 'O preenchimento é obrigatório.';
                } else {
                    if(!empty($request->input->dependente[$i]['nascimento'])) {
                        if ($validation->check('nascimento', 'tinydate', $request->input->dependente[$i]['nascimento'])) {
                            $isValid = false;
                            $request->validation->dependente[$i]['nascimento'] = 'Digite um data válida.';
                        }
                    }
                }
                if ($required === true && empty($request->input->dependente[$i]['sexo'])) {
                    $isValid = false;
                    $request->validation->dependente[$i]['sexo'] = 'O preenchimento é obrigatório.';
                } else {
                    if(!empty($request->input->dependente[$i]['sexo'])) {
                        if ($validation->check('sexo', 'tinyint', $request->input->dependente[$i]['sexo'])) {
                            $isValid = false;
                            $request->validation->dependente[$i]['sexo'] = 'Digite somente números.';
                        }
                    }
                }
                if(empty($request->input->dependente[$i]['nome']) || empty($request->input->dependente[$i]['nascimento']) || empty($request->input->dependente[$i]['sexo'])) {
                    $isValid = false;
                }
                if($isValid) {
                    $validDependent[$i] = $i;
                }
            }

            $validDisability = [];
            for($i = 0; $i < 5; $i++) {
                $required = false;
                $isValid = true;
                if ($required === true && empty($request->input->deficiencia[$i]['cid'])) {
                    $isValid = false;
                    $request->validation->deficiencia[$i]['cid'] = 'O preenchimento é obrigatório.';
                } else {
                    if(!empty($request->input->deficiencia[$i]['cid'])) {
                        if ($validation->check('cid', 'tinytext', $request->input->deficiencia[$i]['cid'])) {
                            $isValid = false;
                            $request->validation->deficiencia[$i]['cid'] = 'Digite somente letras, números, espaços, vírgulas, pontos e ponto e vírgula.';
                        }
                    }
                }
                if ($required === true && empty($request->input->deficiencia[$i]['grauDeficiencia'])) {
                    $isValid = false;
                    $request->validation->deficiencia[$i]['grauDeficiencia'] = 'O preenchimento é obrigatório.';
                } else {
                    if(!empty($request->input->deficiencia[$i]['grauDeficiencia'])) {
                        if ($validation->check('grauDeficiencia', 'tinyint', $request->input->deficiencia[$i]['grauDeficiencia'])) {
                            $isValid = false;
                            $request->validation->deficiencia[$i]['grauDeficiencia'] = 'Digite somente números.';
                        }
                    }
                }
                if(empty($request->input->deficiencia[$i]['cid']) || empty($request->input->deficiencia[$i]['grauDeficiencia'])) {
                    $isValid = false;
                }
                if($isValid) {
                    $validDisability[$i] = $i;
                }
            }

            if ($request->validation->isValid()) {
                \Service\Database::getConnection()->beginTransaction();
                try {
                    \Service\Database::query('/ResetAutoIncrementAssociado.sql', []);
                    \Service\Database::query('/CadastrarAssociado.sql', [
                        'nome' => $request->input->nome,
                        'nascimento' => \Service\DateTime::changeDate($request->input->nascimento),
                        'sexo' => $request->input->sexo,
                        'rg' => $request->input->rg,
                        'cpf' => $request->input->cpf,
                        'email' => $request->input->email,
                        'telefone' => $request->input->telefone,
                        'celular' => $request->input->celular,
                        'nacionalidade' => $request->input->nacionalidade,
                        'naturalidade' => $request->input->naturalidade,
                        'estadoNatural' => $request->input->estadoNatural,
                        'estadoCivil' => $request->input->estadoCivil,
                        'situacaoProfissional' => $request->input->situacaoProfissional,
                        'formacaoAcademica' => $request->input->formacaoAcademica,
                        'estado' => $request->input->estado,
                        'cidade' => $request->input->cidade,
                        'bairro' => $request->input->bairro,
                        'cep' => $request->input->cep,
                        'localidade' => $request->input->localidade,
                        'numero' => $request->input->numero,
                        'complemento' => $request->input->complemento,
                        // 'cid' => $request->input->cid,
                        // 'grauDeficiencia' => $request->input->grauDeficiencia,
                        'situacao' => 2
                    ]);
                    $idAssociadoCadastrado = \Service\Database::getConnection()->lastInsertId();
                    if (!empty($validDependent)) {
                        foreach ($validDependent as $dependentIndex) {
                            \Service\Database::query('/ResetAutoIncrementDependente.sql', []);
                            \Service\Database::query('/CadastrarDependente.sql', [
                                'associado' => $idAssociadoCadastrado,
                                'nome' => $request->input->dependente[$dependentIndex]['nome'],
                                'nascimento' => \Service\DateTime::changeDate($request->input->dependente[$dependentIndex]['nascimento']),
                                'sexo' => $request->input->dependente[$dependentIndex]['sexo'],
                            ]);
                        }
                    }
                    if (!empty($validDisability)) {
                        foreach ($validDisability as $disabilityIndex) {
                            \Service\Database::query('/ResetAutoIncrementDeficiencia.sql', []);
                            \Service\Database::query('/CadastrarDeficiencia.sql', [
                                'associado' => $idAssociadoCadastrado,
                                'cid' => $request->input->deficiencia[$disabilityIndex]['cid'],
                                'grauDeficiencia' => $request->input->deficiencia[$disabilityIndex]['grauDeficiencia']
                            ]);
                        }
                    }
                    \Service\Database::getConnection()->commit();
                    if(isset($_SESSION['LGPD']) && $_SESSION['LGPD'] === true) {
                        unset($_SESSION['LGPD']);
                    }
                    $request->redirect('/bemvindo');
                } catch (\PDOException $PDOException) {
                    \Service\Database::getConnection()->rollBack();
                    throw new \Exception\ValidationException('Cadastro de associado, passou pela validação, mas ocorreu rollBack no banco de dados, mensage: ' . $PDOException->getMessage(), 0);
                }
            }
        }
        return $request;*/
        return $data;
    }
}