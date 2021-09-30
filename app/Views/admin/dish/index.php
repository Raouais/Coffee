<div class="container text-center">
    <h1><?= $title ?></h1>
    <hr>
    <br>
    <a href="?p=admin.dish.add" class="btn btn-primary">Ajouter un nouveau plat</a>
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