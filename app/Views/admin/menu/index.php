<div class="container text-center">
    <h1><?= $title ?></h1>
    <hr>
    <br>
    <a href="?p=admin.menu.add" class="btn btn-primary">Ajouter un nouveau Menu</a>
    <div class="row">
        <?php if (isset($menus)) : ?>
            <?php foreach ($menus as $m) : ?>
                <div class="col-md-3">
                    <div class="card border-secondary">
                        <img src="uploads/<?= $m->image ?>" class="card-img-top" alt="<?= $m->name ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $m->name ?></h5>
                            <hr>
                            <a href="?p=admin.menu.edit&id=<?= $m->id ?>" class="btn btn-success">Editer</a>
                            <?= $form->modalDelete(
                                "Supprimer",
                                "Suppression de $m->name",
                                "Êtes-vous sûr de vouloir supprimer le menu $m->name",
                                "?p=admin.menu.delete&id=$m->id"
                            );
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
