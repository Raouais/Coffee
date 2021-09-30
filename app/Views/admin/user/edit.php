<div class="container text-center">
    <h1>Edition</h1>
    <br>
    <a href="?p=admin.user.index" class="btn btn-light border-dark">Revenir</a>
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?=$error?>
        </div>
    <?php endif ?>
    <form action="" method="post">
        <?= $form->input('name', 'Nom de l\'utilisateur'); ?>
        <?= $form->input('lastname', 'Prénom de l\'utilisateur'); ?>
        <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
        <?= $form->input('password_confirm', 'Comfirmer le mot de passe', ['type' => 'password']); ?>
        <label for="">Rôle</label>
        <select name="role_id" id="role" class="form-control">
            <?php foreach ($role as $r) : ?>
                <option class="bg-primary" value="<?= $r->id ?>" <?= isset($user) && $user->role_id === $r->id ? "selected" : "" ?>> <?= $r->name ?></option>
            <?php endforeach ?>
        </select>
        <?= $form->submit('Sauvegarder', 'primary'); ?>
    </form>
</div>