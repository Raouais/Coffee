<div class="container text-center">
    <h1>Edition</h1>
    <br>
    <a href="?p=admin.interface.index" class="btn btn-light border-dark">Revenir</a>
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif ?>

    <form action="" method="post">

        <?= $form->input('name', 'Nom de l\'interface'); ?>

        <?php foreach ($categories as $c) : ?>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="<?= $c->id ?>" value="<?= $c->name ?>">
                <label class="form-check-label" for="<?= $c->name ?>"><?= $c->name ?></label>
            </div>
        <?php endforeach ?>
        
        <?= $form->submit('Sauvegarder', 'primary'); ?>

    </form>
</div>