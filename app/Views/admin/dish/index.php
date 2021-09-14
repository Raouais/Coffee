<h1>Plats</h1>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php foreach ($products as $p) : ?>
                <div class="card border-secondary" style="width: 14rem;">
                    <img src="uploads/<?= $p->imagePath ?>" class="card-img-top" alt="<?= $p->label ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $p->label ?></h5>
                        <hr>
                        <p class="card-text">Quantité: <?= $p->quantity ?></p>
                        <p class="card-text">Prix: <?= $p->price ?> €</p>
                        <a href="?p=admin.product.edit&id=<?= $p->id ?>" class="btn btn-primary">Editer</a>
                        <a href="?p=admin.product.delete&id=<?= $p->id ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>