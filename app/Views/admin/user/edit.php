<form action="" method="post">

    <?= $form->input('name','Nom de l\'utilisateur');?>
    <?= $form->input('lastname','Prénom de l\'utilisateur');?>
    <?= $form->input('password','Mot de passe');?>
    <?= $form->input('password','Vérification mot de passe');?>
    <?= $form->input('role_id','Rôle de l\'utilisateur');?>
    <?= $form->submit('Sauvegarder','primary');?>
    
</form>