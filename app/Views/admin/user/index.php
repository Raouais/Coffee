<div class="container text-center">
    <h1><?= $title ?></h1>
    <hr>
    <br>
    <a href="?p=admin.user.add" class="btn btn-primary">Ajouter un nouvel utilisateur</a>
    <br>
    <br>
    <br>
    <div class="row">
        <?php foreach ($users as $u) : ?>
            <div class="col-md-3">
                <div class="card border-secondary" style="width: 14rem;">
                    <!-- <img src="uploads/<?= '' ?>" class="card-img-top" alt="<?= $u->name ?>"> -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $u->name; $u->lastname; ?></h5>
                        <hr>
                        <p class="card-text"><?= $role->find($u->role_id,'id')->name ?></p>
                        <a href="?p=admin.user.edit&id=<?= $u->id ?>" class="btn btn-primary">Editer</a>
                        <?= $form->modalDelete(
                                "Supprimer",
                                "Suppression de $u->name",
                                "Êtes-vous sûr de vouloir supprimer l'utilisateur $u->name",
                                "?p=admin.user.delete&id=$u->id"
                            );
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>