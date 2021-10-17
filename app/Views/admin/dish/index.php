<div class="container text-center">
<h1><?= $title ?></h1>
    <hr>
    <br>
    <a href="?p=admin.dish.add" class="btn btn-primary">Ajouter un nouveau plat</a>
    <div class="col-md-4">
        <form action="?p=admin.dish.index" method="post">
            <br>
            <label for="">Menus</label>
            <select name="menu" id="menu" class="form-control">
                <option class="bg-success" value="0" <?= $selected == 0 ? "selected" : "" ?>>Toutes</option>
                <?php foreach ($menus as $m) : ?>
                    <option class="bg-primary" <?= $selected == $m->id ? "selected" : "" ?> value="<?= $m->id ?>"> <?= $m->name ?></option>
                <?php endforeach ?>
            </select>
            <br>
            <?= $form->submit("Trier", "primary") ?>
        </form>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <?php if (isset($dishes)) : ?>
            <?php foreach ($dishes as $d) : ?>
                <div class="col-md-3">
                    <div class="card border-secondary">
                        <img src="uploads/<?= $d->image ?>" class="card-img-top" alt="<?= $d->name ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $d->name ?></h5>
                            <hr>
                            <p class="card-text">Prix: <?= $d->price ?> €</p>
                            <a href="?p=admin.dish.edit&id=<?= $d->id ?>" class="btn btn-success">Editer</a>
                            <?= $form->modalDelete(
                                "Supprimer",
                                "Suppression de $d->name",
                                "Êtes-vous sûr de vouloir supprimer le plat $d->name",
                                "?p=admin.dish.delete&id=$d->id"
                            );
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>