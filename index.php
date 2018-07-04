<?php

require_once 'vendor/autoload.php';
require_once 'app/function.php';
require_once 'app/Classes/Controller/TorrentController.php';

$transmission = transmissionConnection();

include 'app/Resources/Views/header.php';
include 'app/Resources/Views/addTorrent.php';
include 'app/Resources/Views/torrentList.php';
include 'app/Resources/Views/footer.php';
