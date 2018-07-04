<?php /** @var Transmission\Transmission $transmission */ ?>

<div class="torrentList">
    <?php foreach( $transmission->all() as $torrent ): ?>
        <div class="row mb-3 pt-3 pb-3 bg-light" id="torrent<?= $torrent->getId() ?>">
            <div class="torrent col-9 <?= ($torrent->isFinished() ? 'text-success' : ($torrent->getStatus() === 0 ? 'text-danger' : '') )?>">
                <header>
                    <h2 style="font-size:1.2rem">
                        <?= $torrent->getName() ?>
                    </h2>
                    <div class="progress">
                        <div
                            class="progress-bar progress-bar-striped <?= ! $torrent->isFinished() && $torrent->getStatus() === 4 ? 'progress-bar-animated' : '' ?> <?= ($torrent->isFinished() ? 'bg-success' : ($torrent->getStatus() === 0 ? 'bg-danger' : 'bg-warning')) ?>"
                            role="progressbar"
                            style="width: <?= $torrent->getPercentDone() ?>%"
                            aria-valuenow="<?= $torrent->getPercentDone() ?>"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            <?= $torrent->getPercentDone() ?>%
                        </div>
                    </div>
                </header>
                <div class="row">
                    <div class="col-4">
                        Taille : <?= human_filesize($torrent->getSize()) ?>
                    </div>
                    <div class="col-4 downloadedSize">
                        Taille téléchargé : <?= human_filesize((int)$torrent->getSize() * $torrent->getPercentDone() / 100 ) ?>
                    </div>
                    <div class="col-4 peerNumber">
                        Nombre de pair(s) : <?= count($torrent->getPeers()) ?>
                    </div>
                </div>
            </div>
            <div class="col-3 pt-3 text-right">
                <a href="app/startTorrent.php?id=<?= $torrent->getId() ?>" class="btn btn-<?= $torrent->getStatus() === 0 ? 'success' : 'secondary' ?>"><i class="fas fa-play text-white"></i></a>
                <a href="app/pauseTorrent.php?id=<?= $torrent->getId() ?>" class="btn btn-<?= $torrent->getStatus() === 0 ? 'secondary' : 'warning' ?>"><i class="fas fa-pause text-white"></i></a>
                <a href="app/downloadTorrent.php?id=<?= $torrent->getId() ?>" class="btn btn-<?= $torrent->isFinished() ? 'primary' : 'secondary' ?>"><i class="fas fa-download text-white"></i></a>
                <a href="app/removeTorrent.php?id=<?= $torrent->getId() ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>