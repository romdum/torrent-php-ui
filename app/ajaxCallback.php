<?php

require_once '../vendor/autoload.php';
require_once 'function.php';

$result = [];
$transmission = transmissionConnection();

foreach( $transmission->all() as $torrent ){
    $result[] = [
        'id' => $torrent->getId(),
        'size' => human_filesize($torrent->getSize()),
        'downloadedSize' => human_filesize((int)$torrent->getSize() * $torrent->getPercentDone() / 100 ),
        'peerNumber' => count($torrent->getPeers()),
        'percentDone' => $torrent->getPercentDone(),
        'isFinished' => $torrent->isFinished(),
        'isStopped' => $torrent->isStopped(),
        'isDownloading' => $torrent->isDownloading()
    ];
}

echo json_encode($result);
die;