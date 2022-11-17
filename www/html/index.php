<?php

$host = getenv('MARIADB_HOST');
$port = getenv('MARIADB_PORT');
$dbname = getenv('MARIADB_DATABASE');

if(empty(getenv('MARIADB_USER'))) {
    $user = 'root';
} else {
    $user = getenv('MARIADB_USER');
}

if(empty(getenv('MARIADB_PASSWORD'))) {
    $password = getenv('MARIADB_ROOT_PASSWORD');
} else {
    $password = getenv('MARIADB_PASSWORD');
}

//var_dump($host, $port, $dbname, $user, $password);
//exit();

try {
    $dbh = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname . ';', $user, $password);
    foreach($dbh->query('SHOW DATABASES;') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $exception) {
    var_dump($exception);
    exit();
}
