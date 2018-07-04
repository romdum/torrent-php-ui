<?php

require_once '../vendor/autoload.php';
require_once 'function.php';

if( isset( $_GET['id'] ) ){
    $transmission = transmissionConnection();
    $transmission->stop($transmission->get((int)$_GET['id']));

    header('Location: /index.php');
}