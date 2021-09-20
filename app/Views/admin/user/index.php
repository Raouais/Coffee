<div class="container text-center">
    <h1>Utilisateurs</h1>
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
                        <p class="card-text">Rôle: <?= $u->role_id ?></p>
                        <a href="?p=admin.user.edit&id=<?= $u->id ?>" class="btn btn-primary">Editer</a>
                        <a href="?p=admin.user.delete&id=<?= $u->id ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>