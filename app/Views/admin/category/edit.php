<div class="container text-center">

    <h1><?= $title ?></h1>
    <?php if (isset($category) && $category->category_id != 0) : ?>
        <a href="?p=admin.category.index&id=<?= $category->category_id ?>" class="btn btn-light border-dark">Revenir</a>
    <?php else : ?>
        <a href="?p=admin.category.index" class="btn btn-light border-dark">Revenir</a>
    <?php endif ?>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?=$error?>
        </div>
    <?php endif ?>

    <form action="" method="post">

        <?= $form->input('name', 'Nom de la catégorie'); ?>
        <?= $form->input('color', 'Associer une couleur'); ?>
        <br>
        <?= $form->submit('Sauvegarder', 'primary'); ?>

    </form>
</div>