<div class="container">
    <h1><?= $title ?></h1>
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <form action="" method="post">
        <?= $form->input('username', 'Pseudo'); ?>
        <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
        <!-- <?= $form->input('remember', 'Se souvenir de moi', ['type' => 'checkbox']); ?> -->
        <button class="btn btn-primary">Envoyer</button>
    </form>
</div>