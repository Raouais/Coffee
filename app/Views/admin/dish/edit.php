<form action="" method="post">

    <?= $form->input('name','Nom du plat');?>
    <?= $form->input('price','Prix du plat');?>
    <?= $form->submit('Sauvegarder','primary');?>
    
</form>