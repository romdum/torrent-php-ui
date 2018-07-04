<?php

require_once '../vendor/autoload.php';
require_once 'function.php';

if( isset( $_GET['id'] ) ){
    $transmission = transmissionConnection();
    $torrent = $transmission->get((int)$_GET['id']);

    $path = $torrent->getDownloadDir() . '/' . $torrent->getName();

    if( is_dir( $path ) ){
        deleteFiles($path);
    } else {
        unlink($path);
    }

    if( file_exists( $path . '.zip' ) ){
        unlink( $path . '.zip' );
    }

    if( file_exists( $path . '.part' ) ){
        unlink( $path . '.part' );
    }

    $transmission->remove($torrent);

    header('Location: /index.php');
}