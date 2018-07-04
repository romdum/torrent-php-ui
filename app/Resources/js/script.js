$(function(){
    setInterval(update, 2000);
});

function update(){
    $.post({
        url     : "app/ajaxCallback.php",
        dataType: "json",
        success : function (response)
        {
            response.forEach(function(e){
                var $torrentContainer = $('#torrent' + e.id);
                console.log($torrentContainer)
                $torrentContainer
                    .find('.progress-bar')
                    .attr('aria-valuenow', e.percentDone)
                    .text(e.percentDone + '%')
                    .css('width',e.percentDone + '%');
                $torrentContainer
                    .find('.downloadedSize')
                    .text('Taille téléchargé : ' + e.downloadedSize);
                $torrentContainer
                    .find('.peerNumber')
                    .text('Nombre de pair(s) : ' + e.peerNumber);

                if(e.isFinished){
                    $torrentContainer
                        .find('.torrent')
                        .removeClass('text-danger')
                        .addClass('text-success');
                    $torrentContainer
                        .find('.progress-bar')
                        .removeClass('bg-danger')
                        .removeClass('bg-warning')
                        .addClass('bg-success');
                    $torrentContainer
                        .find('.fa-download').parent()
                        .removeClass('btn-secondary')
                        .addClass('btn-primary');
                } else if(e.isDownloading) {
                    $torrentContainer
                        .find('.progress-bar')
                        .addClass('progress-bar-animated')
                        .addClass('bg-warning');
                    $torrentContainer
                        .find('.fa-pause').parent()
                        .removeClass('btn-secondary')
                        .addClass('btn-warning');
                    $torrentContainer
                        .find('.fa-play').parent()
                        .addClass('btn-secondary')
                        .removeClass('btn-success');
                    $torrentContainer
                        .find('.fa-download').parent()
                        .removeClass('btn-primary')
                        .addClass('btn-secondary');
                } else if(e.isStopped) {
                    $torrentContainer
                        .find('.torrent')
                        .removeClass('text-success')
                        .addClass('text-danger');
                    $torrentContainer
                        .find('.progress-bar')
                        .removeClass('bg-warning')
                        .removeClass('bg-success')
                        .addClass('bg-danger');
                    $torrentContainer
                        .find('.fa-pause').parent()
                        .removeClass('btn-warning')
                        .addClass('btn-secondary');
                    $torrentContainer
                        .find('.fa-play').parent()
                        .removeClass('btn-secondary')
                        .addClass('btn-success');
                } else {
                    $torrentContainer
                        .find('.torrent')
                        .removeClass('text-danger')
                        .removeClass('text-success');
                    $torrentContainer
                        .find('.progress-bar')
                        .removeClass('progress-bar-animated')
                        .removeClass('bg-warning');
                }
            });
        }
    });
};

