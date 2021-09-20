<div class="container text-center">
    <h1><?= $title ?></h1>
    <hr>
    <br>
    <a href="?p=admin.product.add" class="btn btn-primary">Ajouter un nouveau produit</a>
    <div class="col-md-4">
        <form action="?p=admin.product.index" method="post">
            <br>
            <label for="">Catégories</label>
            <select name="category" id="category" class="form-control">
                <option class="bg-success" value="0" <?= $selected == 0 ? "selected" : "" ?>>Toutes</option>
                <?php foreach ($categories->allTopCategories() as $c) : ?>
                    <option class="bg-primary" <?= $selected == $c->id ? "selected" : "" ?> value="<?= $c->id ?>"> <?= $c->name ?></option>
                    <?php foreach ($categories->allTopCategories($c->id) as $u) : ?>
                        <option class="bg-info" <?= $selected == $u->id ? "selected" : "" ?> value="<?= $u->id ?>"> <?= $u->name ?></option>
                    <?php endforeach ?>
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
        <?php if (isset($products)) : ?>
            <?php foreach ($products as $p) : ?>
                <div class="col-md-3">
                    <div class="card border-secondary">
                        <img src="uploads/<?= $p->image ?>" class="card-img-top" alt="<?= $p->label ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $p->label ?></h5>
                            <hr>
                            <p class="card-text">Quantité: <?= $p->quantity ?></p>
                            <p class="card-text">Prix: <?= $p->price ?> €</p>
                            <a href="?p=admin.product.edit&id=<?= $p->id ?>" class="btn btn-success">Editer</a>
                            <?= $form->modalDelete(
                                "Supprimer",
                                "Suppression de $p->label",
                                "Êtes-vous sûr de vouloir supprimer le produit $p->label",
                                "?p=admin.product.delete&id=$p->id"
                            );
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>