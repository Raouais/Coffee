<div class="container">
    <h1><?= $title ?></h1>
    <a href="?p=admin.category.add" class="btn btn-primary">Ajouter</a>
    <?php if (!empty($_GET['id'])) : ?>
        <a href="?p=admin.category.index" class="btn btn-light">Revenir</a>
    <?php endif ?>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <?php foreach ($categories->allTopCategories(!empty($_GET['id']) ? $_GET['id'] : 0) as $c) : ?>
            <div class="col-md-4">
                <div class="card border-success mb-3">
                    <div class="card-body text-center" style="min-height: 197px;">
                        <h5 class="card-title"><?= $c->name ?></h5>
                        <hr>

                        <a href="?p=admin.category.addUnderCategory&id=<?= $c->id ?>" class="btn btn-primary">Ajouter</a>
                        <a href="?p=admin.category.edit&id=<?= $c->id ?>" class="btn btn-success">Editer</a>


                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Supprimer
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression de <?=$c->name?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer la catégorie <?=$c->name?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="?p=admin.category.delete&id=<?= $c->id ?>" class="btn btn-danger">Oui</a>
                                        <a data-bs-dismiss="modal" class="btn btn-primary">Non</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($categories->findAll($c->id, 'category_id'))) : ?>
                            <p style="margin-top: 10px;">
                            <div class="dropdown">
                                <a href="?p=admin.category.index&id=<?= $c->id ?>" class="btn btn-dark">Sous catégorie</a>
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <?php foreach ($categories->findAll($c->id, 'category_id') as $undeCategory) : ?>
                                        <li><button class="dropdown-item" type="button"><?= $undeCategory->name ?></button></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            </p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>