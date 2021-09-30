<div class="container text-center">
    
    <h1><?=$title?></h1>

    <a href="?p=admin.menu.index" class="btn btn-light border-dark">Revenir</a>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?=$error?>
        </div>
    <?php endif ?>
    
    <form action="" method="post" enctype="multipart/form-data">
    
        <?= $form->input('name','Nom du Menu');?>
        <?= $form->input('image','image', ['type' => 'file']);?>
        <br>
        <?= $form->submit('Sauvegarder','primary');?>
        
    </form>

</div>