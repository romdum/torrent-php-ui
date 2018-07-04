<?php

require_once '../vendor/autoload.php';
require_once 'function.php';

if( isset( $_POST['torrentUrl'] ) ){
    $transmission = transmissionConnection();

    $torrent = $transmission->add($_POST['torrentUrl']);
    $transmission->start($torrent);

    header('Location: /index.php');
}