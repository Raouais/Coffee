<div class="container text-center" id="room">
    <h1><?= $item->name ?></h1>
    
    <?php if(isset($_SESSION['auth_role']) == 1):?>
        <a href="?p=admin.room.index" class="btn btn-light border-dark">Revenir</a>
    <?php else:?>
        <a href="?p=room.index" class="btn btn-light border-dark">Revenir</a>
    <?php endif?>
    <br>
    <br>

    <input type="hidden" value="<?= $item->id ?>" id="room_id">
    <?php if(isset($_SESSION['auth_role']) == 1):?>
        <button type="button" id="modify" class="btn btn-warning">Modifier</button>
        <button type="button" id="add" class="btn btn-primary">Outils</button>
        <?php endif?>
    <script src="dist/bundle.js"></script>
</div>