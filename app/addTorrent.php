<?php

require_once '../vendor/autoload.php';
require_once 'function.php';

if( isset( $_POST['torrentUrl'] ) ){
    $transmission = transmissionConnection();

    $torrent = $transmission->add($_POST['torrentUrl']);
    $transmission->start($torrent);
}

if( isset( $_FILES['fileUpload'] ) ){

    $uploaddir = '/var/lib/transmission-daemon/.config/transmission-daemon/torrents/';
    $uploadfile = str_replace([' ','\''], '', $uploaddir . basename($_FILES['fileUpload']['name']));

    $result = move_uploaded_file($_FILES['fileUpload']['tmp_name'], $uploadfile);

    $transmission = transmissionConnection();

    $torrent = $transmission->add($uploadfile);
//    $transmission->start($torrent);

}

header('Location: /index.php');
