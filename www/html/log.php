<?php

header('Content-Type: text/plain;');

session_start();
if(isset($_SESSION['login'])) {
    echo file_get_contents('./application/application.log');
}
