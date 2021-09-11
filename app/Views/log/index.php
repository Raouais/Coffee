<?php if(false): ?>
    <div class="alert alert-danger">
        Identifiants incorrects
    </div>
<?php endif; ?>
<form action="" method="post">
    <?= $form->input('username','Pseudo');?>
    <?= $form->input('password','Mot de passe', ['type' => 'password']);?>
    <!-- <?= $form->input('remember','Se souvenir de moi', ['type' => 'checkbox']);?> -->
    <button class="btn btn-primary">Envoyer</button>
</form>
<!-- <?= $form->link('index.php?p=users.forget','Mot de passe oublié ?');?> -->