<?php

class TorrentController
{
    /**
     * @param \Transmission\Model\Torrent $torrent
     */
    public function zipTorrent($torrent)
    {
        if( $torrent->isFinished() && ! file_exists($torrent->getDownloadDir() . '/' . $torrent->getName() . '.zip' ) ){
            $this->zipData(
                $torrent->getDownloadDir() . '/' . $torrent->getName(),
                $torrent->getDownloadDir() . '/' . $torrent->getName() . '.zip'
            );
        }
    }

    private function zipData($source, $destination) {
        if (extension_loaded('zip') === true) {
            if (file_exists($source) === true) {
                $zip = new ZipArchive();
                if ($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
                    $source = realpath($source);
                    if (is_dir($source) === true) {
                        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = realpath($file);
                            if (is_dir($file) === true) {
                                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                            } else if (is_file($file) === true) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    } else if (is_file($source) === true) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            }
        }
        return false;
    }

    /**
     * Can be executed automatically when a torrent is finished.
     */
    public static function zipAll()
    {
        require_once __DIR__ . '/../../../vendor/autoload.php';
        require_once __DIR__ . '/../../function.php';

        $transmission = transmissionConnection();
        $torrents = $transmission->all();
        $torrentCtrl = new TorrentController();

        foreach( $torrents as $torrent ){
            if( $torrent->isFinished() && ! file_exists( $torrent->getDownloadDir() . '/' .  $torrent->getName() . '.zip' ) ){
                $torrentCtrl->zipTorrent($torrent);
            }
        }
    }
}
