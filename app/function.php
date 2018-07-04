<?php

use Transmission\Client;
use Transmission\Model\Status;
use Transmission\Transmission;

function transmissionConnection(){
    $client = new Client('localhost', 9091);
    $client->authenticate('transmission', 'transmission');

    $transmission = new Transmission();
    $transmission->setClient($client);
    return $transmission;
}

function human_filesize($bytes, $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function getTorrentStatus($status){
    $result = '';
    switch ($status){
        case Status::STATUS_CHECK:
        case Status::STATUS_CHECK_WAIT:
            $result = 'Vérification';
            break;
        case Status::STATUS_DOWNLOAD:
        case Status::STATUS_DOWNLOAD_WAIT:
            $result = 'Téléchargement';
            break;
        case Status::STATUS_SEED:
        case Status::STATUS_SEED_WAIT:
            $result = 'Partage';
            break;
        case Status::STATUS_STOPPED:
            $result = 'Suspendu';
            break;
    }
    return $result;
}

function deleteFiles($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK );

        foreach( $files as $file ){
            deleteFiles( $file );
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );
    }
}