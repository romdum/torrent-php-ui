<?php

require_once '../vendor/autoload.php';
require_once 'function.php';

if( isset( $_GET['id'] ) ){
    $transmission = transmissionConnection();
    $transmission->start($transmission->get((int)$_GET['id']));

    header('Location: /index.php');
}