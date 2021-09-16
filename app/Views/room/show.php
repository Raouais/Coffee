<div class="container text-center" id="room">

    <h1><?= $item->name ?></h1>
    <input type="hidden" value="<?= $item->id ?>" id="room_id">
    <button type="button" id="modify" class="btn btn-warning">Modifier</button>
    <button type="button" id="add" class="btn btn-primary">Outils</button>
    <script src="dist/bundle.js"></script>
</div>