<?php

require_once '../vendor/autoload.php';
require_once 'function.php';
require_once 'Classes/Controller/TorrentController.php';

if( isset( $_GET['id'] ) ){
    $transmission = transmissionConnection();
    $torrent = $transmission->get((int)$_GET['id']);

    $torrentCtrl = new TorrentController();
    $torrentCtrl->zipTorrent($torrent);

    $transmission->stop($torrent);
    $torrentName = str_replace( ' ', '', $torrent->getName() );
    header("Content-disposition: attachment; filename=$torrentName.zip");
    header('Content-type: application/zip');

    readfile($torrent->getDownloadDir() . '/' . $torrent->getName() . '.zip');
}