<div class="container text-center">
    <h1><?= $title ?></h1>
    <hr>
    <br>
    <?php if (!empty($_GET['id'])) : ?>
        <a href="?p=admin.category.index" class="btn btn-light border-dark">Revenir</a>
    <?php else : ?>
        <a href="?p=admin.category.add" class="btn btn-primary">Ajouter une nouvelle catégorie</a>
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

                        <a href="?p=admin.category.add&id=<?= $c->id ?>" class="btn btn-primary">Ajouter</a>
                        <a href="?p=admin.category.edit&id=<?= $c->id ?>" class="btn btn-success">Editer</a>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?= $c->id ?>">
                            Supprimer
                        </button>

                        <?php if (!empty($categories->find($c->id, 'category_id'))) {
                            $hasCategory = true;
                        } else {
                            $hasCategory = false;
                        } ?>

                        <!-- Modal -->
                        <div class="modal fade" id="modal<?= $c->id ?>" tabindex="-1" aria-labelledby="modal<?= $c->id ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <?php if ($hasCategory) : ?>
                                            <h5 class="modal-title" id="modal<?= $c->id ?>Label">Impossible de supprimer <?= $c->name ?></h5>
                                        <?php else : ?>
                                            <h5 class="modal-title" id="modal<?= $c->id ?>Label">Suppression de <?= $c->name ?></h5>
                                        <?php endif ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if ($hasCategory) : ?>
                                            La catégorie possède une ou plusieurs sous catégories.
                                        <?php else : ?>
                                            Êtes-vous sûr de vouloir supprimer la catégorie <?= $c->name ?> ?
                                        <?php endif ?>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if (!$hasCategory) : ?>
                                            <a href="?p=admin.category.delete&id=<?= $c->id ?>" class="btn btn-danger">Oui</a>
                                            <a data-bs-dismiss="modal" class="btn btn-primary">Non</a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sous catégories -->
                        <?php if (!empty($categories->findAll($c->id, 'category_id'))) : ?>
                            <p style="margin-top: 10px;">
                            <div class="dropdown">
                                <a href="?p=admin.category.index&id=<?= $c->id ?>" class="btn btn-dark">Sous catégorie</a>
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <?php foreach ($categories->findAll($c->id, 'category_id') as $underCategory) : ?>
                                        <li><a class="dropdown-item" type="button"><?= $underCategory->name ?></a></li>
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