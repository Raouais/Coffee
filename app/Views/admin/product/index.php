<div class="container text-center">
    <h1>Produits</h1>
    <hr>
    <br>
    <a href="?p=admin.product.add" class="btn btn-primary">Ajouter un nouveau produit</a>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-3">
            <?php foreach ($products as $p) : ?>
                <div class="card border-secondary">
                    <img src="uploads/<?= $p->image ?>" class="card-img-top" alt="<?= $p->label ?>">
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