<header class="mt-5">
    <h2>Add torrent</h2>
</header>
<div class="row">
    <form action="app/addTorrent.php" class="addTorrent mt-3 mb-5 col-6 row" method="post">
        <div class="form-group col-9">
            <label for="exampleInputEmail1">Link</label>
            <input type="text" class="form-control" name="torrentUrl" id="torrentUrl" placeholder="Torrent link">
        </div>
        <button type="submit" class="btn btn-primary col-3 float-bottom" style="position: absolute;bottom: 16px; right: 25px; height: 38px;">Download</button>
    </form>
    <form action="app/addTorrent.php" class="mt-3 col-6" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fileUpload">Upload a torrent file</label>
            <input id="fileUpload" name="fileUpload" type="file" class="file col-6">
        </div>
    </form>
</div>
